<?php

namespace App\Services\Api\CheckSums;

use Carbon\Carbon;


class ChipMongCheckSumService
{

    private function mapResponseMsg($httpCode, $code, $message)
    {

        if ($httpCode == 'DIGX_CMCB_EBPP_40') {
            $message .= '| Invalid invoice ID';
        } elseif ($httpCode == 'DIGX_CMCB_EBPP_41') {
            $message .= '| Invoice date format';
        } elseif ($httpCode == 'DIGX_CMCB_EBPP_45') {
            $message .= '| Invalid API Key';
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
                'billId' => $referenceNumber,
            ];

            $curl = curl_init();
            $url = env('CHECK_SUM_API_CHIPMONG_SINGLE_RECORD');
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
                //CURLOPT_POSTFIELDS => json_encode($form),
                CURLOPT_HTTPHEADER => [
                    "Cache-Control: no-cache",
                    "Content-Type: application/json",
                    "api-key: " . env('CHECK_SUM_API_CHIPMONG_AUTH'),
                ],
            ]);

            $response = curl_exec($curl);
            $info = curl_getinfo($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $data = json_decode($response, true);
            //  print_r($form);
            //   print_r($info);
            // //exit;
            // print_r($data);            
            if ($httpCode == 200) {
                $item = [];
                $item['transaction_id'] = $data['transaction_id'];
                $item['pg_transaction_datetime'] = Carbon::parse($data['pg_transaction_datetime'])->format('Y-m-d H:i:s');
                $item['mpwt_transaction_datetime'] = Carbon::parse($data['mpwt_transaction_datetime'])->format('Y-m-d H:i:s');
                $item['currency'] = $data['currency'];
                $item['bill_id'] = $data['bill_id'];
                $item['bill_id_sub1'] = $data['bill_id_sub1'];
                $item['bill_id_sub2'] = $data['bill_id_sub2']??'';
                $item['amount'] = $data['amount'];
                $item['amount_sub1'] = $data['amount_sub1'];
                $item['amount_sub2'] = $data['amount_sub2'];
                $item['acknowlegde_id'] = $data['acknowledge_id'];
                return $item;
            }
            return $this->mapResponseMsg($httpCode, $data['message']['code'], $data['message']['detail']);
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
            $url = env('CHECK_SUM_API_CHIPMONG_MULTIPLE_RECORD');
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
                    "api-key: " . env('CHECK_SUM_API_CHIPMONG_AUTH'),
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
            // exit;
            if ($httpCode == 200) {
                unset($data['status']);
                return $data;
            }
            return $this->mapResponseMsg($httpCode, $data['message']['code'], $data['message']['detail']);

        } catch (\Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }
}
