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

class Edition2017Seeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        /////////// HYDROMEL DATA SEEDING EDITION 2017 ///////////
        // Members
        $member_david = Member::create([
                    'firstname' => 'David',
                    'name' => 'Kostic',
                    'email' => 'david.kostic@heig-vd.ch'
        ]);

        $member_spat = Member::create([
                    'firstname' => 'Philippe',
                    'name' => 'Spat',
                    'email' => 'philippe.spat@heig-vd.ch'
        ]);


        $responsibility_cs_manager = Responsibility::create([
                    'name' => 'Chercheur - superviseur'
        ]);


        $media_photo = new Media();
        $media_photo->url = 'http://hydro.heig-vd.ch/wp-content/uploads/2017/03/joncoel.jpg';
        $media_photo->title = 'Photo Jon';
        $media_photo->mediatype_id = DatabaseSeeder::$media_type_photo->id;


        // Editions
        $edition = Edition::create([
                    'team' => 'Hydromel',
                    'year' => 2017,
                    'description' => 'II s’agit d’une des problématiques actuelles et communes liées au développement industriel et technologique de notre ère. Avec 90% des échanges commerciaux opérés par la mer, le transport maritime est un enjeu économique et environnemental majeur. En effet, si le bateau reste le moyen de transport le plus écologique, en matière d’emissions de CO2 par tonne transportée, il représente tout de même la 5ème source de pollution mondiale.',
                    'team_description' => 'Meilleure team de 2015 parce qu\'on est des membres de l\'HEIG-VD',
                    'start_date' => Carbon\Carbon::parse('2017-06-10'),
                    'end_date' => Carbon\Carbon::parse('2017-06-19'),
                    'place' => 'Yverdon-les-Bains',
        ]);

        $edition_sponsor1 = Sponsor::create([
                    'society' => 'Google',
                    'amount' => 5000,
                    'mail_contact' => 'service@google.com',
                    'link' => 'http://www.google.com'
        ]);

        $edition_sponsor2 = Sponsor::create([
                    'society' => 'Cuendet',
                    'amount' => 500,
                    'mail_contact' => 'info@cuendet.ch',
                    'link' => 'http://www.cuendetfreres.ch/'
        ]);
        // Sponsoring
        Sponsoring::create([
            'edition_id' => $edition->id,
            'sponsor_id' => $edition_sponsor1->id,
            'rank_id' => DatabaseSeeder::$rank_argent->id
        ]);

        Sponsoring::create([
            'edition_id' => $edition->id,
            'sponsor_id' => $edition_sponsor2->id,
            'rank_id' => null
        ]);
        $edition->medias()->save($media_photo);

        $participation_spat = Participation::create([
                    'member_id' => $member_spat->id,
                    'edition_id' => $edition->id,
                    'responsibility_id' => DatabaseSeeder::$responsibility_team_manager->id,
                    'media_id' => $media_photo->id
        ]);

        $participation_david = Participation::create([
                    'member_id' => $member_david->id,
                    'edition_id' => $edition->id,
                    'responsibility_id' => $responsibility_cs_manager->id,
                    'media_id' => $media_photo->id
        ]);



        $article_news1 = new Article();
        $article_news1->title = 'Lancement de l\'édition Hydrocontest 2017!';
        $article_news1->description = 'Nous sommes contents de vous retrouver cette année pour une nouvelle participation au concours hydrocontest. Cette année, notre nouvelle équipe se réjouit de donner son maximum pour remporter ce concours!';
        $article_news1->articletype_id = DatabaseSeeder::$article_type_news->id;


        $article_news2 = new Article();
        $article_news2->title = 'News 2';
        $article_news2->description = 'Description news 2';
        $article_news2->articletype_id = DatabaseSeeder::$article_type_news->id;

        $article_news3 = new Article();
        $article_news3->title = 'News 3';
        $article_news3->description = 'Description news 3';
        $article_news3->articletype_id = DatabaseSeeder::$article_type_news->id;

        $article_news4 = new Article();
        $article_news4->title = 'News 4';
        $article_news4->description = 'Description news 4';
        $article_news4->articletype_id = DatabaseSeeder::$article_type_news->id;


        $article_presse1 = new Article();
        $article_presse1->title = 'Le 20 minutes parle de nous!';
        $article_presse1->link = 'http://www.20min.ch/ro/news/suisse/story/Pres-de-100-0000-cartes-doivent--tre-remplacees-19831939';
        $article_presse1->articletype_id = DatabaseSeeder::$article_type_presse->id;

        $article_presse2 = new Article();
        $article_presse2->title = 'Presse 2';
        $article_presse2->link = 'http://www.20min.ch/ro/news/suisse/story/Pres-de-100-0000-cartes-doivent--tre-remplacees-19831939';
        $article_presse2->articletype_id = DatabaseSeeder::$article_type_presse->id;

        $article_presse3 = new Article();
        $article_presse3->title = 'Presse 3';
        $article_presse3->link = 'http://www.20min.ch/ro/news/suisse/story/Pres-de-100-0000-cartes-doivent--tre-remplacees-19831939';
        $article_presse3->articletype_id = DatabaseSeeder::$article_type_presse->id;

        $edition->articles()->saveMany([$article_news1, $article_news2, $article_news3, $article_news4]);
        $edition->articles()->saveMany([$article_presse1, $article_presse2, $article_presse3]);

        $article_news1->medias()->save($media_photo);
    }

}
