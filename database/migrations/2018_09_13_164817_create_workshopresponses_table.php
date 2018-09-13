<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopresponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('WorkShopResponses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ws_id');
            $table->string('type')->nullable();
            $table->unsignedInteger('order_id')->nullable();                               
            $table->string('response_detail')->nullable();
            $table->string('response_date')->nullable();
            $table->string('response_days')->nullable();
            $table->string('response_price')->nullable();
            $table->string('response_selected')->nullable();
            $table->string('response_rejected')->nullable();                                                                         
            $table->string('picture_1')->nullable();
            $table->string('picture_2')->nullable();
            $table->string('picture_3')->nullable();
            $table->string('picture_4')->nullable();
            $table->string('picture_5')->nullable();
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
        Schema::dropIfExists('WorkShopResponses');
    }
}
