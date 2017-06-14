<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model {

    public $timestamps = false;

    public static function exists($nameRank){
        $aRank = self::where([
            ['name', '=', $nameRank]
        ])->get();
        if($aRank->isEmpty()){
            return false;
        } else {
            return true;
        }
    }

}
