<?php

namespace App\Services\Api\CheckSums;

use Carbon\Carbon;

class CampuCheckSumService
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
            $curl = curl_init();
            $url = env("CHECK_SUM_API_CAMPU_SINGLE_RECORD") . '/' . $referenceNumber;
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
                    "Authorization:" . env('CHECK_SUM_API_CAMPU_AUTH'),
                ],
            ));
            $response = curl_exec($curl);
            $info = curl_getinfo($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $data = json_decode($response, true);
            
            if ($httpCode == 200 && is_array($data)) {
                                
                if (count($data) > 0 && isset($data['transaction_id']) ) {
                    $item = [];
                    $item['transaction_id'] = $data['transaction_id'];
                    $item['pg_transaction_datetime'] = $data['pg_transaction_datetime'];
                    $item['mpwt_transaction_datetime'] = $data['mpwt_transaction_datetime'];
                    $item['currency'] = $data['currency'];
                    $item['bill_id'] = $data['bill_id'];
                    $item['bill_id_sub1'] = $data['bill_id_sub1'];
                    $item['bill_id_sub2'] = $data['bill_id_sub2'];
                    $item['amount'] = $data['amount'];
                    $item['amount_sub1'] = $data['amount_sub1'];
                    $item['amount_sub2'] = $data['amount_sub2'];
                    $item['acknowlegde_id'] = '';
                    return $item;
                }
                $httpCode = 404;            
            }   
            
            $httpCode = 404;
            return $this->mapResponseMsg($httpCode, $httpCode, 'Not found');
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }

    public function getMultipleRecord($startDatetime, $endDatetime)
    {
        try {
            $form = [
                "start_mpwt_transaction_datetime" => $startDatetime,
                "end_mpwt_transaction_datetime" => $endDatetime,
            ];

            $curl = curl_init();
            $url = env("CHECK_SUM_API_CAMPU_MULTIPLE_RECORD");
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
                CURLOPT_POSTFIELDS => json_encode($form),
                CURLOPT_HTTPHEADER => [
                    "cache-control: no-cache",
                    "content-type: application/json",
                    "Authorization:" . env('CHECK_SUM_API_CAMPU_AUTH'),
                ],
            ));
            $response = curl_exec($curl);
            $info = curl_getinfo($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $data = json_decode($response, true);            
        
            if ($httpCode == 200 && is_array($data)) {                                
                $arrs  = $data['data'];
                $resData = [];
                $count = 0;
                $amount = 0;
                
                if (count($arrs) > 0) {
                    foreach ($arrs as $arr) {
                        $item = [];
                        $item['transaction_id'] = $arr['transaction_id'];
                        $item['pg_transaction_datetime'] = $arr['pg_transaction_datetime'];
                        $item['mpwt_transaction_datetime'] = $arr['mpwt_transaction_datetime'];
                        $item['currency'] = $arr['currency'];
                        $item['bill_id'] = $arr['bill_id'];
                        $item['bill_id_sub1'] = $arr['bill_id_sub1'];
                        $item['bill_id_sub2'] = $arr['bill_id_sub2'];
                        $item['amount'] = $arr['amount'];
                        $item['amount_sub1'] = $arr['amount_sub1'];
                        $item['amount_sub2'] = $arr['amount_sub2'];
                        $item['acknowlegde_id'] = '';
                        $resData[] = $item;
                        $count++;
                        $amount = $amount + $item['amount'];
                    }

                    $res = [
                        'response_start_mpwt_transaction_datetime' => Carbon::parse($data['response_start_mpwt_transaction_datetime'])->format('Y-m-d H:i:s'),
                        'response_end_mpwt_transaction_datetime' => Carbon::parse($data['response_end_mpwt_transaction_datetime'])->format('Y-m-d H:i:s'),
                        'total_amount' => $amount,
                        'total_transaction' => $count,
                        'data' => $resData
                    ];
                    return $res;
                }                            
            }
            $httpCode = 404;
            return $this->mapResponseMsg($httpCode, $httpCode, 'Not found');
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }
}