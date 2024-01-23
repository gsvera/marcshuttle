<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicaciones extends Model
{
    use HasFactory;
    protected $table = "ubicaciones";
    public $timestamps = false;

    public function _GetLocations($idZone){
        if($idZone == 0) {
            return $this->leftJoin('destination_x_ubicaciones as dxu' , 'dxu.id_ubicaciones', 'ubicaciones.id')
                        ->leftJoin('destination as d', 'dxu.id_destination', 'd.id')
                        ->select('d.name as origin', 'ubicaciones.*', 'd.id as idOrigin')
                        ->orderBy('ubicaciones.nombre')
                        ->get();
        }
        else {
            return $this->leftJoin('destination_x_ubicaciones as dxu' , 'dxu.id_ubicaciones', 'ubicaciones.id')
                        ->leftJoin('destination as d', 'dxu.id_destination', 'd.id')
                        ->where('dxu.id_destination', $idZone)
                        ->select('ubicaciones.*', 'd.name as origin', 'd.id as idOrigin')
                        ->orderBy('ubicaciones.nombre')
                        ->get();
        }
    }

    public function _CreateLocation($nameUbicacion, $idZona) {
        $resp = new Respuesta;

        try{
            $newUbicacion = new Ubicaciones;
            $newUbicacion->nombre = $nameUbicacion;
            $newUbicacion->save();

            $pivot = new DestinationXUbicacion;
            $pivot->id_destination = $idZona;
            $pivot->id_ubicaciones = $newUbicacion->id;
            $pivot->save();

            $resp->Message = "Registro guardado correctamente";
        } catch(Exception $e ) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _UpdateLocation($data) {
        $resp = new Respuesta;

        try{
            $location = $this->find($data['id']);
            $location->nombre = $data['name'];
            $location->save();
            
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
}
