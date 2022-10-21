<?php

namespace Database\Seeders;

use App\Models\Terminal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TerminalSeeder extends Seeder
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
            Terminal::create([
                'code' => "JKT-001",
                'name' => "Lebak Bulus",
                'address' => "jalan lebak bulus",
                'province' => "DKI Jakarta",
                'district' => "Jakarta Selatan",
                'sub_district' => "Kecamatan Lebak Bulus",
                'type' => "checkpoint"
            ]);
            Terminal::create([
                'code' => "BDG-001",
                'name' => "Leuwi Panjang",
                'address' => "jalan bandung",
                'province' => "Jawa Barat",
                'district' => "Kota Bandung",
                'sub_district' => "Kecamatan Bandung",
                'type' => "terminal"
            ]);
            Terminal::create([
                'code' => "TNG-001",
                'name' => "Gaplek",
                'address' => "jalan martadinata",
                'province' => "Banten",
                'district' => "Tangerang Selatan",
                'sub_district' => "Kecamatan Ciputat",
                'type' => "pool"
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
