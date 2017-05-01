<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachineStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_states', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('machine_id')->unsigned()->nullable();
            $table->unsignedTinyInteger('seconds_remaining');
            $table->timestamps();

            // Foreign keys.
            $table->foreign('machine_id')->references('id')->on('machines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('machine_states');
    }
}
