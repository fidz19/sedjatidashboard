<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GameTemplate;

class GameTemplateSeeder extends Seeder
{
    public function run()
    {
        GameTemplate::create([
            'nama_template' => 'Mencocokkan Kata',
            'tipe_game' => 'mencocokkan_kata',
            'deskripsi' => 'Game untuk mencocokkan kata dalam Bahasa Inggris/Arab dengan Bahasa Indonesia'
        ]);

        GameTemplate::create([
            'nama_template' => 'TTS Alat Tulis',
            'tipe_game' => 'tts_alat_tulis',
            'deskripsi' => 'Teka-teki silang tentang alat tulis dalam Bahasa Inggris'
        ]);

        GameTemplate::create([
            'nama_template' => 'Menghitung Huruf Hijaiyah',
            'tipe_game' => 'hitung_hijaiyah',
            'deskripsi' => 'Game menghitung jumlah huruf hijaiyah dalam teks Arab'
        ]);

        GameTemplate::create([
            'nama_template' => 'Temukan Kata Tersembunyi',
            'tipe_game' => 'kata_tersembunyi',
            'deskripsi' => 'Game mencari kata tersembunyi dalam grid huruf'
        ]);
    }
}