<?php

namespace App\Services\Api\CheckSums;

class ABACheckSumService
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
            $url = env('CHECK_SUM_API_ABA_SINGLE_RECORD');

            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 12000,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($form),
                CURLOPT_HTTPHEADER => [
                    "Cache-Control: no-cache",
                    "Content-Type: application/json",
                    "CLIENT_CODE: " . env('CHECK_SUM_API_ABA_CLIENT_CODE'),
                    "ACTION_CODE: " . env('CHECK_SUM_API_ABA_ACTION_CODE'),
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

            if ($httpCode == 200) {
                $res = $data['data'];
                if ($res) {
                    return $res;
                }
                $httpCode = 404;
            }
            return $this->mapResponseMsg($httpCode, $data['error_code'], $data['message']);
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
            $url = env('CHECK_SUM_API_ABA_MULTIPLE_RECORD');

            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 12000,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($form),
                CURLOPT_HTTPHEADER => [
                    "Cache-Control: no-cache",
                    "Content-Type: application/json",
                    "CLIENT_CODE: " . env('CHECK_SUM_API_ABA_CLIENT_CODE'),
                    "ACTION_CODE: " . env('CHECK_SUM_API_ABA_ACTION_CODE'),
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
                $data = $data['data'];
                if (count($data) > 0) {
                    return $data;
                }
                $httpCode = 404;
            }
            return $this->mapResponseMsg($httpCode, $data['error_code'], $data['message']);

        } catch (\Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }
}
