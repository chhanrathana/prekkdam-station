<?php

namespace App\Services\Api\CheckSums;

use Carbon\Carbon;


class PiPayCheckSumService
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
            $url = env('CHECK_SUM_API_PIPAY_SINGLE_RECORD');
            // $url = sprintf("%s?%s", $url, http_build_query($form));

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

           
             if ($httpCode == 200 && isset($data['transaction_id'])) {
                
                $item = [];
                $item['transaction_id'] = $data['transaction_id'];
                $item['pg_transaction_datetime'] = Carbon::parse($data['pg_transaction_datetime'])->format('Y-m-d H:i:s');
                $item['mpwt_transaction_datetime'] = Carbon::parse($data['mpwt_transaction_datetime'])->format('Y-m-d H:i:s');
                $item['currency'] = $data['currency'];
                $item['bill_id'] = $data['bill_id'];
                $item['bill_id_sub1'] = $data['bill_id_sub1'];
                $item['bill_id_sub2'] = $data['bill_id_sub2'];
                $item['amount'] = (float)filter_var($data['amount'], FILTER_SANITIZE_NUMBER_INT);
                $item['amount_sub1'] = (float)filter_var($data['amount_sub1'], FILTER_SANITIZE_NUMBER_INT);
                $item['amount_sub2'] = (float)filter_var($data['amount_sub2'], FILTER_SANITIZE_NUMBER_INT);
                $item['acknowlegde_id'] = $data['acknowlegde_id'];

                
                return $item;                                              
            }
            else{
                $httpCode = 404;
            }
            return $this->mapResponseMsg($httpCode, 404, $data['message']);

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
            $url = env('CHECK_SUM_API_PIPAY_MULTIPLE_RECORD');
            // $url = sprintf("%s?%s", $url, http_build_query($form));

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
                if (count($data) > 0) {
                    /// mapping response field
                    $arrs = $data['data'] ;
                    $resData = [];
                    $count = 0;
                    if(count($arrs) > 0){
                        foreach($arrs as $arr){
                            $item = [];
                            $item['transaction_id'] = $arr['transaction_id'];
                            $item['pg_transaction_datetime'] =  Carbon::parse($arr['pg_transaction_datetime'])->format('Y-m-d H:i:s');
                            $item['mpwt_transaction_datetime'] = Carbon::parse($arr['mpwt_transaction_datetime'])->format('Y-m-d H:i:s');
                            $item['currency'] = $arr['currency'];
                            $item['bill_id'] = $arr['bill_id'];
                            $item['bill_id_sub1'] = $arr['bill_id_sub1'];
                            $item['bill_id_sub2'] = $arr['bill_id_sub2'];
                            $item['amount'] = (float)filter_var($arr['amount'], FILTER_SANITIZE_NUMBER_INT);
                            $item['amount_sub1'] = (float)filter_var($arr['amount_sub1'], FILTER_SANITIZE_NUMBER_INT);
                            $item['amount_sub2'] = (float)filter_var($arr['amount_sub2'], FILTER_SANITIZE_NUMBER_INT);
                            $item['acknowlegde_id'] = $arr['acknowlegde_id'];
                            $resData[] = $item;          
                            $count++;                
                        }
                    }
                    
                    $res = [
                        'response_start_mpwt_transaction_datetime' => Carbon::parse($data['response_start_mpwt_transaction_date'])->format('Y-m-d H:i:s'),
                        'response_end_mpwt_transaction_datetime' => Carbon::parse($data['response_end_mpwt_transaction_datetime'])->format('Y-m-d H:i:s'),
                        'total_amount' => (float) filter_var($data['total_amount'], FILTER_SANITIZE_NUMBER_INT),
                        'total_transaction' => $count,
                        'data' => $resData
                    ];                    
                    return $res;
                }
            }
            
            else{
                $httpCode = 404;

            }
            return $this->mapResponseMsg($httpCode, 404, $data['message']);

        } catch (\Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }
}
