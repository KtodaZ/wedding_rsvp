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
        factory(Attendee::class, 10)->create();
    }
}