<?php

namespace App\Services\Api\CheckSums;

class VattanacCheckSumService
{

    private function mapResponseMsg($httpCode, $code, $message)
    {

        if ($httpCode == 401) {
            $message .= '| Invalid rsa-key or Client Code or Action Code';
        } elseif ($httpCode == 400) {
            $message .= '| In Case query greater than 7 days';
        } elseif ($httpCode == 404) {
            $message .= '| Not found';
        } elseif ($httpCode == 500) {
            $message .= '| Server Error';

        }
        $message .= $message . '|PG Code :: ' . $code;

        return response()->json([
            'code' => $httpCode,
            'message' => $message,
        ], $httpCode);
    }

    public function getSingleRecord($referenceNumber)
    {
        try {
            $form = [
                'bill_id' => $referenceNumber,
            ];

            $curl = curl_init();
            $url = env('CHECK_SUM_API_VATTANAC_SINGLE_RECORD');
            $url = sprintf("%s?%s", $url, http_build_query($form));

            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 12000,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                // CURLOPT_POSTFIELDS => json_encode($form),
                CURLOPT_HTTPHEADER => [
                    "Cache-Control: no-cache",
                    "Content-Type: application/json",
                    "Authorization: " . env('CHECK_SUM_API_VATTANAC_AUTH'),
                ],
            ]);

            $response = curl_exec($curl);
            $info = curl_getinfo($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $data = json_decode($response, true);
            //  print_r($form);
            //print_r($info);
            // //exit;
            // print_r($data);

            if ($httpCode == 200) {
                if(isset($data['response_code']) != 200){
                    return $data;
                }                
                $httpCode = 404;
            }
            return $this->mapResponseMsg($httpCode, $data['response_code'], $data['response_msg']);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }

    public function getMultipleRecord($startDatetime, $endDatetime)
    {
        try {
            $form = [
                'start_mpwt_transaction_datetime' => $startDatetime,
                'end_mpwt_transaction_datetime' => $endDatetime,
            ];

            $curl = curl_init();
            $url = env('CHECK_SUM_API_VATTANAC_MULTIPLE_RECORD');
            $url = sprintf("%s?%s", $url, http_build_query($form));

            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 12000,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_POSTFIELDS => json_encode($form),
                CURLOPT_HTTPHEADER => [
                    "Cache-Control: no-cache",
                    "Content-Type: application/json",
                    "Authorization: " . env('CHECK_SUM_API_VATTANAC_AUTH'),
                ],
            ]);

            $response = curl_exec($curl);
            $info = curl_getinfo($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $data = json_decode($response, true);
            //  print_r($form);
            // print_r($info);
            // //exit;
            // print_r($data);
            //exit;
            if ($httpCode == 200) {
                if(isset($data['response_code']) != 200){
                    return $data;
                }                
                $httpCode = 404;
            }
            return $this->mapResponseMsg($httpCode, $data['response_code'], $data['response_msg']);

        } catch (\Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }
}
