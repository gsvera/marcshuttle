<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;

class ApiHelper extends Model
{
    static function httpRequestPost($url, $params)
    {
        try{
            $client = Http::post($url, $params);
            $response = json_decode($client->getBody(), true);
            return $response;
        }
        catch(Exception $e)
        {
            return "Exception: ".$e->getMessage();
        }
    }

    
}
