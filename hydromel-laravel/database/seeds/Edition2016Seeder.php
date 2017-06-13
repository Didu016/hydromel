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

class Edition2016Seeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        /////////// HYDROMEL DATA SEEDING EDITION 2017 ///////////
        // Members
        $member_carla = Member::create([
                    'firstname' => 'Carla',
                    'name' => 'Enzen',
                    'email' => 'carla.enzen@heig-vd.ch'
        ]);

        $member_josephine = Member::create([
                    'firstname' => 'Joséphine',
                    'name' => 'Chabin',
                    'email' => 'josephine.chabin@heig-vd.ch'
        ]);



        $media_photo = new Media();
        $media_photo->url = 'http://hydro.heig-vd.ch/wp-content/uploads/2017/03/laugra.jpg';
        $media_photo->title = 'Photo Laurent';
        $media_photo->mediatype_id = DatabaseSeeder::$media_type_photo->id;


        // Editions
        $edition = Edition::create([
                    'team' => 'Equipe pas forte',
                    'year' => 2016,
                    'description' => 'II s’agit d’une des problématiques actuelles et communes liées au développement industriel et technologique de notre ère. Avec 90% des échanges commerciaux opérés par la mer, le transport maritime est un enjeu économique et environnemental majeur. En effet, si le bateau reste le moyen de transport le plus écologique, en matière d’emissions de CO2 par tonne transportée, il représente tout de même la 5ème source de pollution mondiale.',
                    'start_date' => Carbon\Carbon::parse('2016-06-10'),
                    'end_date' => Carbon\Carbon::parse('2016-06-19'),
                    'place' => 'Lausanne'
        ]);

        $edition_sponsor1 = Sponsor::create([
                    'society' => 'Le CERN',
                    'amount_min' => 10000,
                    'amount_max' => 10000,
                    'mail_contact' => 'infos@cern.ch',
                    'link' => 'https://home.cern/fr/about'
        ]);

        $edition_sponsor2 = Sponsor::create([
                    'society' => 'Romande Energie',
                    'amount_min' => 800,
                    'amount_max' => 800,
                    'mail_contact' => 'info@romande-energie.ch',
                    'link' => 'https://www.romande-energie.ch/'
        ]);
        $edition->sponsors()->saveMany([$edition_sponsor1, $edition_sponsor2]);
        $edition->medias()->save($media_photo);

        $participation_josephine = Participation::create([
                    'member_id' => $member_josephine->id,
                    'edition_id' => $edition->id,
                    'responsibility_id' => DatabaseSeeder::$responsibility_team_manager->id,
                    'media_id' => $media_photo->id
        ]);


        // Responsibilities
        $responsibility_ep_manager = Responsibility::create([
                    'name' => 'External provider'
        ]);
        $participation_colin = Participation::create([
                    'member_id' => $member_carla->id,
                    'edition_id' => $edition->id,
                    'responsibility_id' => $responsibility_ep_manager->id,
                    'media_id' => $media_photo->id
        ]);


        $article_news = new Article();
        $article_news->title = 'Lancement de l\'édition Hydrocontest 2016!';
        $article_news->description = 'Nous sommes contents de vous retrouver cette année pour une nouvelle participation au concours hydrocontest. Cette année, notre nouvelle équipe se réjouit de donner son maximum pour remporter ce concours!';
        $article_news->articletype_id = DatabaseSeeder::$article_type_news->id;

        $article_presse = new Article();
        $article_presse->title = 'LeTemps parle de nous!';
        $article_presse->link = 'https://www.letemps.ch/suisse/2017/06/08/dechets-zurich-une-oasis-luxe';
        $article_presse->articletype_id = DatabaseSeeder::$article_type_presse->id;

        $edition->articles()->save($article_news);
        $edition->articles()->save($article_presse);

        $article_news->medias()->save($media_photo);
    }

}
