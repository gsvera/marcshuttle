<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConektaModel;
use App\Models\Respuesta;
use App\Models\BookingTour;
use App\Models\Tour;

class ConektaController extends Controller
{
    public function CreateCustomerConekta()
    {
        $conekta = new ConektaModel;
        
        try {
            $resp = $conekta->_MakeCustomer();

            if(!$resp->Error) {
                $resp = $conekta->_MakeOrderConekta($resp->data["id"]);
            }
        }
        catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        
        return response()->json($resp->getResult());
    }

    function MakePayByTour()
    {
        $conekta = new ConektaModel;
        $resp = new Respuesta;
        $bookingTour = new BookingTour;
        
        try { 
            $newRegister = request()->all();
            $customer = [
                "name" => $newRegister['firstName']. ' '.$newRegister['lastName'],
                "email" => $newRegister['email']
            ];
            $resp = $conekta->_MakeCustomer($customer);

            if(!$resp->Error) {
                $tour = new Tour;
                $tourRegister = $tour->GetTourById($newRegister['idTour'])->data;                
                $tourDetail = [
                    "name" => $tourRegister->name,
                    "unit_price" => $newRegister['totalAmount']."00", // SE AGREGA 2 CEROS MAS POR QUE CONEKTA RECIBE DECIMALES 
                    "quantity" => 1
                ];

                $resp = $conekta->_MakeOrderConekta($resp->data["id"], $tourDetail, 'tour');

                if($resp->data['object'] == "error") {
                    $resp->Error = true;
                    $resp->Message = __('Message.error-conekta');
                } else {
                    $newRegister["checkoutId"] = $resp->data["checkout"]["id"];
                    $newRegister["orderId"] = $resp->data["id"];
                    $resp->Error = $bookingTour->_SaveBookingtour($newRegister)->Error;
                }
            }

        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }

    public function ResponseConekta() 
    {
        $bookingTour = new BookingTour;
        $resp = new Respuesta;        
        try {
            $resp = $bookingTour->_UpdateBookingByConektaData(request('checkout_id'), request('order_id'), request('payment_status'));

            if($resp->data["statusPay"] == -1)
            {                
                return view('web.error');
            }
        } catch(Exception $e) {
            return view('web.error');
        }
        return redirect()->route('es-gracias', ['folio' => $resp->data['folio']]);
    }


    // FUNCTION DEPRECADO 
    public function ProcesarPago() 
    {
        Conekta::setApiKey(env('CONEKTA_SECRET_KEY'));

        try {
            $charge = \Conekta\Charge::create([
                'amount' => 20000, // Monto en centavos
                'currency' => 'MXN',
                'description' => 'Compra en línea',
                'reference_id' => 'orden_12345',
                'card' => request('conektaTokenId'), // Token generado por Conekta.js
                'details' => [
                    'name' => request('nombre'),
                    'email' => request('email'),
                ]
            ]);

            return response()->json($charge);
        } catch(Exception $e) {

        }
    }
}
