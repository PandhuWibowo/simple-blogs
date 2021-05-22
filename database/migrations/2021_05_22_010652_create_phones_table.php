<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->string('phone');
        });

        Schema::table('phones', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        // Schema::table('posts', function($table) {
        //     $table->foreign('user_id')->references('id')->on('users');
        //     $table->foreign('category_id')->references('id')->on('categories');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phones');
    }
}
