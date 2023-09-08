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
}
