<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model {

    public $timestamps = false;

    public function editions() {
        return $this->belongsToMany('App\Models\Sponsor', 'sponsoring', 'sponsor_id', 'edition_id')
                        ->withPivot('rank_id');
    }

    /**
     * Returns formatted sponsors info. Instead of returning the id of the rank (as Laravel does with Sponsor::find), it returns the name of the rank as a rank_name field
     * @param Collection $laravel_sponsors
     * @return array Sponsors formatted.
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
            $logo = $sponsor->logo;

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
            $sponsor_formatted['logo'] = $logo;
            $sponsor_formatted['rank_name'] = $rank_name;
            array_push($sponsors, $sponsor_formatted);
        }
        return $sponsors;
    }

}
