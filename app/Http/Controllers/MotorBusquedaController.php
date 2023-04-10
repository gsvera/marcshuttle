<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;
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
            if($typetransfer == 1)
            {
                $objDestination = $objDestination->GetDestination(request('zone'));
                
                return view('web.detailTrip', ["objDestination"=>$objDestination, "destination"=>$destination, "dateArrival"=>$dateArrival, "typetransfer"=>$typetransfer, "pax"=>$pax ]);
            }
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        
    }
}
