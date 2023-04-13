<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;
    private $Error;
    private $Message;
    private $data;

    public function setResult($error, $message, $data)
    {
        $this->Error = $error;
        $this->Message = $message;
        $this->data = $data;
    }
    public function getResult()
    {
        return ["error" => $this->Error, "Message" => $this->Messsage, "data" => $this->data];
    }
}