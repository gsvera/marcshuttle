<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Models\Respuesta;
use App\Models\Tour;
use App\Models\Utils;
use App\Models\Vehicle;
use App\Models\Folio;
use App;

class BookingTour extends Model
{
    use HasFactory;

    protected $table = 'bookings_tour';
    public $timestamps = false;

    public function _MakeDirectTour($data)
    {
        $resp = new Respuesta;
        $tour = new Tour;
        $vehicle = new Vehicle;
        $utils = new Utils;

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

            $tour = $tour->GetTourById($data['idTour'])->data;
            $vehicle = $vehicle->GetVehicleById($data['idVehicle']);
    
            $resp = $this->_SaveBookingtour($data);            
    
            if($resp->Error == false)
            {
                $this->_SendBookingTour($resp->data, 'pendiente');
            }
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _SaveBookingtour($data)
    {
        $resp = new Respuesta;
        $folio = new Folio;
        $bookingTour = new BookingTour;

        try{
            $lang = App::getLocale();

            $folio = $folio->_GetFolioTour();
            $folioBooking = $folio->folio .''.$folio->count;

            $bookingTour->folio = $folioBooking;
            $bookingTour->first_name = $data['firstName'];
            $bookingTour->last_name = $data['lastName'];
            $bookingTour->email = $data['email'];
            $bookingTour->phone = $data['phone'];
            $bookingTour->departure_date = $data['dateDeparture'];
            $bookingTour->departure_time = $data['hourDeparture'];
            $bookingTour->comments = $data['comments'];
            $bookingTour->pay_method = $data['payMethod'];
            $bookingTour->amount = $data['totalAmount'];
            $bookingTour->id_tour = $data['idTour'];
            $bookingTour->id_vehicle = $data['idVehicle'];
            $bookingTour->silla_bebe = $data['sillaBebe'];
            $bookingTour->lang = $lang;

            if($data['payMethod'] == "card")
            {
                $bookingTour->order_id = $data['orderId'];
                $bookingTour->status_pay = 1;
                $bookingTour->payer_id = $data['payerId'];  // Campos para paypal
                $bookingTour->payment_id = $data['paymentId'];  // Campos para paypal
                $bookingTour->status_paypal = $data['statusPaypal']; // Campos para paypal
            }
            else 
            {
                $bookingTour->status_pay = 0;
            }

            $bookingTour->save();
            
            $folio->count = $folio->count + 1;
            $folio->save();

            $resp->Error = false;
            $resp->data = $bookingTour;
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }
    public function _UpdateBookingByConektaData($checkoutId, $orderId, $statusPay)
    {
        $resp = new Respuesta;
        try{
            $booking = $this->where('order_id',$orderId)->where('checkout_id', $checkoutId)->first();
            // SIGNIFICADO DEL STATUS DE PAGO EN CONEKTA: 1 => PAGADO, 2 => PAGO PENDIENTE, -1 => ERROR EN PAGO, 0 => PENDIETE
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
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }

    public function _MakeBookingByPaypal($data) {
        $resp = new Respuesta;
        try{
            $resp = $this->_SaveBookingtour($data);

            if(!$resp->Error) {
                $this->_SendBookingTour($resp->data, $data['statusPaypal']);
            }
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _SendBookingTour($booking, $statusPay) {
        $resp = new Respuesta;
        $tour = new Tour;
        $vehicle = new Vehicle;
        
        try{
            $tour = $tour->GetTourById($booking->id_tour)->data;
            $vehicle = $vehicle->GetVehicleById($booking->id_vehicle);

            $copia = env('MAIL_USERNAME');
            $email = $booking->email;
            $subject = __('Tours.tour-reservado');
            
            Mail::send('emails.detailTour', 
                [
                    'item'=>$booking,
                    'tour'=>$tour, 
                    'vehicle' => $vehicle,
                    'folio' => $booking->folio,
                    'statusPay' => $statusPay
                ], function($mensaje) use ($copia, $email, $subject) {
                    $mensaje->to([$copia, $email])->subject($subject);
                }
            );
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _GetBookingsTour($params) {
        $resp = new Respuesta;

        try {
            $query = $this->leftJoin('tour as t', 'bookings_tour.id_tour', 't.id');

            if(!is_null($params['dateDepartureStart'])) {
                $query->where('departure_date', '>=', $params['dateDepartureStart']);
            }

            if(!is_null($params['dateDepartureEnd'])) {
                $query->where('departure_date', '<=', $params['dateDepartureEnd']);
            }

            if($params['toursSelect'] != 0) {
                $query->where('id_tour', $params['toursSelect']);
            }

            if($params['payMethod'] != '0') {
                $query->where('pay_method', 'like', '%'.$params['payMethod'].'%');
            }

            $resp->data = $query->select('bookings_tour.*', 't.name as tour_name')->get();
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _ResendBookingTour($data) {
        $resp = new Respuesta;

        try {
            $bookingTour = $this->find($data['idReservation']);
            $bookingTour->email = $data['email'];
            
            $resp = $this->_SendBookingTour($bookingTour, $bookingTour->status_pay);

        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }
}
