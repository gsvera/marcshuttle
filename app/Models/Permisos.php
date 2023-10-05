<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    use HasFactory;

    protected $table = 'permisos';
    public $timestamps = false;

    public function _GetPermisos() {
        return $this->get();
    }
}
