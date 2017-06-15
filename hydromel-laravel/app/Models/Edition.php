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

    public static function existsByAttributes($year, $team) {
        return self::where([
                    ['year', '=', $year],
                    ['team', '=', $team],
                ])->first() != null;
    }

    public static function getCurrentEdition() {
        return self::all()->sortByDesc("year")->first();
    }

    /**
     * Retuns data from current edition with simplified info from previous editions
     * @return array that will be converted to json
     */
    public static function getCurrentEditionJson() {
        $current_edition = self::getCurrentEdition();
        if ($current_edition == null) {
            
        }
        $current_edition_members = Member::getMembersFormatted($current_edition->members()->get());
        $current_edition_rewards = $current_edition->rewards()->get();
        $current_edition_sponsors = Sponsor::getSponsorsFormatted($current_edition->sponsors()->get());
        $current_edition_articles = Article::getArticlesFormatted($current_edition->articles()->orderBy('created_at', 'desc')->get());

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
        $id_current = self::getCurrentEdition()->id;
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

    public static function isValidForUpdate($data) {
        $erreur = false;
        // CHECK CONTRAINTES INTEGRITES
        if (($data['beginningDate'] != null) && ($data['finishingDate'] != null)) { // Si les deux champs sont remplis
            $year = mb_substr($data['beginningDate'], 0, 4); // on choppe juste l'annee
            $yearEdition = self::getCurrentEditionJson()['edition']->original['year']; // on choppe l'annee de l'edition en cours
            if ($data['beginningDate'] != $yearEdition) { // L'année de début de l'édition doit être dans la même année que l'édition
                $erreur = true;
            }
            if (!($data['beginningDate'] <= $data['finishingDate'])) { // La date de début doit être postérieure à la date de fin d'une édition
                $erreur = true;
            }
        } elseif (($data['beginningDate'] != null) || ($data['finishingDate'] != null)) { // Si un des deux champs est rempli
            $erreur = true;
        }

        // REGLES DE VALIDATION
        if ($erreur != true) { // Si les contraintes d'integrites sont respectees
            return Validator::make($data, [
                        'description' => 'string|between:1,20000|required',
                        'place' => 'string|between:1,50|required',
                        'beginningDate' => 'nullable|date',
                        'finishingDate' => 'nullable|date',
                    ])->passes();
        } else { // Si les contraintes n'ont pas etee respectees
            return !$erreur;
        }
    }

    public static function isValid($parameters) {
        // validation here
        return Validator::make($parameters, [
                    'id' => 'exists:news|sometimes|required',
                    'title' => 'string|between:1,200|sometimes|required',
                    'body' => 'string|between:1,10000|sometimes|required',
                    'user_id' => 'exists:users,id|sometimes|required',
                ])->passes();
    }

}
