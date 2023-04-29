<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleTour extends Model
{
    use HasFactory;
    protected $table = "vehicle_tour";
    public $timestamps = false;

    public function GetPrices($idTour)
    {
        $listPrecios = $this->where('tour_id', $idTour)
                        ->leftJoin('vehicle as v', 'v.id', 'vehicle_tour.vehicle_id')->get();

        return $listPrecios;
    }
}
