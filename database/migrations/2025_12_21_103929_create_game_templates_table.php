<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('game_templates', function (Blueprint $table) {
            $table->id();
            $table->string('nama_template');
            $table->enum('tipe_game', [
                'mencocokkan_kata',
                'tts_alat_tulis',
                'hitung_hijaiyah',
                'kata_tersembunyi'
            ]);
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('game_templates');
    }
};