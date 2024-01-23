<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;
    protected $table = "perfil";
    public $timestamps = false;

    public function _GetProfiles () {
        return $this->get();
    }
}
