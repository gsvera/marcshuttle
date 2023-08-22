<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use App;

class ConektaModel extends Model
{
    use HasFactory;

    public function _MakeCustomer($customer) {
        $resp = new Respuesta;

        try{
            $params = [
                "name"=> $customer['name'],
                "email" => $customer['email']
            ];

            $client = Http::withToken(env('CONEKTA_SECRET_KEY'))
                ->withHeaders([
                    'Accept-Language' => 'es',
                    'Accept' => 'application/vnd.conekta-v2.0.0+json',
                    'content-type' => 'application/json'
                ])
                ->post(env('CONEKTA_API').'customers', $params);

            $resp->data = json_decode($client->getBody(), true);

        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Messate = $e->getMessage();
        }

        return $resp;
    }

    public function _MakeOrder( $customerId, $items = [], $currency = 'MXN' ) {
        $resp = new Respuesta;

        try {
            $params = [
                "currency" => $currency,
                "customer_info" => array(
                    "customer_id" => $customerId
                ),
                "line_items" => array(
                    array(
                        "name" => "Item prueba",
                        "unit_price" => 12300,
                        "quantity" => 1
                    )
                ),
                "shipping_lines" => array(
                    array(
                        "amount" => 0
                    )
                ),
                "checkout" => array(
                    // "type" => "Integration",
                    "allowed_payment_methods" => array("card", "bank_transfer"),
                    // "success_url" => "http://127.0.0.1:8001",
                    // "failure_url" => "http://127.0.0.1:8001",
                    // "monthly_installments_enabled"=> true,
                    // "monthly_installments_options" => array(0),
                    // "redirection_time" => 4
                )
                
            ];
            
            $client = Http::withToken(env('CONEKTA_SECRET_KEY'))
                ->withHeaders([
                    'Accept-Language' => 'es',
                    'Accept' => 'application/vnd.conekta-v2.0.0+json'
                ])
                ->post(env('CONEKTA_API').'orders', $params);

            $resp->data = json_decode($client->getBody(), true);

        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _MakeOrderConekta( $customerId, $items, $typeReserve, $currency = 'MXN' ) {
        $resp = new Respuesta;
        $lang = App::getLocale();
        $pathResponse = '/gracias';  
        try {
            if($lang == 'en') {
                $pathResponse = '/en/thanks';
            }

            $params = [
                "currency" => $currency,
                "customer_info" => array(
                    "customer_id" => $customerId
                ),
                "line_items" => array(
                    $items
                ),
                "shipping_lines" => array(
                    array(
                        "amount" => 0
                    )
                ),
                "checkout" => array(
                    "type" => "HostedPayment",
                    "allowed_payment_methods" => array("card"),
                    "success_url" => env('CONKETA_URL_RESPONSE').$pathResponse,
                    "failure_url" => env('CONEKTA_ERROR_RESPONSE'),
                    "redirection_time" => 4
                )
            ];
            
            $client = Http::withToken(env('CONEKTA_SECRET_KEY'))
                ->withHeaders([
                    'Accept-Language' => 'es',
                    'Accept' => 'application/vnd.conekta-v2.0.0+json'
                ])
                ->post(env('CONEKTA_API').'orders', $params);

            $resp->data = json_decode($client->getBody(), true);

        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
}
