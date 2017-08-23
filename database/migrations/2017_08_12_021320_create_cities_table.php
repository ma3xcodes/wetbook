<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->char('country'); //char (6),
            $table->string('region');
            //$table->char('code')->default(false); //char (9),
            $table->string('name'); //varchar (150),
            $table->double('latitude'); //double ,
            $table->double('longitude'); //double ,
            //$table->integer('cities'); //int (4)
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
        Schema::dropIfExists('cities');
    }
}
