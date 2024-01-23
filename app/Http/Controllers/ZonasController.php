<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;
use App\Models\Destination;

class ZonasController extends Controller
{
    public function getZonas() {
        $resp = new Respuesta;
        $destination = new Destination;
        try {
            $resp = $destination->_GetAllDestinationsAirport(request('namezona'));

        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }

    public function createZona() {
        $resp = new Respuesta;
        $destination = new Destination;

        try{
            $resp = $destination->_CreateDestination(request()->all());
        }
        catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }

    public function getZonaById() {
        $resp = new Respuesta;
        $destination = new Destination;

        try{
            $resp = $destination->_GetDestinationByIdAdmin(request('id'));
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }

    public function updateZona() {
        $resp = new Respuesta;
        $destination = new Destination;

        try {
            $resp = $destination->_UpdateZona(request()->all());
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }
}
