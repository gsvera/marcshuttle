<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Paypal;
use App\Models\Respuesta;

class PaypalController extends Controller
{
    public function CheckoutOrder(){
        $resp = new Respuesta;
        $paypal = new Paypal;

        try{
        $resp = $paypal->GetProcess(request('orderId'));
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
}
