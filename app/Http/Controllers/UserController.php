<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Respuesta;
use App\Models\Perfil;
use App\Models\Utils;

class UserController extends Controller
{
    public function getUsers() {
        $resp = new Respuesta;
        $usuario = new Usuario;
        try{
            $resp = $usuario->_GetUsers();

        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
    public function getProfiles() {
        $resp = new Respuesta;
        $profiles = new Perfil;

        try {
            $resp->data = $profiles->_GetProfiles();
            $resp->Error = false;
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }
    public function CreateUser()
    {        
        $usuario = new Usuario;
        $resp = new Respuesta;

        try{      
            $resp = $usuario->_CrearUsuario(request()->all());
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }        

        return response()->json($resp->getResult());
    }
    public function UpdateUser() {
        $usuario = new Usuario;
        $resp = new Respuesta;

        try{ 
            $resp = $usuario->_UpdateUser(request()->all());
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
    public function getUserById() {
        $resp = new Respuesta;
        $usuario = new Usuario;

        try {
            $resp = $usuario->_GetUserById(request('id'));
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }
    public function EnabledDisableUser(){
        $resp = new Respuesta;
        $usuario = new Usuario;

        try{
            $resp = $usuario->_EnabledDisableUser(request('id'), request('estatus'));
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
    public function GetCurrentUser() {
        $resp = new Respuesta;
        $usuario = new Usuario;
        try{ 
            $resp = $usuario->_GetCurrentUser(request()->session()->get('user_auth'));
        } catch(Exception $e){
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
    public function UpdateCurrentUser() {
        $resp = new Respuesta;
        $usuario = new Usuario;

        try{ 
            $idUser = request()->session()->get('user_auth');
            $resp = $usuario->_UpdateCurrentUser($idUser, request()->all());
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }

    public function ChangePassword() {
        $resp = new Respuesta;
        $usuario = new Usuario;

        try{
            $resp = $usuario->_ChangePassword(request()->session()->get('user_auth'), request('currentPassword'), request('newPassword'));
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }

    public function validPermision () {
        $resp = new Respuesta;

        try {
            $resp->data = Utils::validPermision(request()->session()->get('permisos'), config('ListPermision.'.request('permiso')));

        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return response()->json($resp->getResult());
    }
}
