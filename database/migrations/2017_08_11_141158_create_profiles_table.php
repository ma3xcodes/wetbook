<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->tinyInteger('privacy',false)->default(1);
            $table->tinyInteger('rating', false)->default(1);
            $table->string('about_me')->nullable();
            $table->string('relatinship')->nullable();
            $table->string('looking_for')->nullable();
            $table->string('phone')->nullable();
            $table->string('interests')->nullable();
            $table->string('education')->nullable();
            $table->string('hobbies')->nullable();
            $table->integer('language_id')->default(1);
            $table->string('fav_movies')->nullable();
            $table->string('fav_artists')->nullable();
            $table->string('fav_books')->nullable();
            $table->string('fav_animals')->nullable();
            $table->tinyInteger('religion', false)->nullable();
            $table->integer('photo_id');
            $table->integer('cover_id')->nullable();
            $table->string('public_folder');
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
        Schema::dropIfExists('profiles');
    }
}
