<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utils extends Model
{
    use HasFactory;
    private $clientId = "AbicpsIwlwQgFOx_37jqJD6zzreloUvit5ZuSmz_W89iwpctKnLO_P49pbv65vdzMbxDSEt8H4UAybWk";
    private $clientSecret = "ELMR8VBiZFcDuCvhkN8J3h8eSIdk3yZ2n8j1Fy2QfjYVHjdWSxW_jOt_tsPMp71ZuqSZzvDJ4dQD-R91";
    private $recaptchaPublic = "6LdCmI0lAAAAAMkIr0M4gm2aOhkngFTQ5CJhTRgI";
    private $recaptchaSecret = "6LdCmI0lAAAAAIiM0mnkUhlb0sX6tEjTOSwD9MHO";

    public function GetRecaptchaSecret(){
        return $this->recaptchaSecret;
    }
}
