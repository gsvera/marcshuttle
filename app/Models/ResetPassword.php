<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ResetPassword extends Model
{
    use HasFactory;
    protected $table = 'reset_password';
    public $timestamps = false;

    public function _SaveToken($token, $email) {
        $resp = new Respuesta;

        try{ 
            $newToken = new ResetPassword;
            $newToken->token = $token;
            $newToken->estatus = 0;
            $newToken->email = $email;
            $newToken->save();
            
            $resp->Message = "Se guardo el token con exito";
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
    public function _ValidToken($token){

        try { 
            $resetToken = $this->where('token', $token)->first();
            $fechaToken = Carbon::parse($resetToken->fecha_creado);
            $fechaActual = Carbon::parse(date('Y-m-d H:i:s'));

            if((int)$fechaToken->diffInMinutes($fechaActual).'' < 720 && $resetToken->estatus == 0) {
                return true;
            }
            else{
                return false;
            }
        } catch(Exception $e) {
            return false;        
        }
    }

    public function _FindToken($token){
        $resp = new Respuesta;

        try{
            $registryToken = $this->where('token', $token)->first();
            $registryToken->estatus = 1;
            $registryToken->save();

            $resp->data = $registryToken;
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }
}
