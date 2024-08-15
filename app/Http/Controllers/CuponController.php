<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Respuesta;
use App\Models\Cupones;

class CuponController extends Controller
{
    public function saveCupon(){
        $resp = new Respuesta;
        $cupon = new Cupones;
        try{
            $resp = $cupon->_SaveCupon(request()->all());
        }catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }

    public function getCupon(){
        $resp = new Respuesta;
        $cupon = new Cupones;
        try{
            $resp = $cupon->_GetCupon();
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }

    public function EnabledDisabledCupon() {
        $resp = new Respuesta;
        $cupon = new Cupones;
        try{
            $resp = $cupon->_EnabledDisabledCupon(request('id'), request('active'));
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }

    public function DeleteCupon(){ 
        $resp = new Respuesta;
        $cupon = new Cupones;
        try{
            $resp = $cupon->_DeleteCupon(request('id'));
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
    public function GetById() {
        $resp = new Respuesta;
        $cupon = new Cupones;
        try{
            $resp = $cupon->_GetById(request('id'));
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
    public function UpdateCupon() {
        $rep = new Respuesta;
        $cupon = new Cupones;
        try{
            $resp = $cupon->_UpdateCupon(request()->all());
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return response()->json($resp->getResult());
    }
}
