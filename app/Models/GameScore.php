<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameScore extends Model
{
    protected $fillable = [
        'game_id',
        'student_id',
        'skor',
        'total_soal',
        'benar',
        'salah',
        'detail_jawaban',
        'waktu_mulai',
        'waktu_selesai',
        'durasi_detik'
    ];

    protected $casts = [
        'detail_jawaban' => 'array',
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime'
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getPersentaseAttribute()
    {
        return $this->total_soal > 0 ? round(($this->benar / $this->total_soal) * 100, 2) : 0;
    }
}