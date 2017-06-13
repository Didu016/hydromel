<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsoringTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sponsoring', function (Blueprint $table) {
            $table->integer('edition_id')->unsigned();
            $table->integer('sponsor_id')->unsigned();
            $table->integer('rank_id')->unsigned()->nullable();
            $table->foreign('edition_id')->references('id')->on('editions');
            $table->foreign('sponsor_id')->references('id')->on('sponsors');
            $table->foreign('rank_id')->references('id')->on('ranks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('sponsoring');
    }

}
