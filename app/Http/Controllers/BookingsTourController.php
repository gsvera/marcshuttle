<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;
use App\Models\BookingTour;

class BookingsTourController extends Controller
{
    public function getBookingsTourReport() {
        $resp = new Respuesta;
        $bookingTour = new BookingTour;

        try {
            $resp = $bookingTour->_GetBookingsTour(request()->all());
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }

    public function resendEmailTour() {
        $resp = new Respuesta;
        $bookingTour = new BookingTour;

        try{
            $resp = $bookingTour->_ResendBookingTour(request()->all());
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }
}
