<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Paypal;
use App\Models\Respuesta;
use App\Models\BookingTrip;
use App\Models\BookingTour;

class PaypalController extends Controller
{
    public function CheckoutOrder(){
        $resp = new Respuesta;
        $paypal = new Paypal;

        try{
            $resp = $paypal->GetProcess(request('orderId'));
            $resp->Error = false;
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
    
    public function CreateOrderTrip() {
        $resp = new Respuesta;
        $booking = new BookingTrip;

        try {
            $resp = $booking->_MakeBookingByPaypal(request()->all());
        } catch (Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }

    public function CreateOrderTour() {
        $resp = new Respuesta;
        $booking = new BookingTour;

        try{ 
            $resp = $booking->_MakeBookingByPaypal(request()->all());
        } catch (Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }
}
