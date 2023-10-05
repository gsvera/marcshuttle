<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Respuesta;

class AdminController extends Controller
{
    public function Home()
    {
        return view('admin.home');
    }
    public function user() {
        return view('admin.user.index');
    }
    public function zona() {
        return view('admin.zonas.index');
    }
    public function location() {
        return view('admin.locations.index');
    }
    public function tour() {
        return view('admin.tours.index');
    }
    public function vehicle() {
        return view('admin.vehicles.index');
    }
    public function bookingsTripReport() {
        return view('admin.reports.bookings-trip.index');
    }
    public function bookingsTourReport() {
        return view('admin.reports.bookings-tour.index');
    }
}
