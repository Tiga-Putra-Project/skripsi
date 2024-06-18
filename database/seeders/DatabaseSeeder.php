<?php

namespace Database\Seeders;

use App\Models\Jam;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Pelabuhan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'user_unique_id' => 'TP0001',
            'fullname' => 'Test User',
            'username' => 'test_user',
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
            'alamat' => 'test no.123',
            'role' => 'admin',
        ]);

        Pelabuhan::create([
            'nama_kota' => 'Balikpapan',
            'nama_provinsi' => 'Kalimantan Timur',
            'tempat_pelabuhan' => 'Balikpapan',
            'kode_pelabuhan' => 'BPN'
        ]);
        Pelabuhan::create([
            'nama_kota' => 'Berau',
            'nama_provinsi' => 'Kalimantan Timur',
            'tempat_pelabuhan' => 'Mataritip',
            'kode_pelabuhan' => 'MRP'
        ]);
        Pelabuhan::create([
            'nama_kota' => 'Bontang',
            'nama_provinsi' => 'Kalimantan Timur',
            'tempat_pelabuhan' => 'Bontang',
            'kode_pelabuhan' => 'LTU'
        ]);
        Pelabuhan::create([
            'nama_kota' => 'Nunukan',
            'nama_provinsi' => 'Kalimantan Timur',
            'tempat_pelabuhan' => 'Nunukan',
            'kode_pelabuhan' => 'TTK'
        ]);
        Pelabuhan::create([
            'nama_kota' => 'Tarakan',
            'nama_provinsi' => 'Kalimantan Timur',
            'tempat_pelabuhan' => 'Tarakan',
            'kode_pelabuhan' => 'MLD'
        ]);
        Pelabuhan::create([
            'nama_kota' => 'Nunukan',
            'nama_provinsi' => 'Kalimantan Timur',
            'tempat_pelabuhan' => 'Sungan Nyamuk',
            'kode_pelabuhan' => 'SNYK'
        ]);
        Pelabuhan::create([
            'nama_kota' => 'Baru',
            'nama_provinsi' => 'Kalimantan Selatan',
            'tempat_pelabuhan' => 'Kotabaru',
            'kode_pelabuhan' => 'KTB'
        ]);
        Pelabuhan::create([
            'nama_kota' => 'Baru',
            'nama_provinsi' => 'Kalimantan Selatan',
            'tempat_pelabuhan' => 'Marabatuan',
            'kode_pelabuhan' => 'MBN'
        ]);
        Pelabuhan::create([
            'nama_kota' => 'Baru',
            'nama_provinsi' => 'Kalimantan Selatan',
            'tempat_pelabuhan' => 'Matasari',
            'kode_pelabuhan' => 'MSR'
        ]);
        Pelabuhan::create([
            'nama_kota' => 'Tanah Bumbu',
            'nama_provinsi' => 'Kalimantan Selatan',
            'tempat_pelabuhan' => 'Batu Licin',
            'kode_pelabuhan' => 'SUR'
        ]);
        Pelabuhan::create([
            'nama_kota' => 'Kotawaringin Barat',
            'nama_provinsi' => 'Kalimantan Tengah',
            'tempat_pelabuhan' => 'Pangkalan Bun',
            'kode_pelabuhan' => 'PLB'
        ]);
        Pelabuhan::create([
            'nama_kota' => 'Kotawaringin Barat',
            'nama_provinsi' => 'Kalimantan Tengah',
            'tempat_pelabuhan' => 'Kumai',
            'kode_pelabuhan' => 'KUM'
        ]);
        Pelabuhan::create([
            'nama_kota' => 'Kotawaringin Timur',
            'nama_provinsi' => 'Kalimantan Tengah',
            'tempat_pelabuhan' => 'Sampit',
            'kode_pelabuhan' => 'SMQ'
        ]);
        Pelabuhan::create([
            'nama_kota' => 'Ketapang',
            'nama_provinsi' => 'Kalimantan Barat',
            'tempat_pelabuhan' => 'Kendawangan',
            'kode_pelabuhan' => 'KDW'
        ]);
        Pelabuhan::create([
            'nama_kota' => 'Ketapang',
            'nama_provinsi' => 'Kalimantan Barat',
            'tempat_pelabuhan' => 'Sukabangun Ketapang',
            'kode_pelabuhan' => 'KTP'
        ]);
        Pelabuhan::create([
            'nama_kota' => 'Pontianak',
            'nama_provinsi' => 'Kalimantan Barat',
            'tempat_pelabuhan' => 'Pontianak',
            'kode_pelabuhan' => 'PNK'
        ]);
        Pelabuhan::create([
            'nama_kota' => 'Sambas',
            'nama_provinsi' => 'Kalimantan Barat',
            'tempat_pelabuhan' => 'Sintete',
            'kode_pelabuhan' => 'SNE'
        ]);
    }
}
