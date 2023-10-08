<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;
use App\Models\BookingTrip;
use App\Models\TransferCatalog;

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

    public function getTypeTrip() {
        $resp = new Respuesta;
        $typesTransfer = new TransferCatalog;

        try {
            $resp = $typesTransfer->_GetTransferCatalog();
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());

    }

    public function resendEmailTrip() {
        $resp = new Respuesta;
        $bookingTrip = new BookingTrip;
        try {
            $resp = $bookingTrip->_ResendBookingTrip(request()->all());
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
}
