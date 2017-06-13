<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('medias', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('url');
            $table->integer('mediatype_id')->unsigned();
            $table->string('title', 50)->nullable();
            $table->string('legend', 100)->nullable();

            $table->foreign('mediatype_id')->references('id')->on('mediatypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('medias');
    }

}
