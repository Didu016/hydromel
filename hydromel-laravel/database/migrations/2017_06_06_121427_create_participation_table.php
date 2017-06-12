<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participation', function (Blueprint $table) {
            $table->integer('member_id')->unsigned();
            $table->integer('responsibility_id')->unsigned();
            $table->integer('media_id')->unsigned();
            $table->integer('edition_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('responsibility_id')->references('id')->on('responsibilities');
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
        Schema::dropIfExists('participation');
    }
}
