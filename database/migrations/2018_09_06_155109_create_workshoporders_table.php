<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('WorkShopOrders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
           
            $table->unsignedInteger('user_work_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('type')->nullable();
            $table->string('order_id')->nullable();
            $table->string('cause')->nullable();
            $table->string('detail_cause')->nullable();
            $table->string('detail')->nullable();
            $table->string('request_date')->nullable();
            $table->string('finish_date')->nullable();
            $table->string('status')->nullable();
            $table->string('valoration')->nullable();
            $table->string('amount')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
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
        Schema::dropIfExists('WorkShopOrders');
    }
}
