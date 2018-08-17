<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
           
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');
            $table->unsignedInteger('subservice_id');
            $table->foreign('subservice_id')->references('id')->on('services');
            $table->unsignedInteger('postalcode_id');
            $table->foreign('postalcode_id')->references('id')->on('postal_codes');
            $table->string('typeservice')->nullable();
            $table->string('cardescription');
            $table->time('hora');
            $table->date('datejob');
            $table->integer('resources')->nullable();
            $table->string('executiontime')->nullable();
            $table->decimal('price',8,2);
            $table->integer('rating');
            $table->string('review');
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
        Schema::dropIfExists('registers');
    }
}
