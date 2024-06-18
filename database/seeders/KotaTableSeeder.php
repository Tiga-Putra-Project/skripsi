<?php

namespace Database\Seeders;

use App\Models\Kota;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = Storage::disk('local')->get('/json/kota.json');
        $kotas = json_decode($json, true);
        foreach ($kotas as $kota) {
            Kota::query()->updateOrCreate([
                'name' => $kota['name'],
            ]);
        }
    }
}
