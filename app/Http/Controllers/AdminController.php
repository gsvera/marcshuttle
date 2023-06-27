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
    public function NuevoUsuario()
    {
        return view('admin.newuser');
    }
    public function CreateUser()
    {        
        $Usuario = new Usuario;
        $resp = new Respuesta;

        try{
            $datos = json_decode(request('usuario'), true);      
            $resp = $Usuario->_CrearUsuario($datos);            
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }        

        return response()->json($resp->getResult());
    }
}
