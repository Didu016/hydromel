<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model {
    
    public $timestamps = false;

    public function editions() {
        return $this->belongsToMany('App\Models\Edition', 'sponsoring');
    }
}
