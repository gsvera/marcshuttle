<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folio extends Model
{
    use HasFactory;
    protected $table = 'folio';
    public $timestamps = false;

    public function _GetFolio()
    {
        return $this->where("folio","BK-MS-")->first();
    }
    public function _GetFolioTour()
    {
        return $this->where("folio", "BK-TR-")->first();
    }
}
