<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsibility extends Model
{
    public $timestamps = false;
    protected $table = "responsibilities";

    public static function isValid(string $dataResponsibility){
        for($i = 1 ; $i < 900000 ; $i ++ )
        {
            $responsibility = Self::find($i);
            if($responsibility == null){
                $i = 1000000;
            }
            if($responsibility['name'] == $dataResponsibility) {
                return true; // Elle apparait au moins une fois
                $i = 1000000; // On sort quand on a trouvé une correspondance
            }
        }
        return false;
    }
}
