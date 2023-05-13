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

class BookingTour extends Model
{
    use HasFactory;

    protected $table = 'bookings_tour';
    public $timestamps = false;

    public function SendBookingTour($data)
    {
        $resp = new Respuesta;
        $tour = new Tour;
        $vehicle = new Vehicle;
        $utils = new Utils;

        try{
            if($data['payMethod'] == "efectivo")
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
            }
    
            $tour = $tour->GetTourById($data['idTour'])->data;
            $vehicle = $vehicle->GetVehicleById($data['idVehicle']);

            $dataMessage = [
                "payMethod" => $data['payMethod'],
                "firstName" => $data['firstName'],
                "lastName" => $data['lastName'],
                "email" => $data['email'],
                "phone" => $data['phone'],
                "dateDeparture" => $data['dateDeparture'],
                "hourDeparture" => $data['hourDeparture'],
                "comments" => $data['comments'],
                "payMethod" => $data['payMethod'],
                "amount" => $data['totalAmount'],
                "idTour" => $data['idTour'],
                "idVehicle" => $data['idVehicle'],
                "sillaBebe" => $data['sillaBebe'],
                "host" => $data['urlWeb']
            ];
    
            if($data['payMethod'] == 'paypal')
            {
                $dataMessage['orderId'] = $data['orderId'];
            }
    
            $resp = $this->SaveBookingtour($dataMessage);            
    
            if($resp->Error == false)
            {
                $copia = env('MAIL_USERNAME');
                $email = $data['email'];
                $subject = __('Tours.tour-reservado');
                
                Mail::send('emails.detailTour',['item'=>$dataMessage, 'tour'=>$tour, 'vehicle' => $vehicle, 'folio' => $resp->data],function($mensaje) use ($copia, $email, $subject){
                    $mensaje->to([$copia, $email])->subject($subject);
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

    public function SaveBookingtour($data)
    {
        $resp = new Respuesta;
        $folio = new Folio;
        $bookingTour = new BookingTour;

        try{
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
            $bookingTour->amount = $data['amount'];
            $bookingTour->id_tour = $data['idTour'];
            $bookingTour->id_vehicle = $data['idVehicle'];
            $bookingTour->silla_bebe = $data['sillaBebe'];

            if($data['payMethod'] == "paypal")
            {
                $bookingTour->paypal_order = $data['orderId'];
            }

            $bookingTour->save();

            
            $folio->count = $folio->count + 1;
            $folio->save();

            $resp->Error = false;
            $resp->data = $folioBooking;
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }
}
