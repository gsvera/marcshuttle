<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Respuesta;
use App\Models\DestinationXUbicacion;
use App\Models\Ubicaciones;

class Destination extends Model
{
    use HasFactory;
    protected $table = 'destination';
    public $timestamps = false;

    public function _detailLocations() {
        return $this->hasManyThrough(Ubicaciones::class, DestinationXUbicacion::class, 'id_destination', 'id', 'id', 'id_ubicaciones');
    }

    public function _GetDestinationsAirport(){
        $obj = new Destination;
        try{
            $destination = $obj->where('id_origin', 1)->orderBy('name')->get();
        }
        catch(Exception $e)
        {
            error_log($e->getMessage());
        }
        return $destination;
    }
    public function GetDestination($idDestination){
        $destination = null;
        $obj = new Destination;

        try{
            $destination = $obj->find($idDestination);
        }
        catch(Exception $e)
        {

        }
        return $destination;
    }
    // funcion para la parte de web
    public function _GetDestinationById($id)
    {
        return $this->find($id);
    }

    // funcion para la parte de admin
    public function _GetDestinationByIdAdmin($id) {
        $resp = new Respuesta;

        try{
            $resp->data = $this->find($id);
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getResult();
        }
        return $resp;
    }

    public function _GetAllDestinationsAirport($nameZona) {
        $resp = new Respuesta;

        try {
            $resp->data = $this->where('id_origin', 1)
                            ->where('name', 'like', '%'.$nameZona.'%')
                            ->orderBy('name')->get();

        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _GetZonasLocations($nameZona) {
        $resp = new Respuesta;

        try{
            $resp->data = $this->with(array('_detailLocations' => function($detalle) {
                            $detalle->select('*');
                        }))->where('id_origin', 1)
                        ->where('name', 'like', '%'.$nameZona.'%')
                        ->select('*')
                        ->get();
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _GetZonaLocationsById($idZona) {
        $resp = new Respuesta;

        try{
            $resp->data = $this->with(array('_detailLocations' => function($detalle) {
                            $detalle->select('*');
                        }))->where('id_origin', 1)
                        ->where('id', $idZona)
                        ->select('*')
                        ->get();
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _CreateDestination($data) {
        $resp = new Respuesta;

        try {
            $newDestination = new Destination;
            $newDestination->name = $data['name'];
            $newDestination->uno_tres = $data['uno_tres'];
            $newDestination->cuatro_siete = $data['cuatro_siete'];
            $newDestination->ocho_diez = $data['ocho_diez'];
            $newDestination->id_origin = 1; // ES FIJO EL UNO POR QUE SE MANEJA SOLO AEROPUERTO
            $newDestination->save();

            $resp->Message = 'Se ha guardado el registro correctamente';
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }

    public function _UpdateZona($data) {
        $resp = new Respuesta;

        try {
            $zona = $this->find($data['id']);
            $zona->name = $data['name'];
            $zona->uno_tres = $data['uno_tres'];
            $zona->cuatro_siete = $data['cuatro_siete'];
            $zona->ocho_diez = $data['ocho_diez'];
            $zona->save();

            $resp->Message = 'Se ha actualizado el registro correctamente';
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }
}
