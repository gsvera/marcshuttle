<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisosXPerfil extends Model
{
    use HasFactory;
    protected $table = 'permisos_x_perfil';
    public $timestamps = false;

    public function GetPermisosXSession($idProfile) {
        $resp = new Respuesta;

        try {
            $arr = [];
            $objsPermisos =  $this->where('id_perfil', $idProfile)->select('id_permiso')->get();

            foreach($objsPermisos as $permisos) {
                array_push($arr, $permisos->id_permiso);
            }
            $resp->data = $arr;
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;


    }
}
