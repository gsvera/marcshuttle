<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use App\Models\Respuesta;

class Paypal extends Model
{
    use HasFactory;
    private function HttpRequestTokenPaypal()
    {
        try{
            $client = Http::asForm()->withHeaders([
                    "Accept" => "application/json",
                    "Content-Type" => "application/x-www-form-urlencoded"
                ])->withBasicAuth(env('PAYPAL_CLIENT_ID'), env('PAYPAL_SECRET'))
                ->post(env('PAYPAL_API').'/v1/oauth2/token', [
                    'grant_type' => 'client_credentials'
                ]);
                $data = json_decode($client->getBody(), true);
            return $data["access_token"];
        }
        catch(Exception $e)
        {
            return "Exception: ".$e->getMessage();
        }
    }
    public function GetProcess($orderID)
    {
        $resp = new Respuesta;
        $accesToken = $this->HttpRequestTokenPaypal();
        try{
            $response = Http::withHeaders(["Accept" => "application/json",])->withToken($accesToken)
            ->get(env('PAYPAL_API').'/v2/checkout/orders/'.$orderID);
    
            $resp->data = json_decode($response->getBody(), true);
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
}
