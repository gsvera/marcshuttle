<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConektaModel;
use App\Models\Respuesta;
use App\Models\BookingTour;
use App\Models\BookingTrip;
use App\Models\Tour;
use App\Models\TransferCatalog;
use App;

class ConektaController extends Controller
{
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

    public function MakePayByTransfer()
    {
        $conekta = new ConektaModel;
        $resp = new Respuesta;
        $bookingTrip = new BookingTrip;
        $lang = App::getLocale();
        $newRegister = request()->all();

        try {
            $customer = [
                "name" => request('firstName').' '.request('lastName'),
                "email" => request('email')
            ];

            $resp = $conekta->_MakeCustomer($customer);

            if(!$resp->Error)
            {
                $typeTransfer = new TransferCatalog;
                $typeTransfer = $typeTransfer->_GetTransferCatalogById(request('typetransfer'));
                $nameTransfer = $typeTransfer->name_es;
                $nameDetail = __('MotorBusqueda.zona') . ': ' . request('nameZone');

                if($lang == 'en')
                {
                    $nameTransfer = $typeTransfer->name_en;
                }

                if(request('typetransfer') == 1 && request('typetransfer') == 3)
                {
                    $nameDetail = $nameDetail . __('MotorBusqueda.destino') . ': ' . request('destination');
                }
                else if(request('typetransfer') == 2)
                {
                    $nameDetail = $nameDetail . __('MotorBusqueda.origen') . ': ' . request('origin');
                }

                $transferDetail = [
                    "name" => __('MotorBusqueda.type-transfer') . ': '. $nameTransfer . ', ' . $nameDetail,
                    "unit_price" => request('amount')."00", // SE AGREGA 2 CEROS MAS POR QUE CONEKTA RECIBE DECIMALES 
                    "quantity" => 1
                ];

                $resp = $conekta->_MakeOrderConekta($resp->data["id"], $transferDetail, 'transfer');

                if($resp->data['object'] == "error") {
                    $resp->Error = true;
                    $resp->Message = __('Message.error-conekta');
                } else {
                    $newRegister["checkoutId"] = $resp->data["checkout"]["id"];
                    $newRegister["orderId"] = $resp->data["id"];
                    $resp->Error = $bookingTrip->_SaveBookingTrip($newRegister)->Error;
                }
            }

        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }

    public function ResponseConektaTour() 
    {        
        $resp = new Respuesta;
        $bookingTour = new BookingTour;
        $lang = App::getLocale();
        $routeLang = 'es-gracias';
        try {
            $resp = $bookingTour->_UpdateBookingByConektaData(request('checkout_id'), request('order_id'), request('payment_status'));

            if($lang == 'en')
            {
                $routeLang = 'en-thanks';
            }

            if($resp->data["statusPay"] != -1)
            {                
                return redirect()->route($routeLang, ['folio' => $resp->data['folio']]);
            }
            else{
                return view('web.error');
            }
        } catch(Exception $e) {
            return view('web.error');
        }
    }

    public function ResposeConektaTransfer()
    {
        $resp = new Respuesta;
        $bookingTrip = new BookingTrip;
        $lang = App::getLocale();
        $routeLang = 'es-gracias';
        try {
            $resp = $bookingTrip->_UpdateBookingTripByConektaData(request('checkout_id'), request('order_id'), request('payment_status'));

            if($lang == 'en')
            {
                $routeLang = 'en-thanks';
            }

            if($resp->data["statusPay"] != -1)
            {                
                return redirect()->route($routeLang, ['folio' => $resp->data['folio']]);
            }
            else{
                return view('web.error');
            }
        } catch(Exception $e) {
            return view('web.error');
        }
    }

    public function ErrorResponse()
    {
        return view('web.error');
    }
}
