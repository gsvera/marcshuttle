<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use App\Models\Utils;
use App\Models\Respuesta;
use App\Models\Folio;

class BookingTrip extends Model
{
    use HasFactory;
    protected $table = 'bookings_trip';
    public $timestamps = false;

    public function _MakeDirectTour($data)
    {
        $resp = new Respuesta;

        try{
            $response = Http::get('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => env('GOOGLE_PRIVATE_KEY'),
                'response' => $data['gRecaptchaResponse'] 
            ]);
            $body = json_decode($response->getBody());
            
            if (!$body->success){
                $resp->Error = true;
                $resp->Message = __('MotorBusqueda.recaptcha-requerido');
                return $resp;
            }

            $resp = $this->_SaveBookingTrip($data);

            if(!$resp->Error)
            {
                $this->_SendBookingTour($resp->data, 'paid');
            }

        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function SendCustomTrip($data){
        $utils = new Utils;
        $resp = new Respuesta;

        try{
            if($data['g-recaptcha-response'] == "")
            {
                $resp->Error = true;
                $resp->Message = __('MotorBusqueda.recaptcha-requerido');                
            }
            else
            {                                
                $response = Http::get('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => $utils->GetRecaptchaSecret(),
                    'response' => $data['g-recaptcha-response'] 
                ]);
                $body = json_decode($response->getBody());
                
                if (!$body->success){
                    $resp->Error = true;
                    $resp->Message = __('MotorBusqueda.recaptcha-requerido');
                    return back()->with('messageError','El reCAPTCHA es inválido');
                }
                
                $datosMessage = [
                    "firstName"=> $data['firstName'],
                    "lastName" => $data['lastName'],
                    "email"=>$data['email'],
                    "phone"=> $data['phone'],
                    "typetransfer" => $data['typetransfer'],
                    "origin" => $data['origin'],
                    "destination" => $data['destination'],
                    "pax" => $data['pax'],
                    "dateDeparture" => $data['dateDeparture'],
                    "hourDeparture" => $data['hourDeparture'],
                    "comments" => $data['comments'],
                    "host" => $data['urlWeb'],
                    "sillaBebe" => $data['sillaBebe']
                ];

                $resp = $this->SaveCustomTrip($datosMessage);

                if($resp->Error == false)
                {
                    $email = $data['email'];
                    Mail::send('emails.detailTripCustom',['item'=>$datosMessage, 'folio' => $resp->data],function($mensaje) use ($email){
                        $mensaje->to([env('MAIL_USERNAME'), $email])->subject(__('MotorBusqueda.subject-custom'));
                    });
                }                    
            }
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
    public function SaveCustomTrip($data)
    {
        $folio = new Folio;
        $booking = new BookingTrip;        
        $resp = new Respuesta;
        try{
            $folio = $folio->_GetFolio();            
            $folioBooking = $folio->folio .''.$folio->count;

            $booking->folio = $folioBooking;
            $booking->first_name = $data['firstName'];
            $booking->last_name = $data['lastName'];
            $booking->email = $data['email'];
            $booking->phone = $data['phone'];
            $booking->comments = $data['comments'];
            $booking->type_transfer = $data['typetransfer'];
            $booking->origin = $data['origin'];
            $booking->destination = $data['destination'];
            $booking->pax = $data['pax'];
            $booking->departure_date = $data['dateDeparture'];
            $booking->departure_time = $data['hourDeparture'];
            $booking->pay_method = "efectivo";
            $booking->silla_bebe = $data['sillaBebe'];
            $booking->save();

            $folio->count = $folio->count + 1;
            $folio->save();
            
            $resp->Error = false;
            $resp->data = $folioBooking;
            return $resp;
        }
        catch(Exception $e)
        {
            error_log($e->getMessage());
            $resp->Error = true;
            $resp->Message = $e->getMessage();
            return $resp;
        }
    }
    public function SendOneWay($data)
    {
        $utils = new Utils;
        $resp = new Respuesta;

        try{
            // $response = Http::get('https://www.google.com/recaptcha/api/siteverify', [
            //     'secret' => $utils->GetRecaptchaSecret(),
            //     'response' => $data['g-recaptcha-response'] 
            // ]);
            // $body = json_decode($response->getBody());
            
            // if (!$body->success){
            //     $resp->Error = true;
            //     $resp->Message = __('MotorBusqueda.recaptcha-requerido');
            //     return back()->with('messageError','El reCAPTCHA es inválido');
            // }

            $datosMessage = [
                "firstName"=> $data['firstName'],
                "lastName" => $data['lastName'],
                "email"=>$data['email'],
                "phone"=> $data['phoneClient'],
                "comments" => $data['comments'],
                "typetransfer" => $data['typetransfer'],                
                "idZone" => $data['idZone'],
                "nameZone" => $data['nameZone'],                
                "pax" => $data['pax'],
                "host" => $data['urlWeb'],
                "payMethod" => $data['payMethod'],
                "amount" => $data['amount'],
                "sillaBebe" => $data['sillaBebe']
            ];

            if($data['typetransfer'] == 2)
            {
                $datosMessage['origin'] = $data['origin'];
                $datosMessage['destination'] = __('MotorBusqueda.aeropuerto');
            }
            else
            {
                $datosMessage['origin'] = __('MotorBusqueda.aeropuerto');
                $datosMessage['destination'] = $data['destination'];
            }                

            if($data['payMethod'] == 'paypal')
            {
                $datosMessage['orderId'] = $data['orderId'];
            }

            if($data['typetransfer'] == 1 || $data['typetransfer'] == 3)
            {
                $datosMessage['dateArrival'] = $data['dateArrival'];
                $datosMessage['hourArrival'] = $data['hourArrival'];
                $datosMessage['infoArrival'] = $data['infoArrival'];
            }
            if($data['typetransfer'] == 2 || $data['typetransfer'] == 3)
            {
                $datosMessage['dateDeparture'] = $data['dateDeparture'];
                $datosMessage['hourDeparture'] = $data['hourDeparture'];
                $datosMessage['infoDeparture'] = $data['infoDeparture'];
            }
            
            switch($data['typetransfer'])
            {
                case 1:
                    $subject = __('MotorBusqueda.reservacion-aeropuerto-hotel');
                    break;
                case 2:
                    $subject = __('MotorBusqueda.reservacion-hotel-aeropuerto');
                    break;
                case 3:
                    $subject = __('MotorBusqueda.reservacion-redondo-aeropuerto');
                    break;
            }

            $resp = $this->SaveTrip($datosMessage);

            if($resp->Error == false)
            {
                $email = $data['email'];
                
                Mail::send('emails.detailTrip',['item'=>$datosMessage, 'folio' => $resp->data],function($mensaje) use ($email, $subject){
                    $mensaje->to(["gs.vera92@gmail.com", $email])->subject($subject);
                });
            }                    
            
            
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
    public function _SaveBookingTrip($data){
        $folio = new Folio;
        $booking = new BookingTrip;
        $resp = new Respuesta;

        try{            
            $folio = $folio->_GetFolio();            
            $folioBooking = $folio->folio .''.$folio->count;

            $booking->folio = $folioBooking;
            $booking->first_name = $data['firstName'];
            $booking->last_name = $data['lastName'];
            $booking->email = $data['email'];
            $booking->phone = $data['phone'];
            $booking->comments = $data['comments'];
            $booking->id_destination = $data['idZone'];
            $booking->type_transfer = $data['typetransfer'];
            $booking->pax = $data['pax'];            
            $booking->pay_method = $data['payMethod'];
            $booking->amount = $data['amount'];
            $booking->silla_bebe = $data['sillaBebe'];
            
            if($data['typetransfer'] == 1 || $data['typetransfer'] == 3)
            {
                $booking->arrival_date = $data['dateArrival'];
                $booking->arrival_time = $data['hourArrival'];
                $booking->arrival_info = $data['infoArrival'];
            }
            if($data['typetransfer'] == 2 || $data['typetransfer'] == 3)
            {
                $booking->departure_date = $data['dateDeparture'];
                $booking->departure_time = $data['hourDeparture'];
                $booking->departure_info = $data['infoDeparture'];
            }

            if($data['typetransfer'] == 1 || $data['typetransfer'] == 3)
            {
                $booking->destination = $data['destination'];
            }
            else
            {
                $booking->origin = $data['origin'];
            }

            if($data['payMethod'] == 'card')
            {
                $booking->order_id = $data['orderId'];
                $booking->checkout_id = $data['checkoutId'];
                $booking->status_pay = 0;
            }
            else
            {
                $booking->status_pay = 1;
            }
            
            $booking->save();

            $folio->count = $folio->count + 1;
            $folio->save();

            $resp->Error = false;
            $resp->data = $booking;
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
    public function _UpdateBookingTripByConektaData($checkoutId, $orderId, $statusPay)
    {
        $resp = new Respuesta;
        try {
            $booking = $this->where('order_id', $orderId)->where('checkout_id', $checkoutId)->first();
            // SIGNIFICADO DEL STATUS DE PAGO: 1 => PAGADO, 2 => PAGO PENDIENTE, -1 => ERROR EN PAGO, 0 => PENDIETE
            switch($statusPay) {
                case 'paid':
                    $booking->status_pay = 1;
                    break;
                case 'pending_payment':
                    $booking->status_pay = 2;
                    break;
                case 'error':
                    $booking->status_pay = -1;
                    break;
            }
            $booking->save();
            $datos = [
                "lang" => $booking->lang,
                "statusPay" => $booking->status_pay,
                "folio" => $booking->folio
            ];

            
            if($booking->status_pay != -1 && $booking->email_confirm == 0)
            {
                $this->_SendBookingTour($booking, $statusPay);
                $booking->email_confirm = 1;
                $booking->save();
            }
            $resp->Error = false;
            $resp->data = $datos;

        } catch(Exception $e) {
            $res->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }

    public function _SendBookingTour($booking, $statusPay)
    {
        $resp = new Respuesta;
        $destination = new Destination;
        $subject = "";

        try {   
            switch($booking->type_transfer)
            {
                case 1:
                    $subject = __('MotorBusqueda.reservacion-aeropuerto-hotel');
                    break;
                case 2:
                    $subject = __('MotorBusqueda.reservacion-hotel-aeropuerto');
                    break;
                case 3:
                    $subject = __('MotorBusqueda.reservacion-redondo-aeropuerto');
                    break;
            }

            $copia = env('MAIL_USERNAME');
            $email = $booking->email;
            $nameZone = $destination->_GetDestinationById($booking->id_destination)->name;

            Mail::send('emails.detailTrip',
                [
                    'item'=>$booking,
                    'folio' => $booking->folio,
                    'typetransfer' => $subject,
                    'nameZone' => $nameZone,
                    'statusPay' => $statusPay
                ], function($mensaje) use ($copia, $email, $subject){
                    $mensaje->to([$copia, $email])->subject($subject);
                }
            );
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }
}
