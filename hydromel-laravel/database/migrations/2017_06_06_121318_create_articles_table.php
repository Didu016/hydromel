<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->text('link')->nullable();
            $table->integer('edition_id')->unsigned();
            $table->integer('articletype_id')->unsigned();
            $table->foreign('edition_id')->references('id')->on('editions');
            $table->foreign('articletype_id')->references('id')->on('articletypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('articles');
    }

}
