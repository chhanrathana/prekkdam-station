<?php

namespace App\Services\Api\CheckSums;

error_reporting(E_ALL);
ini_set('default_socket_timeout', 600);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('soap.wsdl_cache_enabled', 0);
ini_set('soap.wsdl_cache_ttl', 0);


class AcledaCheckSumService 
{


    private function mapResponseMsg($httpCode, $code, $message)
    {

        if ($httpCode == 401) {
            $message = 'Invalid rsa-key or Client Code or Action Code';
        } elseif ($httpCode == 400) {
            $message = 'In Case query greater than 7 days';
        } elseif ($httpCode == 404) {
            $message = 'Not found';
        } elseif ($httpCode == 500) {
            $message = 'Server Error';
            
        }
        // $message .= $message . '|PG Code :: ' . $code;

        return response()->json([
            'code' => $httpCode,
            'message' => $message,
        ], $httpCode);
    }

    public function getSingleRecord($referenceNumber)
    {
        try {
            $par = [
                'request' => [
                    'bill_id' => $referenceNumber,
                ],
            ];
            $data = (array) $this->soapReqeust($par, 'singleRecord');
            
            if($data['bill_id'] != ''){
                unset($data['statusRes']);
                return $data;
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
            
            $par = [
                'request' => [
                    'start_mpwt_transaction_datetime' => $startDatetime,
                    'end_mpwt_transaction_datetime' => $endDatetime,
                ],
            ];
            $data = (array) $this->soapReqeust($par, 'multipleRecord');
            
            if($data['total_transaction'] > 0){
                
                $data['response_start_mpwt_transaction_datetime'] = $data['response_start_mpwt_transaction_date'];
                $data['response_end_mpwt_transaction_datetime'] = $data['response_end_mpwt_transaction_date'];
                
                unset($data['statusRes']);
                unset($data['response_start_mpwt_transaction_date']);
                unset($data['response_end_mpwt_transaction_date']);
                
                return $data;
            }
            $httpCode = 404;
            return $this->mapResponseMsg($httpCode, $httpCode, 'Not found');
                       
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return $error;
        }
    }

    private function soapReqeust($parm, $method)
    {
        try {
            $url = env('CHECK_SUM_API_ACLEDA');
            $location = env('CHECK_SUM_API_ACLEDA_LOCATION');
            $arg = [
                'trace' => true, 
                'keep_alive' => false,
                'exceptions' => true,
                'location' => $location,
                'soap_version' => SOAP_1_1,
                'login' => env('CHECK_SUM_API_ACLEDA_AUTH_USER'),
                'password' => env('CHECK_SUM_API_ACLEDA_AUTH_PWD'),                
                'stream_context' => stream_context_create([
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ]),
            ];
            $client = new \SoapClient($url, $arg);
            $res = $client->$method($parm);
            return $res;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}