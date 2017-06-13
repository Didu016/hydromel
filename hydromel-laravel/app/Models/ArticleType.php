<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleType extends Model {

    public $timestamps = false;
    protected $table = 'articletypes';
    public $primaryKey = 'id';

    public function articles() {
        return $this->hasMany('App\Models\Article', 'articletype_id');
    }

    public static function exists($typeName){
        $aType = Self::where('name', $typeName)->get();
        if($aType->isEmpty()){
            return false;
        } else {
            return true;
        }
    }

}
