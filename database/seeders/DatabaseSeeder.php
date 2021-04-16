<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::create([
//             'name' => 'Администратор',
//             'email' => 'admin@newcamry.ru',
//             'password' => Hash::make('RuMc2Fky')
//         ]);
        Car::create([
            'name' => 'Toyota Camry 2.5',
            'info_one' => '6,8 л/100 км',
            'info_two' => '210 км/ч',
            'info_three' => '8,7 сек',
            ]);
        Car::create([
            'name' => 'Toyota Camry 3.5',
            'info_one' => '8,7 л/100 км',
            'info_two' => '220 км/ч',
            'info_three' => '7,7 км/ч',
        ]);
        $start_time = Carbon::create(null, null, null, 12, 0, 0);
        $end_time = Carbon::create(null, null, null, 16, 0, 0);
        $gap = 15;
        $cars = Car::all();
        foreach ($cars as $car) {
            $start_time = Carbon::create(null, null, null, 12, 0, 0);
            $end_time = Carbon::create(null, null, null, 16, 0, 0);
            $gap = 15;
            while ($start_time <= $end_time) {
                Time::create([
                    'name' => $start_time->format('H:i'),
                    'car_id' => $car->id
                ]);
                $start_time = $start_time->addMinutes($gap);
            }
        }
    }
}
