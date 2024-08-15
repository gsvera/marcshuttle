<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Respuesta;
use App\Models\Cupones;
use Carbon\Carbon;

class Cupones extends Model
{
    use HasFactory;
    protected $table = 'cupones';
    public $timestamps = false;

    public function _SaveCupon($newCupon) {
        $resp = new Respuesta;
        try{
            $cupon = new Cupones;
            $cupon->clave = $newCupon['clave'];
            $cupon->amount = $newCupon['amount'];
            $cupon->count = $newCupon['count'];
            $cupon->expiration_date = $newCupon['expiration_date'];
            $cupon->save();
        } catch(Exception $e){
            $resp->Error = true;
            $resp->Message= $e->getMessage();
        }
        return $resp;
    }
    public function _GetCupon(){
        $resp = new Respuesta;
        try{
            $resp->data = $this->get();
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
    public function _EnabledDisabledCupon($id, $active) {
        $resp = new Respuesta;
        try{
            $cupon = $this->where('id',$id)->first();
            $cupon->active = !$active;
            $cupon->save();
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
    public function _DeleteCupon($id){
        $resp = new Respuesta;
        try{
            $cupon = $this->where('id', $id)->first();
            $cupon->delete();
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
    public function _GetById($id) {
        $resp = new Respuesta;
        try{
            $resp->data = $this->where('id', $id)->first();
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
    public function _UpdateCupon($data) {
        $resp = new Respuesta;
        try{
            $cupon = $this->where('id', $data['id'])->first();
            $cupon->clave = $data['clave'];
            $cupon->amount = $data['amount'];
            $cupon->count = $data['count'];
            $cupon->expiration_date = $data['expiration_date'];
            $cupon->active = true;
            $cupon->save();
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Mesage = $e->getMessage();
        }
        return $resp;
    }
    public function _ValidateCupon($cupon){
        $resp = new Respuesta;
        try{
            
            $gotCupon = $this->where('clave', $cupon['cupon'])->first();
            if(!is_null($gotCupon)) {
                $currentDate = Carbon::parse($cupon['currentDate']);
                $cuponDate = Carbon::parse($gotCupon->expiration_date);

                if($gotCupon->active == true && $gotCupon->count > $gotCupon->used && $currentDate->lessThanOrEqualTo($cuponDate)) {
                        $resp->data = $gotCupon;
                } else {
                    $resp->Error = true;
                }
                
            }
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
    public function _addCuponUsed($clave) {

        $cupon = $this->where('clave', $clave)->first();
        $cupon->used = $cupon->used + 1;
        $cupon->save();
    }
}
