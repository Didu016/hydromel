<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('rewards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('edition_id')->unsigned();
            $table->string('distinction', 50);
            $table->smallInteger('position');
            $table->text('description');
            $table->integer('value')->unsigned()->nullable();

            $table->foreign('edition_id')->references('id')->on('editions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('rewards');
    }

}
