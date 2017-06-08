<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model {

    public $timestamps = false;

    public function edition() {
        return $this->belongsTo('App\Models\Edition');
    }

}
