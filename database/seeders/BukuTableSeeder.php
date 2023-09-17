<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data dummy untuk tabel 'buku'
        $data = [
            [
                'judul' => 'Judul Buku 1',
                'penulis' => 'Penulis 1',
                'harga' => 50,
                'tg_terbit' => '2023-01-15',
            ],
            [
                'judul' => 'Judul Buku 2',
                'penulis' => 'Penulis 2',
                'harga' => 40,
                'tg_terbit' => '2023-02-20',
            ],
            [
                'judul' => 'Judul Buku 3',
                'penulis' => 'Penulis 3',
                'harga' => 60,
                'tg_terbit' => '2023-03-25',
            ],
        ];

        // Masukkan data ke dalam tabel 'buku'
        DB::table('buku')->insert($data);
    }
}
