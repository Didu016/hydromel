<?php

use Illuminate\Database\Seeder;
use App\Models\Access;
use App\Models\Article;
use App\Models\ArticleType;
use App\Models\Edition;
use App\Models\Group;
use App\Models\Integration;
use App\Models\Media;
use App\Models\MediaType;
use App\Models\Member;
use App\Models\Membership;
use App\Models\Participation;
use App\Models\Resource;
use App\Models\Responsibility;
use App\Models\Reward;
use App\Models\Sponsor;
use App\Models\Sponsoring;
use App\Models\Usage;
use App\Models\User;

class Edition2015Seeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        /////////// HYDROMEL DATA SEEDING EDITION 2017 ///////////
        // Members
        $member_colin = Member::create([
                    'firstname' => 'Colin',
                    'name' => 'Mottas',
                    'email' => 'colin.mottas@heig-vd.ch'
        ]);

        $member_pierre = Member::create([
                    'firstname' => 'Pierre',
                    'name' => 'Baud',
                    'email' => 'pierre.baud@heig-vd.ch'
        ]);



        $media_photo = new Media();
        $media_photo->url = 'http://hydro.heig-vd.ch/wp-content/uploads/2017/03/mathfa.jpg';
        $media_photo->title = 'Photo Mat';
        $media_photo->mediatype_id = DatabaseSeeder::$media_type_photo->id;


        // Editions
        $edition = Edition::create([
                    'team' => 'hydroswag',
                    'year' => 2015,
                    'description' => 'II s’agit d’une des problématiques actuelles et communes liées au développement industriel et technologique de notre ère. Avec 90% des échanges commerciaux opérés par la mer, le transport maritime est un enjeu économique et environnemental majeur. En effet, si le bateau reste le moyen de transport le plus écologique, en matière d’emissions de CO2 par tonne transportée, il représente tout de même la 5ème source de pollution mondiale.',
                    'start_date' => Carbon\Carbon::parse('2015-06-10'),
                    'end_date' => Carbon\Carbon::parse('2015-06-19'),
                    'place' => 'Fribourg'
        ]);

        $edition_sponsor1 = Sponsor::create([
                    'society' => 'Etat de Vaud',
                    'amount_min' => 3000,
                    'amount_max' => 3000,
                    'mail_contact' => 'infos@vd.ch',
                    'link' => 'http://www.vd.ch/'
        ]);

        $edition_sponsor2 = Sponsor::create([
                    'society' => 'Yverdon Sport',
                    'amount_min' => 500,
                    'amount_max' => 500,
                    'mail_contact' => 'info@yverdonsport.ch',
                    'link' => 'http://www.yverdonsport.ch/'
        ]);
        $edition->sponsors()->saveMany([$edition_sponsor1, $edition_sponsor2]);
        $edition->medias()->save($media_photo);

        $participation_pierre = Participation::create([
                    'member_id' => $member_pierre->id,
                    'edition_id' => $edition->id,
                    'responsibility_id' => DatabaseSeeder::$responsibility_team_manager->id,
                    'media_id' => $media_photo->id
        ]);


        // Responsibilities
        $responsibility_com_manager = Responsibility::create([
                    'name' => 'Communication Manager'
        ]);
        $participation_colin = Participation::create([
                    'member_id' => $member_colin->id,
                    'edition_id' => $edition->id,
                    'responsibility_id' => $responsibility_com_manager->id,
                    'media_id' => $media_photo->id
        ]);


        $article_news = new Article();
        $article_news->title = 'Lancement de l\'édition Hydrocontest 2015!';
        $article_news->description = 'Nous sommes contents de vous retrouver cette année pour une nouvelle participation au concours hydrocontest. Cette année, notre nouvelle équipe se réjouit de donner son maximum pour remporter ce concours!';
        $article_news->articletype_id = DatabaseSeeder::$article_type_news->id;

        $article_presse = new Article();
        $article_presse->title = 'La Liberte parle de nous!';
        $article_presse->link = 'http://www.laliberte.ch/news/regions/canton/des-ordinateurs-encore-plus-puissants-395131#.WTkpLmjyhPY';
        $article_presse->articletype_id = DatabaseSeeder::$article_type_presse->id;

        $edition->articles()->save($article_news);
        $edition->articles()->save($article_presse);

        $article_news->medias()->save($media_photo);

        $reward = new Reward();
        $reward->distinction = 'Prix de la meilleure communication';
        $reward->position = '3';
        $reward->description = 'Le prix de la meilleure communication est décerné à l\'équipe qui a mené la meilleure campagne de communication durant le concours Hydrocontest';

        $edition->rewards()->save($reward);
    }

}
