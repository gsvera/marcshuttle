<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;
use App\Models\Tour;

class ToursController extends Controller
{
    public function getTours() {
        $resp = new Respuesta;
        $tour = new Tour;
        try{
            $resp = $tour->_GetToursAdmin(request('nameTour'));
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }

    public function saveTour() {
        $resp = new Respuesta;
        $tour = new Tour;
        try {
            $resp = $tour->_SaveTour(request()->all());
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }

    public function getTourById() {
        $resp = new Respuesta;
        $tour = new Tour;
        try{
            $resp = $tour->_GetTourByIdAdmin(request('idTour'));
        } catch(Exception $e){
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }
    public function updateTour() {
        $resp = new Respuesta;
        $tour = new Tour;

        try{
            $resp = $tour->_UpdateTour(request()->all());
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }

    public function getTourOptions() {
        $resp = new Respuesta;
        $tour = new Tour;        

        try {
            $resp = $tour->_GetTourOptions();
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }
}
