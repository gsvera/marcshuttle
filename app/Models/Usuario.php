<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class Usuario extends Model
{
    use HasFactory;
    public $valo;
    protected $table = 'users';
    protected $fillable = ['email', 'password'];
    public $timestamps = false;
    protected $primaryKey = 'id_profile';

    private $validations = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|string',
        'password' => 'required|string',
        'id_profile' => 'required|string',
    ];

    public $customerMessageError = [
        'first_name.required' => 'El campo primer nombre es obligatorio',
        'last_name.required' => 'El campo primer apellido es obligatorio',
        'email.required' => 'El campo email es obligatorio',
        'password.required' => 'El campo contraseña es obligatoria',
        'id_profile.required' => 'El campo perfile es obligatorio',
    ];

    public function _Permisos() {
        return $this->hasMany(PermisosXPerfil::class, 'id_perfil');
    }

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
            $new_user->id_profile = $data['id_profile'];
            $new_user->estatus = 1;       
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

    public function _UpdateUser($data) {
        $resp = new Respuesta;

        try{   
            $user = $this->find($data['id']);

            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->id_profile = $data['id_profile'];
            $user->save();

            $resp->Error = false;
            $resp->Message = "Usuario actualizado";
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _EnabledDisableUser($idUser, $estatus) {
        $resp = new Respuesta;
        
        try{
            $user = $this->find($idUser);
            $user->estatus = !$estatus;
            $user->save();
            $resp->Error = false;
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
    public function _Login($data)
    {
        $resp = new Respuesta;
        
        try{
            $user = $this->with(array('_Permisos' => function($query) {
                    $query->select('id_permiso');
                }))
                ->where('email', $data['email'])->first();
                
            if($user->estatus != 1) {
                $resp->Error = true;
                $resp->Message = "Usuario inhabilitado";
            }
            else if(Hash::check($data['password'], $user->password))
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

    public function _GetUsers() {
        $resp = new Respuesta;

        try{
            $user = $this->get();
            $resp->data = $user;
            $resp->Error = false;
        }
        catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _GetUserById($id) {
        $resp = new Respuesta;

        try {
            $user = $this->find($id);
            $resp->data = $user;
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }

    public function _GetCurrentUser($id) {
        $resp = new Respuesta;

        try{
            $user = $this->select('first_name', 'last_name', 'email')->find($id);
            $resp->data = $user;
        }
        catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
    
    public function _UpdateCurrentUser($id, $data) {
        $resp = new Respuesta;

        try{
            $user = $this->find($id);
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->save();

            request()->session()->put('name_user', $data['first_name'] . " " . $data['last_name']);

            $resp->Message = "Se actualizo los datos correctamente";
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _ChangePassword($idUser, $currentPassword, $newPassword) {
        $resp = new Respuesta;

        try{
            $user = $this->find($idUser);

            if(Hash::check($currentPassword, $user->password)) {
                $user->password = Hash::Make($newPassword);
                $user->save();
                $resp->Message = "Se actualizo la contraseña correctamente";
            }
            else {
                $resp->Error = true;
                $resp->Message = "La contraseña actual no es correcta";
            }
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _UpdatePasswordForget($dataToken, $newPassword) {
        $resp = new Respuesta;

        try{
            $user = $this->where('email', $dataToken->email)->first();
            $user->password = Hash::make($newPassword);
            $user->save();

            $resp->Message = "Se actualizo la contraseña correctamente";
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _sendTokenResetPassword($email){
        $resp = new Respuesta;
        $resetPassword = new ResetPassword;

        try{
            $user = $this->where('email', $email)->first();

            if(!is_null($user)) {
                $generateToken = Hash::make($email . $user->password);
                $resp = $resetPassword->_SaveToken($generateToken, $email);
                if($resp->Error == false) {
                    $email = $user->email;
                    $subject = "Recuperacion de contraseña";

                    Mail::send('emails.resetPassword', [
                        'nombre' => $user->first_name . ' ' . $user->last_name,
                        'link' => env('APP_URL').'/admin-marcshuttle/reset-password?token=' . $generateToken
                    ], function($mensaje) use ($email, $subject) {
                        $mensaje->to([$email])->subject($subject);
                    });
                }
            } else {
                $resp->Error = true;
                $resp->Message = 'No existe un usuario con ese email';
            }
        } catch(Exception $e){
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
}
