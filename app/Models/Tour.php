<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $table = "tour";
    public $timestamps = false;

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
}
