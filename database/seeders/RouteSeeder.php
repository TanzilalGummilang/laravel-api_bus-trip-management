<?php

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            $busStop = [
                'bus_stop' => json_encode([
                    ["id"=> 3, "time_stop"=> 30],
                    ["id"=> 1, "time_stop"=> 10],
                    ["id"=> 4, "time_stop"=> 20],
                    ["id"=> 2, "time_stop"=> 5],
                ])
            ];
            Route::create(array_merge([
                'code' => 'TNG-BDG-010',
                'origin' => 'Ciputat Tangerang Selatan',
                'destination' => 'Kota Bandung Jawa Barat',
                'time_taken' => '300',
            ], $busStop));
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}