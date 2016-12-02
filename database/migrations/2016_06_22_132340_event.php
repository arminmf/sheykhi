<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Event extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->text('des');
            $table->string('time');
            $table->string('location');
            $table->string('lat');
            $table->string('log');
            $table->string('author_id');
            $table->string('fadate');
            $table->string('tarikh');
            $table->boolean('important');
            $table->string('keywords');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event');
    }
}
