<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;
use App\Models\BookingTrip;

class BookingsTripController extends Controller
{
    public function getBookinsgTripReport() {
        $resp = new Respuesta;
        $booking = new BookingTrip;

        try {
            $resp = $booking->_getBookingsTrip(request()->all());
        } catch(Exception $e) {
            $resp->Error = true;
            $res->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
}
