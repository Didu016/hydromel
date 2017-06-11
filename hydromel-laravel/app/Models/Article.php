<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

    public function medias() {
        return $this->belongsToMany('App\Models\Media', 'integration');
    }

    public function articletype() {
        return $this->belongsTo('App\Models\ArticleType');
    }

    public function edition() {
        return $this->belongsTo('App\Models\Edition', 'edition_id');
    }

    public static function getArticlesFormatted($laravel_articles) {
        $articles = array();
        for ($i = 0; $i < $laravel_articles->count(); $i++) {
            $article = $laravel_articles->get($i);
            $id = $article->id;
            $title = $article->title;
            $description = $article->description;
            $created_at = $article->created_at;
            $updated_at = $article->updated_at;
            $link = $article->link;


            //get article type
            $articletype_name = ArticleType::find($article->articletype_id)->name;
            $medias = Media::getMediasFormatted($article->medias);

            //get medias

            $article_formatted = array();
            $article_formatted['id'] = $id;
            $article_formatted['title'] = $title;
            $article_formatted['description'] = $description;
            $article_formatted['created_at'] = $created_at;
            $article_formatted['updated_at'] = $updated_at;
            $article_formatted['link'] = $link;
            $article_formatted['articletype_name'] = $articletype_name;
            $article_formatted['medias'] = $medias;

            array_push($articles, $article_formatted);
        }
        return $articles;
    }

}
