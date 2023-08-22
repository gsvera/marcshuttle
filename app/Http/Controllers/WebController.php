<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;
use App\Models\BookingTour;
use App;

class WebController extends Controller
{
    public function ChangeLenguage()
    {
        $resp = new Respuesta;
        try{
            
            request()->session()->put('lang', request('lang'));
            App::setLocale(request('lang'));
            $resp->setResult(false, "Se cambio el idioma correctamente", 
            ["locale" => App::getLocale(), 
            "session" => session('lang')]);
        }
        catch(Exception $e)
        {
            $resp->setResult(true, $e->getMessage(), "");
        }        
        return response()->json($resp->getResult());
    }

    public function motorbusqueda()
    {
        return view('web.componentes.motorBusqueda');
    }
    public function about()
    {
        return view('web.about');
    }
    public function playaDelCarmen()
    {
        return view('web.destinations.playaDelCarmen');
    }
    public function tulum()
    {
        return view('web.destinations.tulum');
    }
    public function bacalar()
    {
        return view('web.destinations.bacalar');
    }
    public function tours()
    {
        return view('web.tours');
    }
    public function gracias()
    {
        $lang = App::getLocale();
        $bookingTour = new BookingTour;
        try{
            
            if(request('checkout_id') && request('order_id') && request('payment_status')) {
                $resp = $bookingTour->_UpdateBookingByConektaData(request('checkout_id'), request('order_id'), request('payment_status'));

                return view('web.thanks')->with('folio', $resp->data['folio']);
            }
            else {
                if($lang == 'es')
                {
                    return redirect('/');
                }
                else
                {
                    return redirect('/en');
                }
            }
        } catch ( Exception $e ) {
            return view('web.error');
        }
    }
}
