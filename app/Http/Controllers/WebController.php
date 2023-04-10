<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;
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
}
