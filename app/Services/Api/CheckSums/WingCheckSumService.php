<?php

namespace App\Services\Api\CheckSums;

class WingCheckSumService
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
            $url = env("CHECK_SUM_API_WING_SINGLE_RECORD") . '/' . $referenceNumber;
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
                    "Authorization:" . env('CHECK_SUM_API_WING_AUTH'),
                ],
            ));
            $response = curl_exec($curl);
            $info = curl_getinfo($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $data = json_decode($response, true);
        
            if ($httpCode == 200 && isset($data['data'])) {
                $res = $data['data'];
                if (count($res) > 0 && isset($res['transaction_id']) ) {
                    $item = [];
                    $item['transaction_id'] = $res['transaction_id'];
                    $item['pg_transaction_datetime'] = $res['transaction_date'];
                    $item['mpwt_transaction_datetime'] = $res['transaction_date'];
                    $item['currency'] = 'KHR';
                    $item['bill_id'] = $res['bill_id'];
                    $item['bill_id_sub1'] = $res['bill_id'];
                    $item['bill_id_sub2'] = '';
                    $item['amount'] = $res['amount'];
                    $item['amount_sub1'] = $res['amount'];
                    $item['amount_sub2'] = '';
                    $item['acknowlegde_id'] = '';
                    return $item;
                }
                $httpCode = 404;
            }
            return $this->mapResponseMsg($httpCode, $data['code'], $data['message']);
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
            $url = env("CHECK_SUM_API_WING_MULTIPLE_RECORD");
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
                    "Authorization:" . env('CHECK_SUM_API_WING_AUTH'),
                ],
            ));
            $response = curl_exec($curl);
            $info = curl_getinfo($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $data = json_decode($response, true);            
            
            if ($httpCode == 200 && isset($data['data'])) {                
                $dataSlice =  $data['data'];
                if(isset($dataSlice['data'])){
                    $arrs = $dataSlice['data'];
                    $resData = [];
                    $count = 0;
                    $amount = 0;
                // return $arrs;

                    if (count($arrs) > 0) {
                        foreach ($arrs as $arr) {
                            $item = [];
                            $item['transaction_id'] = $arr['transaction_id'];
                            $item['pg_transaction_datetime'] = $arr['pg_transasction_datetime'];
                            $item['mpwt_transaction_datetime'] = $arr['mpwt_transasction_datetime']?? $arr['pg_transasction_datetime'];
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
                            'response_start_mpwt_transaction_datetime' => $dataSlice['start_mpwt_transaction_datetime'],
                            'response_end_mpwt_transaction_datetime' => $dataSlice['end_mpwt_transaction_datetime'],
                            'total_amount' => $amount,
                            'total_transaction' => $dataSlice['total_transaction'],
                            'data' => $resData
                        ];
                        return $res;
                    }  
                }
                         
                $httpCode = 404;
            }
            return $this->mapResponseMsg($httpCode, $data['code'], $data['message']);

        } catch (\Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }
}
