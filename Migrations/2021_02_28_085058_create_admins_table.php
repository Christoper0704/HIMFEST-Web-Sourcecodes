<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->integer('leader_id')->references('id')->on('member');
            $table->text('password');
            $table->text('category');
        });
        Schema::create('member', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id')->references('id')->on('team');
            $table->text('name');
            $table->text('email');
            $table->text('lineid');
            $table->text('phone');
            $table->text('studentcard');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team');
        Schema::dropIfExists('member');
    }
}
