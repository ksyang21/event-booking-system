<?php

namespace Database\Seeders;

use App\Models\Event;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(Faker $faker) {
        for($i = 0; $i < 10; $i++) {
            $event = new Event();
            $event->title = $faker->text(10);
            $event->description = $faker->paragraph();
            $event->date = $faker->date();
            $event->time = $faker->time();
            $event->location = $faker->address();
            $event->capacity = $faker->randomDigit();
            $event->status = 0;
            $event->save();
        }
    }
}
