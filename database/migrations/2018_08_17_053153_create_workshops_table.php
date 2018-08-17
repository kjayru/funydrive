<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->increments('id');
            $table->text('ws_ID');
            $table->text('ws_name');
            $table->text('ws_address');
            $table->text('ws_email');
            $table->text('ws_description');
            $table->time('ws_horario_inicio');
            $table->time('ws_horario_fin');
            $table->text('ws_dias_trabajo');
            $table->double('ws_latitude');
            $table->double('ws_longitude');
            $table->text('ws_contact_nam');
            $table->text('ws_contact_pro');
            $table->double('ws_valoration');
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
        Schema::dropIfExists('workshops');
    }
}
