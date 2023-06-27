<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Usuario extends Model
{
    use HasFactory;
    public $valo;
    protected $table = 'users';
    protected $fillable = ['email', 'password'];
    public $timestamps = false;

    private $validations = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|string',
        'password' => 'required|string',
    ];

    public $customerMessageError = [
        'first_name.required' => 'El campo primer nombre es obligatorio',
        'last_name.required' => 'El campo primer apellido es obligatorio',
        'email.required' => 'El campo email es obligatorio',
        'password.required' => 'El campo contraseña es obligatoria',
    ];

    public function _CrearUsuario($data)
    {
        $resp = new Respuesta;

        try{
            $validator = Validator::make($data, $this->validations, $this->customerMessageError);

            if($validator->fails()){
                $resp->Error = true;
                $resp->Message = "Faltan llenar campos obligatorios";
                return $resp;
            }            
    
            $getUser = $this->where('email', $data['email'])->first();
            if($getUser != null){
                $resp->Error = true;
                $resp->Message = "Ya existe un usuario con ese Email";
                return $resp;
            }

            $new_user = new User;            
            $new_user->first_name = $data['first_name'];
            $new_user->last_name = $data['last_name'];
            $new_user->email = $data['email'];
            $new_user->password = Hash::make($data['password']);            
            $new_user->save();

            $resp->Error = false;
            $resp->Message = "Nuevo usuario creado";
            return $resp;
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;                
    }
    public function _Login($data)
    {
        $resp = new Respuesta;
        
        try{
            $user = $this->where('email', $data['email'])->first();

            if(Hash::check($data['password'], $user->password))
            {                
                $resp->data = $user;
            }
            else
            {
                $resp->Error = true;
                $resp->Message = "Usuario o contraseña incorrecta";
            }
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }
}
