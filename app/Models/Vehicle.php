<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table = "vehicle";
    public $timestamps = false;

    public function GetVehicleById($idVehicle)
    {
        return $this->find($idVehicle);
    }
    public function _GetVehicleById($idVehicle) {
        $resp = new Respuesta;

        try {
            $resp->data = $this->find($idVehicle);
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
    public function _GetVehicles() {
        $resp = new Respuesta;

        try{
            $resp->data = $this->get();
        } catch(Exception $e) {
            $resp->Error = ture;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }
    public function _SaveVehicle($data) {
        $resp = new Respuesta;

        try {
            $vehicle = new Vehicle;
            $vehicle->name = $data['name'];
            $vehicle->min_pax = $data['min_pax'];
            $vehicle->max_pax = $data['max_pax'];
            $vehicle->image_base_64 = $data['imagen'];

            $vehicle->save();

        } catch (Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }

    public function _UpdateVehicle($data) {
        $resp = new Respuesta;

        try {
            $vehicle = $this->find($data['id']);
            $vehicle->name = $data['name'];
            $vehicle->min_pax = $data['min_pax'];
            $vehicle->max_pax = $data['max_pax'];

            if(!empty($data['imagen'])) {
                $vehicle->image_base_64 = $data['imagen'];
            }

            $vehicle->save();

            $resp->Message = "Se ha actualziado correctamente";
            
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
}
