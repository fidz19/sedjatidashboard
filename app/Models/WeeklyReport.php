<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyReport extends Model
{
    protected $fillable = [
        'student_id',
        'minggu_ke',
        'tahun',
        'total_game_dimainkan',
        'rata_rata_skor',
        'total_benar',
        'total_salah',
        'detail_per_game',
        'catatan'
    ];

    protected $casts = [
        'detail_per_game' => 'array'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}