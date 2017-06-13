<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Lib\Message;

class Edition extends Model {

    public $timestamps = false;

    //////////// RELATIONSHIPS ////////////
    public function medias() {
        return $this->belongsToMany('App\Models\Media', 'usage');
    }

    public function rewards() {
        return $this->hasMany('App\Models\Reward');
    }

    public function sponsors() {
        return $this->belongsToMany('App\Models\Sponsor', 'sponsoring', 'edition_id', 'sponsor_id')
                        ->withPivot('rank_id');
    }

    public function members() {
        return $this->belongsToMany('App\Models\Member', 'participation', 'edition_id', 'member_id')
                        ->withPivot('responsibility_id', 'media_id');
    }

    public function articles() {
        return $this->hasMany('App\Models\Article');
    }

    //////////// CLASS METHODS ////////////

    /**
     * Check if an edition exists in the DB
     * @param type $id
     * @return type
     */
    public static function exists($id) {
        // Commande à une clé simple, donc find() peut être utilisé
        return self::find($id) !== null;
    }

    /**
     * Retuns data from current edition with simplified info from previous editions
     * @return array that will be converted to json
     */
    public static function getCurrentEdition() {
        $current_edition = self::all()->sortByDesc("year")->first();
        if ($current_edition == null) {
            
        }
        $current_edition_members = Member::getMembersFormatted($current_edition->members()->get());
        $current_edition_rewards = $current_edition->rewards()->get();
        $current_edition_sponsors = Sponsor::getSponsorsFormatted($current_edition->sponsors()->get());
        $current_edition_articles = Article::getArticlesFormatted($current_edition->articles()->get());
        $medias = $current_edition->medias()->get();

        // Filter medias that are not associated with an article (because media already showed in the article)
        for ($i = 0; $i < $medias->count(); $i++) {
            $media = $medias->get($i);
            foreach ($media->articles as $article) {
                if ($article->pivot->media_id == $media->id) {
                    $medias->forget($i);
                }
            }
        }

        $current_edition_medias = Media::getMediasFormatted($medias);
        $json = [
            'edition' => $current_edition,
            'members' => $current_edition_members,
            'rewards' => $current_edition_rewards,
            'sponsors' => $current_edition_sponsors,
            'articles' => $current_edition_articles,
            'medias' => $current_edition_medias
        ];
        return $json;
    }

    /**
     * Returns simplified data of all editions. That means that it returns only the attributes of 'edition' without all its relations.
     * @return array that will be converted to json
     */
    public static function getPreviousEditionsSimplified() {
        $id_current = self::all()->sortByDesc("year")->first()->id;
        $editions = self::all()->whereNotIn('id', $id_current)->sortByDesc("year")->toArray();
        $editions_formatted = array();
        for ($i = 0; $i < count($editions); $i++) {
            $edition = $editions[$i];
            array_push($editions_formatted, $edition);
        }
        return $editions_formatted;
    }

    /**
     * Get the data of a specific edition.
     * It is actually used to display a previous edition.
     * @param int $id The id of the edition to retrieve.
     * @return array that will be converted to json.
     */
    public static function getEdition($id) {
        $edition = self::find($id);
        if ($edition == null) {
            return null;
        }
        $edition_members = Member::getMembersFormatted($edition->members()->get());
        $edition_rewards = $edition->rewards()->get();
        $edition_sponsors = Sponsor::getSponsorsFormatted($edition->sponsors()->get());
        $edition_articles = Article::getArticlesFormatted($edition->articles()->get());
        $edition_medias = $edition->medias()->get();

        // Filter medias that are not associated with an article (because media already showed in the article)
        for ($i = 0; $i < $edition_medias->count(); $i++) {
            $media = $edition_medias->get($i);
            foreach ($media->articles as $article) {
                if ($article->pivot->media_id == $media->id) {
                    $edition_medias->forget($i);
                }
            }
        }
        $edition_medias_formatted = Media::getMediasFormatted($edition_medias);
        return [
            'edition' => $edition,
            'members' => $edition_members,
            'rewards' => $edition_rewards,
            'sponsors' => $edition_sponsors,
            'articles' => $edition_articles,
            'medias' => $edition_medias_formatted
        ];
    }

}
