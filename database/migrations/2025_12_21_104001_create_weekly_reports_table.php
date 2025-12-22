<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('weekly_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->integer('minggu_ke');
            $table->integer('tahun');
            $table->integer('total_game_dimainkan')->default(0);
            $table->decimal('rata_rata_skor', 5, 2)->default(0);
            $table->integer('total_benar')->default(0);
            $table->integer('total_salah')->default(0);
            $table->json('detail_per_game')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('weekly_reports');
    }
};