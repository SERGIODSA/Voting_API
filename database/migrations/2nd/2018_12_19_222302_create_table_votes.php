<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fruit_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('votes', function($table) {
           $table->foreign('fruit_id')->references('id')->on('fruits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('votes', function(Blueprint $table){
            $table->dropForeign(['fruit_id']);
        });
        Schema::dropIfExists('votes');
    }
}
