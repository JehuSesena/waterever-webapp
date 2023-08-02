<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SessionTimeLog;
use Carbon\Carbon;

class SessionTimeLogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SessionTimeLog::create([
            'user_id' => 1,
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now()->addMinutes(30),
            'duration' => 30 * 60, // 30 minutos en segundos
        ]);

        SessionTimeLog::create([
            'user_id' => 1,
            'start_time' => Carbon::now()->subHours(1),
            'end_time' => Carbon::now(),
            'duration' => 60 * 60, // 1 hora en segundos
        ]);

        SessionTimeLog::create([
            'user_id' => 1,
            'start_time' => Carbon::now()->subHours(2),
            'end_time' => Carbon::now()->subHours(1),
            'duration' => 60 * 60, // 1 hora en segundos
        ]);

        // Puedes agregar más registros si lo deseas
    }
}

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// class SessionTimeLogsSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      *
//      * @return void
//      */
//     public function run()
//     {
//         //
//     }
// }

