<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventAttendeesPlusOnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendee_plus_ones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attendee_id')->unsigned();
            $table->integer('plus_one_attendee_id')->unsigned();
            $table->foreign('attendee_id')->references('id')->on('attendees')->onDelete('cascade');
            $table->foreign('plus_one_attendee_id')->references('id')->on('attendees')->onDelete('cascade');
            $table->unique(['attendee_id', 'plus_one_attendee_id']);
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
        Schema::dropIfExists('attendee_plus_ones');
    }
}
