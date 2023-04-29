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
}
