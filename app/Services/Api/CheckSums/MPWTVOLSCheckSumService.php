<?php

namespace App\Services\Api\CheckSums;


class MPWTVOLSCheckSumService
{

    public function getSingleRecord($referenceNumber)
    {        
        $curl = curl_init();
        $url = env("CHECK_SUM_API_MPWT_VOLS_SINGLE_RECORD");
        $form = [
            'payment_reference_no' => $referenceNumber
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
                "Authorization:" . env('CHECK_SUM_API_MPWT_VOLS_AUTH'),
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
        $curl = curl_init();
        $url = env("CHECK_SUM_API_MPWT_VOLS_MULTIPLE_RECORD");

        $form = [
            'partner' => 'ALL',
            'start_datetime' => $startDatetime,
            'end_datetime' => $endDatetime,
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
                "Authorization:" . env('CHECK_SUM_API_MPWT_VOLS_AUTH'),
            ),
        ));
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        $data = json_decode($response, true);

        // dd($info);
        return $data;
    }
}
