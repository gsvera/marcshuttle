<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use App\Models\Respuesta;
use App\Models\Utils;
use App\Models\Destination;

class MotorBusquedaController extends Controller
{
    public function detailTrip(){
        $resp = new Respuesta;
        $objDestination = new Destination();
        $pax=request('pax');
        $origin=request('origin');
        $destination=request('destination');
        $typetransfer = request('typetransfer');
        $dateArrival=request('datearrival');
        $dateDeparture=request('datedeparture');

        try{    
            if(request('zone') != 4)
            {
                $objDestination = $objDestination->GetDestination(request('zone'));
            }

            if($typetransfer == 1)
            {   
                return view('web.detailTrip', ["objDestination"=>$objDestination, "destination"=>$destination, "dateArrival"=>$dateArrival, "typetransfer"=>$typetransfer, "pax"=>$pax ]);
            }
            if($typetransfer == 2)
            {
                return view('web.detailTrip', ["objDestination"=>$objDestination, "origin"=>$origin, "dateDeparture"=>$dateDeparture,"typetransfer"=>$typetransfer, "pax"=>$pax]);
            }
            if($typetransfer == 3)
            {
                return view('web.detailTrip', ["objDestination"=>$objDestination, "destination"=>$destination, "dateArrival"=>$dateArrival, "dateDeparture"=>$dateDeparture, "typetransfer"=>$typetransfer, "pax"=>$pax]);
            }
            if($typetransfer == 4)
            {
                return view('web.detailTripCustom', ["destination"=>$destination, "origin"=>$origin, "dateDeparture"=>$dateDeparture,"typetransfer"=>$typetransfer, "pax"=>$pax]);
            }
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        
    }

    public function SendCustomTrip(){
        $resp = new Respuesta;
        $utils = new Utils;

        try{         
                                            
            if(request('g-recaptcha-response') == "")
            {
                $resp->Error = true;
                $resp->Message = __('MotorBusqueda.recaptcha-requerido');                
            }
            else{                                
                $response = Http::get('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => $utils->GetRecaptchaSecret(),
                    'response' => request('g-recaptcha-response') 
                ]);
                $body = json_decode($response->getBody());
                
                if (!$body->success){
                    $resp->Error = true;
                    $resp->Message = __('MotorBusqueda.recaptcha-requerido');
                    //return response()->json($resp->getResult());
                    return back()->with('messageError','El reCAPTCHA es inválido');
                }
                
                $datosMessage = [
                    "fullName"=> request('fullName'),
                    "email"=>request('email'),
                    "phone"=> request('phone'),
                    "typetransfer" => request('typetransfer'),
                    "origin" => request('origin'),
                    "destination" => request('destination'),
                    "pax" => request('pax'),
                    "dateDeparture" => request('dateDeparture'),
                    "hourDeparture" => request('hourDeparture'),
                    "comments" => request('comments'),
                    "host" => request('urlWeb')
                ];

                Mail::send('emails.detailTripCustom',['item'=>$datosMessage],function($mensaje){
                    $mensaje->to(["gs.vera92@gmail.com", request('email')])->subject(__('MotorBusqueda.subject-custom'));
                });

                $resp->Error = false;
                $resp->Message = "ok";
                
                return view('web.thanks');
            }
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
}
