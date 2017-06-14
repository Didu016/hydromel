<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Sponsor extends Model {

    public $timestamps = false;

    public function editions() {
        return $this->belongsToMany('App\Models\Sponsor', 'sponsoring', 'sponsor_id', 'edition_id')
                        ->withPivot('rank_id');
    }

    //////////// CLASS METHODS ////////////

    /**
     * Formats the sponsors to display. 
     * @param type $laravel_sponsors the sponsors as laravel displays it (with foreign keys)
     * @return array formatted sponsors
     */
    public static function getSponsorsFormatted($laravel_sponsors) {
        $sponsors = array();
        for ($i = 0; $i < $laravel_sponsors->count(); $i++) {
            $sponsor = $laravel_sponsors->get($i);
            $id = $sponsor->id;
            $society = $sponsor->society;
            $amount = $sponsor->amount;
            $mail_contact = $sponsor->mail_contact;
            $link = $sponsor->link;
            $logo_url = $sponsor->logo_url;

            //get rank
            $rank_name = null;
            if ($sponsor->pivot->rank_id != null) {
                $rank_name = Rank::find($sponsor->pivot->rank_id)->name;
            }

            $sponsor_formatted = array();
            $sponsor_formatted['id'] = $id;
            $sponsor_formatted['society'] = $society;
            $sponsor_formatted['amount'] = $amount;
            $sponsor_formatted['mail_contact'] = $mail_contact;
            $sponsor_formatted['link'] = $link;
            $sponsor_formatted['logo_url'] = $logo_url;
            $sponsor_formatted['rank_name'] = $rank_name;
            array_push($sponsors, $sponsor_formatted);
        }
        return $sponsors;
    }

    public static function isValid($data){
        return Validator::make($data, [
            'society' => 'string|between:1,50|required', // on vérifie pas les chiffres et autres caractères
            'mail_contact' => 'string|between:1,2000|required', // on vérifie pas les chiffres et autres caractères
            'link' => 'URL|between:1,101|nullable',
            'amount' => 'numeric|required'
        ])->passes();
    }

}
