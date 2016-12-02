<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Image extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image', function(Blueprint $table){
            $table->increments('id');
            $table->string('img_name');
            $table->string('project_id');
            $table->string('news_id');
            $table->string('event_id');
            $table->string('video_id');
            $table->string('main');
            $table->string('det');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('image');
    }
}
