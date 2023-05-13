<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utils extends Model
{
    use HasFactory;
    //public $urlSandBoxPaypal = "https://api-m.sandbox.paypal.com";
    //public $urlPaypal = "https://api-m.paypal.com";
    //private $paypalClientId = "AbicpsIwlwQgFOx_37jqJD6zzreloUvit5ZuSmz_W89iwpctKnLO_P49pbv65vdzMbxDSEt8H4UAybWk";
    //private $paypalClientSecret = "ELMR8VBiZFcDuCvhkN8J3h8eSIdk3yZ2n8j1Fy2QfjYVHjdWSxW_jOt_tsPMp71ZuqSZzvDJ4dQD-R91";

    //  LOCAL
    // private $recaptchaPublic = "6LdCmI0lAAAAAMkIr0M4gm2aOhkngFTQ5CJhTRgI";
    // private $recaptchaSecret = "6LdCmI0lAAAAAIiM0mnkUhlb0sX6tEjTOSwD9MHO";
    // PRODUCTIVO MARCSHUTTLE
    private $recaptchaPublic = "6Le3mAEmAAAAALvwUCA4AT3LBsANxgWQuESx3Z8-";
    private $recaptchaSecret = "6Le3mAEmAAAAAAIa4dSkSEoar1Y-YST8Gdmx16TT";

    public function GetRecaptchaSecret(){
        return $this->recaptchaSecret;
    }

    static function asDollars($valor)
    {
        if ($valor<0) return "-".asDollars(-$valor);
        return '$' . number_format($valor, 2);
    }
}
