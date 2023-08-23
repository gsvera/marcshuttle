<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferCatalog extends Model
{
    use HasFactory;
    protected $table = 'transfer_catalog';
    public $timestamps = false;

    public function _GetTransferCatalogById($id)
    {
        return $this->find($id);
    }
}
