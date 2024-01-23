<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;
    public $Error = false;
    public $Message;
    public $data;

    public function setResult($error, $message, $data)
    {
        $this->Error = $error;
        $this->Message = $message;
        $this->data = $data;
    }
    public function getResult()
    {
        return ["error" => $this->Error, "Message" => $this->Message, "data" => $this->data];
    }    
}
