<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model {
    
    public $timestamps = false;

    public function groups() {
        return $this->belongsToMany('App\Models\Group', 'access');
    }

}
