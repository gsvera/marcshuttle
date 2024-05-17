<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Tour extends Model
{
    use HasFactory;
    protected $table = "tour";
    public $timestamps = false;

    public function _PricesByVehicle() {
        return $this->hasManyThrough(Vehicle::class, VehicleTour::class, 'tour_id', 'id', 'id', 'vehicle_id');
    }

    public function GetTours()
    {
        $resp = new Respuesta;

        try{  
            $resp->data = $this->leftJoin('vehicle_tour as vt', 'tour.id', 'vt.tour_id')
            ->select('tour.*', 'vt.price')->groupBy('id')->get();

            $resp->error = false;
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = "Exception: ".$e->getMessage();            
        }        
        return $resp;
    }
    
    public function _GetTourOptions() {
        $resp = new Respuesta;

        try {
            $resp->data = $this->select('id', 'name')->orderBy('name')->get();
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }

    public function _GetToursAdmin($nameTour) {
        $resp = new Respuesta;

        try{
            $resp->data = $this->with(array('_PricesByVehicle' => function($query) {
                                $query->select('*');
                            }))
                            ->where('name', 'like', '%'.$nameTour.'%')
                            ->get();
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }
    public function GetTourById($id)
    {
        $resp = new Respuesta;

        try{
            $resp->data = $this->find($id);
            $resp->Error = false;
        }
        catch(Exception $e)
        {
            $resp->Error = true;
            $resp->Message = $e->getmessage();
        }
        return $resp;
    }

    public function _SaveTour($data) {
        $resp = new Respuesta;
        $pivot = new VehicleTour;
        
        try{
            $newTour = new Tour;
            $newTour->name = $data['name'];
            $newTour->descripcion_es = $data['description_es'];
            $newTour->descripcion_en = $data['description_en'];
            $newTour->image_base_64 = $data['imagen'];
            $newTour->save();

            foreach($data['array_vehicle'] as $item) {
                $pivot->_SavePivotByTour($newTour->id, $item);
            }
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }

        return $resp;
    }
    public function _GetTourByIdAdmin($id) {
        $resp = new Respuesta;

        try{
            $resp->data = $this->with(array('_PricesByVehicle' => function($query) {
                $query->select('*');
            }))
            ->find($id);
        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
    public function _UpdateTour($data) {
        $resp = new Respuesta;
        $tour = new Tour;
        $pivot = new VehicleTour;

        try{
            $tour = $this->find($data['id']);
            $tour->name = $data['name'];
            $tour->descripcion_es = $data['description_es'];
            $tour->descripcion_en = $data['description_en'];
            
            if(!empty($data['imagen'])) {
                $tour->imagen_base_64 = $data['imagen'];
            }
            
            $tour->save();

            $pivot->_DeletePivotByTour($tour->id);

            foreach($data['array_vehicle'] as $item) {
                $pivot->_SavePivotByTour($tour->id, $item);
            }

            $resp->Message = "Se ha actualizado correctamente";

        } catch(Exception $e) {
            $resp->Error = true;
            $resp->Message = $e->getMessage();
        }
        return $resp;
    }
}
