<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationXUbicacion extends Model
{
    use HasFactory;

    protected $table = 'destination_x_ubicaciones';

    public $timestamps = false;

    public function _GetRelationByLocation($idLocation) {
        return $this->where('id_ubicaciones', $idLocation)->first();
    }
}
