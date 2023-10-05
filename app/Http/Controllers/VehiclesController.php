<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;
use App\Models\Vehicle;

class VehiclesController extends Controller
{
    public function getVehicles() {
        $resp = new Respuesta;
        $vehicles = new Vehicle;
        try{
            $resp = $vehicles->_GetVehicles();
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
    public function getVehicleById() {
        $resp = new Respuesta;
        $vehicle = new Vehicle;

        try { 
            $resp = $vehicle->_GetVehicleById(request('idVehicle'));
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
    public function saveVehicle() {
        $resp = new Respuesta;
        $vehicle = new Vehicle;

        try {
            $resp = $vehicle->_SaveVehicle(request()->all());
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
    public function updateVehicle() {
        $resp = new Respuesta;
        $vehicle = new Vehicle;

        try {
            $resp = $vehicle->_UpdateVehicle(request()->all());
        } catch(Exception $e) {
            $resp->Error = true;
            $res->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
}
