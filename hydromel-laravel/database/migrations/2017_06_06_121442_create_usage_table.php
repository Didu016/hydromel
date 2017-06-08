<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usage', function (Blueprint $table) {
            $table->integer('media_id')->unsigned();
            $table->integer('edition_id')->unsigned();
            $table->foreign('media_id')->references('id')->on('medias');
            $table->foreign('edition_id')->references('id')->on('editions');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usage');
    }
}
