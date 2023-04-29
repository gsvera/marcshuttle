<?php

namespace App\Http\Controllers;
use App;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use App\Models\Respuesta;
use App\Models\Destination;
use App\Models\Ubicaciones;
use App\Models\BookingTrip;
use App\Models\BookingTour;

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

        $lang = App::getLocale();
        $prefijo = "/";

        if($lang == 'en')
        {
            $prefijo = 'en/';
        }
        if($typetransfer == ''){
            return redirect($prefijo);
        }

        try{    
            if($typetransfer != 4)
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

    public function BookingTransfer(){
        $resp = new Respuesta;
        $booking = new BookingTrip;
        $tour = new BookingTour;
        $folio = "";
        try{         

            if(request('typetransfer') == 'tour')
            {
                $resp = $tour->SendBookingTour(request()->all());
            }
            else if(request('typetransfer') == 4)
            {
                $resp = $booking->SendCustomTrip(request()->all());
            }
            else{
                $resp = $booking->SendOneWay(request()->all());
            }

            if($resp->Error == false)
            {
                return view('web.thanks');
            }
            else{
                return back()->with('messageError',$resp->Message);
            }            
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
            return back()->with('messageError',$resp->Message);
        }
    }

    public function cotizarTour()
    {
        return view('web.detailTour')->with('idSelected', request('id'));
    }

    public function GetLocation(){
        $resp = new Respuesta;
        $ubicaciones = new Ubicaciones;

        try{
            $resp->data = $ubicaciones->_GetLocations();            
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
}
