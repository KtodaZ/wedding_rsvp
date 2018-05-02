<?php

use Illuminate\Database\Seeder;
use App\Models\Attendee;

class AttendeesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        factory(Attendee::class, 100)->create();

        Schema::enableForeignKeyConstraints();
    }
}