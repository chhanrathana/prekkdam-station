<?php

namespace App\Services\Api\CheckSums;

class MPWTVTISCheckSumService
{

    public function getSingleRecord($referenceNumber)
    {
        $curl = curl_init();
        $url = env("CHECK_SUM_API_MPWT_VTIS_SINGLE_RECORD");
        $form = [
            'payment_reference_no' => $referenceNumber,
        ];
        $url = sprintf("%s?%s", $url, http_build_query($form));
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 3000,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "cache-control: no-cache",
                "content-type: application/json",
                "Authorization:" . env('CHECK_SUM_API_MPWT_VTIS_AUTH'),
            ],
        ));
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $data = json_decode($response, true);
        return $data;

    }

    public function getMultipleRecord($startDatetime, $endDatetime)
    {
        // $form = [
        //     "fromDate" => $startDatetime,
        //     "toDate" => $endDatetime,
        // ];
        $form = [
            'partner' => 'ALL',
            'start_datetime' => $startDatetime,
            'end_datetime' => $endDatetime,
        ];

        $curl = curl_init();
        $url = env("CHECK_SUM_API_MPWT_VTIS_MULTIPLE_RECORD");
        $url = sprintf("%s?%s", $url, http_build_query($form));

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 1200,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                // "CMVIC-Platform-TenantId: default",
                // "Authorization: Bearer " . $this->getAccessToken(),
                "Authorization:" . env('CHECK_SUM_API_MPWT_VTIS_AUTH'),
            ],
        ));
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $data = json_decode($response, true);
        return $data;
        if ($httpCode == 200 && is_array($data)) {
            $resData = [];
            $count = 0;
            $amount = 0;

            if (count($data) > 0) {
                foreach ($data as $arr) {
                    $item = [];
                    $item['payment_reference_no'] = $arr['paymentReferenceNo'];
                    $item['vehicle_reg_refernce_no'] = $arr['vehicleRegistrationReferenceNo'];
                    $item['transaction_id'] = $arr['transactionId'];
                    $item['transaction_datetime'] = $arr['transactionDate'];
                    $item['partner'] = $arr['partnerId'];
                    $item['transaction_amount'] = $arr['transactionAmount'];
                    $resData[] = $item;
                    $count++;
                    $amount = $amount + $item['transaction_amount'];
                }

                $res = [
                    'response_start_mpwt_transaction_datetime' => $form['fromDate'],
                    'response_end_mpwt_transaction_datetime' => $form['toDate'],
                    'total_amount' => $amount,
                    'total_transaction' => $count,
                    'data' => $resData,
                ];
                return $res;
            }
        }

        return response()->json([
            'code' => 404,
            'message' => 'Not found',
        ], 404);
    }

    private function getAccessToken()
    {
        $curl = curl_init();
        $url = env("CHECK_SUM_API_MPWT_VTIS_TOKEN");
        $form = [
            'client_id' => env('CHECK_SUM_API_MPWT_VTIS_CLIENT_ID'),
            'client_secret' => env('CHECK_SUM_API_MPWT_VTIS_CLIENT_SECRET'),
            'grant_type' => 'password',
            'username' => env('CHECK_SUM_API_MPWT_VTIS_USERNAME'),
            'password' => env('CHECK_SUM_API_MPWT_VTIS_PASSWORD'),
        ];
        $url = sprintf("%s?%s", $url, http_build_query($form));
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => [
                "CMVIC-Platform-TenantId: default",
            ],

        ));
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        $data = json_decode($response, true);

        $token = '';
        if ($data) {
            $token = isset($data['access_token']) ? $data['access_token'] : null;
        }
        return $token;
    }
}
