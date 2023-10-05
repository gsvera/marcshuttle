<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;
use App\Models\Usuario;
use App\Models\ResetPassword;


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

    public function ForgetPasswordView(){
        return view('admin.forget-password');
    }

    public function sendTokenResetPassword(){
        $resp = new Respuesta;
        $usuario = new Usuario;
        try{
            $resp = $usuario->_sendTokenResetPassword(request('email'));
        }
        catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
    public function resetPasswordView() {
        return view('admin.reset-password')->with('token', request('token'));
    }
    public function saveNewResetPassword() {
        $resp = new Respuesta;
        $user = new Usuario;
        $resetPassword = new ResetPassword;

        try{            
            $resp = $resetPassword->_FindToken(request('token'));
            
            if($resp->Error == false) {
                $resp = $user->_UpdatePasswordForget($resp->data, request('newPassword'));
            }
            else {
                $resp->Message = "No se pudo actualizar la contraseña, intente mas tarde por favor.";
            }
        } catch(Exeption $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
}
