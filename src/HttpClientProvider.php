<?php

namespace NativeProviders;

class HttpClientProvider {
    public function get($endpoint, $options = null){
        return $this->curl($endpoint, 'get', $options);
    }

    private function curl($endpoint, $method, ?array $options = null){
        $curl = curl_init($endpoint);

        if(!empty($options['header'])){
            curl_setopt($curl, CURLOPT_HTTPHEADER, $options['header']);
        }

        if(!empty($options['nossl'])){
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        $requestInfo = curl_getinfo($curl);

        curl_close($curl);

        return [
            'body' => json_decode($response, true),
            'info' => $requestInfo
        ];
    }
}

