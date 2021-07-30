<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    const API_URL = 'http://localhost:8000/api/';

    public function post($url, $data)
    {
        $fields_string = http_build_query($data);
        $curl = curl_init();

        curl_setopt($curl,CURLOPT_URL, $url);
        curl_setopt($curl,CURLOPT_POST, true);
        curl_setopt($curl,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    public function get($url)
    {
        $curl = curl_init();

        curl_setopt($curl,CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}