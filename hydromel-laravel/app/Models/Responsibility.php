<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsibility extends Model {

    public $timestamps = false;
    protected $table = "responsibilities";

    public static function isValid(string $dataResponsibility) {
        $responsibilities = self::all();
        foreach ($responsibilities as $responsibility) {
            if ($responsibility->name == $dataResponsibility) {
                return true;
            }
        }
        return false;
    }

}
