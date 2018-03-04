<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AttenddeePlusOnes extends Migration
{
    const TABLE = 'attendee_plus_ones';
    const ATTENDEE_TABLE = 'attendees';


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attendee_id')->unsigned();
            $table->integer('plus_one_attendee_id')->unsigned();

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('attendee_id')->references('id')->on(self::ATTENDEE_TABLE)->onDelete('cascade');
            $table->foreign('plus_one_attendee_id')->references('id')->on(self::ATTENDEE_TABLE)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE);
    }
}
