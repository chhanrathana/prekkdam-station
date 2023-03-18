<?php

namespace App\Services;


class ApiService
{

    protected function get($url, $auth, $form)
    {                    
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => json_encode($form),
            CURLOPT_HTTPHEADER => [
                "Cache-Control: no-cache",
                "Content-Type: application/json",
                "Authorization: " . $auth,
            ],
        ]);
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        // $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $res = json_decode($response, true);        
        
        return $res;
    }

    protected function post($url, $auth, $form)
    {                    
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($form),
            CURLOPT_HTTPHEADER => [
                "Cache-Control: no-cache",
                "Content-Type: application/json",
                "Authorization: " . $auth,
            ],
        ]);
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        // $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $res = json_decode($response, true);        
        
        return $res;
    }
}