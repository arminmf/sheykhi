<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pages', function(Blueprint $table){
          $table->increments('id');
          $table->string('title');
          $table->text('des');
          $table->string('time');
          $table->string('eng_name');
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
        //
    }
}
