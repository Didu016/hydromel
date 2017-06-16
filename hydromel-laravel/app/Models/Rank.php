<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Rank extends Model {

    public $timestamps = false;

    public static function exists($nameRank) {
        $aRank = self::where([
                    ['name', '=', $nameRank]
                ])->get();
        if ($aRank->isEmpty()) {
            return false;
        } else {
            return true;
        }
    }

    public static function isValid($data) {
        $dataArray['rankName'] = $data;
        return Validator::make($dataArray, [
                    'rankName' => 'string|between:1,50|required', // on vérifie pas les chiffres et autres caractères
                ])->passes();
    }

    public static function destroyWithReferencies($id) {
        DB::transaction(function ($id) {
            $sponsoring = Sponsoring::where('rank_id', $id)->get();
            foreach ($sponsoring as $sponsoring_with_rank) {
                $sponsoring_with_rank->rank_id = null;
                $sponsoring_with_rank->save();
            }
            self::destroy($id);
        });
    }

}
