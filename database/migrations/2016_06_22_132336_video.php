<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Video extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->text('des');
            $table->string('link_video');
            $table->string('link_video2');
            $table->string('link_video3');
            $table->string('keywords');
            $table->string('img');
            $table->string('cat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('video');
    }
}
