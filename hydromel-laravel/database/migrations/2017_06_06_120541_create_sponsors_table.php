<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('society', 50);
            $table->integer('amount');
            $table->string('mail_contact', 100);
            $table->text('link')->nullable();
            $table->text('logo_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('sponsors');
    }

}
