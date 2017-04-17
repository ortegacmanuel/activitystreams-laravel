<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uri', 191)->nullable();
            $table->string('object_type', 191)->nullable();
            $table->string('verb', 191)->nullable();            
            $table->integer('user_id')->unsigned()->index();
            $table->integer('objectable_id')->unsigned()->index()->nullable();
            $table->string('objectable_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activities');
    }
}