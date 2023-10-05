<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;
use App\Models\Destination;
use App\Models\Ubicaciones;

class UbicacionesController extends Controller
{
    public function getLocations() {
        $resp = new Respuesta;
        $ubicaciones = new Destination;

        try {
            $resp = $ubicaciones->_GetZonasLocations(request('nameZona'));
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }

    public function getLocationsByIdZona(){
        $resp = new Respuesta;
        $ubicaciones = new Destination;

        try{
            $resp = $ubicaciones->_GetZonaLocationsById(request('id'));
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }

    public function createLocation() {
        $resp = new Respuesta;
        $ubicacion = new Ubicaciones;

        try{
            $resp = $ubicacion->_CreateLocation(request('nameLocation'), request('idZona'));
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }

    public function updateLocation() {
        $resp = new Respuesta;
        $ubicacion = new Ubicaciones;

        try {
            $resp = $ubicacion->_UpdateLocation(request()->all());
        }
        catch(Exception $e){
            $resp->Error = true;
            $resp->Message = $e->getResult();
        }

        return response()->json($resp->getResult());
    }
}
