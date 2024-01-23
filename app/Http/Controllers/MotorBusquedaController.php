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

    public function MakeBookingTrip()
    {
        $resp = new Respuesta;
        $trip = new BookingTrip;

        try {
            $resp = $trip->_MakeDirectTrip(request()->all());
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }

    public function MakeBookingTripCustom()
    {
        $resp = new Respuesta;
        $tripCustom = new BookingTrip;

        try {
            $resp = $tripCustom->_MakeDirectCustomTrip(request()->all());
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }

    public function MakeBookingTour()
    {
        $resp = new Respuesta;
        $tour = new BookingTour;

        try {
            $resp = $tour->_MakeDirectTour(request()->all());
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = 'Error: '.$e->getMessage();
        }
        return response()->json($resp->getResult());
    }

    public function cotizarTour()
    {
        return view('web.detailTour')->with('idSelected', request('id'));
    }

    public function GetLocation(){
        $resp = new Respuesta;
        $ubicaciones = new Ubicaciones;

        try{
            $resp->data = $ubicaciones->_GetLocations(request('idZone'));            
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }

    public function GetZone()
    {
        $resp = new Respuesta;
        $destination = new Destination;
        
        try {
            $resp->data = $destination->_GetDestinationsAirport();

        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
}
