<?php

namespace App\Services\Api\CheckSums;

use Carbon\Carbon;

class MPWTSEPCheckSumService
{

    public function getSingleRecord($referenceNumber)
    {
        return response()->json([
            'code' => 404,
            'message' => 'Not found',
        ], 404);
    }

    public function getMultipleRecord($startDatetime, $endDatetime)
    {
        $curl = curl_init();
        $url = env("CHECK_SUM_API_MPWT_SEP_MULTIPLE_RECORD");

        $form = [
            'partner' => 'ALL',
            'start_mpwt_transaction_datetime' => Carbon::parse($startDatetime)->format('Y-m-d H:i:s:u'),
            'end_mpwt_transaction_datetime' => Carbon::parse($endDatetime)->format('Y-m-d H:i:s:u'),
        ];
        $url = sprintf("%s?%s", $url, http_build_query($form));
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control:no-cache",
                "Content-type:application/json",
                "Authorization:" . env('CHECK_SUM_API_MPWT_SEP_AUTH'),
            ),
        ));
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $data = json_decode($response, true);

        if ($httpCode == 200 && is_array($data)) {            
            $resData = [];
            $count = 0;
            $amount = 0;

            if (count($data) > 0) {
                foreach ($data as $arr) {
                    $item = [];
                    $item['payment_reference_no'] = $arr['payment_reference_no'];
                    $item['transaction_id'] = $arr['transaction_id'];
                    $item['transaction_datetime'] = $arr['transaction_datetime'];
                    $item['partner'] = $arr['partner_id'];
                    $item['transaction_amount'] = $arr['transaction_amount'];
                    $resData[] = $item;
                    $count++;
                    $amount = $amount + $item['transaction_amount'];
                }

                $res = [
                    'response_start_mpwt_transaction_datetime' => $form['start_mpwt_transaction_datetime'],
                    'response_end_mpwt_transaction_datetime' => $form['end_mpwt_transaction_datetime'],
                    'total_amount' => $amount,
                    'total_transaction' => $count,
                    'data' => $resData
                ];
                return $res;
            }
        }

        return response()->json([
            'code' => 404,
            'message' => 'Not found',
        ], 404);
    }   
}
