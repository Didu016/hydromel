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
use App\Models\Rank;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static $media_type_video = null;
    public static $media_type_photo = null;
    public static $responsibility_team_manager = null;
    public static $article_type_presse = null;
    public static $article_type_news = null;
    public static $rank_or = null;
    public static $rank_argent = null;
    public static $rank_bronze = null;

    public function run() {

        Schema::disableForeignKeyConstraints();
        DB::table('access')->truncate();
        DB::table('articles')->truncate();
        DB::table('articletypes')->truncate();
        DB::table('editions')->truncate();
        DB::table('groups')->truncate();
        DB::table('integration')->truncate();
        DB::table('medias')->truncate();
        DB::table('mediatypes')->truncate();
        DB::table('members')->truncate();
        DB::table('membership')->truncate();
        DB::table('participation')->truncate();
        DB::table('resources')->truncate();
        DB::table('responsibilities')->truncate();
        DB::table('rewards')->truncate();
        DB::table('ranks')->truncate();
        DB::table('sponsoring')->truncate();
        DB::table('sponsors')->truncate();
        DB::table('usage')->truncate();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();


        /////////// ACL SEEDING ///////////
        $admin = User::create([
                    'username' => 'admin',
                    'email' => 'admin@hydromel.ch',
                    'password' => bcrypt('admin'),
        ]);

        $group_admin = Group::create([
                    'name' => 'admin',
        ]);

        $resource_hydromel = Resource::create([
                    'application' => 'hydromel',
                    'action' => 'getHome'
        ]);

        $group_admin->users()->save($admin);
        $group_admin->resources()->save($resource_hydromel);

        // Responsibilities
        $this::$responsibility_team_manager = Responsibility::create([
                    'name' => 'Team Manager'
        ]);

        // Medias
        $this::$media_type_video = MediaType::create([
                    'name' => 'video'
        ]);
        $this::$media_type_photo = MediaType::create([
                    'name' => 'photo'
        ]);

        // Articles
        $this::$article_type_presse = ArticleType::create([
                    'name' => 'presse'
        ]);
        $this::$article_type_news = ArticleType::create([
                    'name' => 'news'
        ]);

        $this::$rank_or = Rank::create([
                    'name' => 'or'
        ]);

        $this::$rank_argent = Rank::create([
                    'name' => 'argent'
        ]);

        $this::$rank_bronze = Rank::create([
                    'name' => 'bronze'
        ]);




        $this->call(Edition2015Seeder::class);
        $this->call(Edition2016Seeder::class);
        $this->call(Edition2017Seeder::class);
    }

}
