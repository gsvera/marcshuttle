<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function index()
    {
        if(request()->session()->get('user_auth')){
            return redirect('/admin-marcshuttle/panel');
        }
        return view('admin.login');
    }
    public function login()
    {
        $resp = new Respuesta;
        $user = new Usuario;
        try{
            $resp = $user->_Login(request()->all());

            if($resp->Error == false)
            {
                request()->session()->put('user_auth', $resp->data->id, +120);
                request()->session()->put('name_user', $resp->data->first_name. ' '.$resp->data->last_name, +120);
                return redirect('/admin-marcshuttle/panel');
            }
            else
            {
                return back()->with("message", $resp->Message);
            }
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
    public function logout()
    {
        request()->session()->forget('user_auth');
        request()->session()->forget('name_user');

        return redirect('/admin-marcshuttle/login');
    }
}
