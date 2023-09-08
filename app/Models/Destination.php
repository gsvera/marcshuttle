<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Respuesta;

class Destination extends Model
{
    use HasFactory;
    protected $table = 'destination';
    public $timestamps = false;

    public function _GetDestinationsAirport(){
        $obj = new Destination;
        try{
            $destination = $obj->where('id_origin', 1)->get();
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
    public function _GetDestinationById($id)
    {
        return $this->find($id);
    }
}
