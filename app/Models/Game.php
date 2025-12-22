<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'template_id',
        'teacher_id',
        'judul_game',
        'deskripsi',
        'minggu_ke',
        'tahun',
        'tanggal_mulai',
        'tanggal_selesai',
        'konten_game',
        'is_published'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'konten_game' => 'array',
        'is_published' => 'boolean'
    ];

    public function template()
    {
        return $this->belongsTo(GameTemplate::class, 'template_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function scores()
    {
        return $this->hasMany(GameScore::class);
    }

    public function assignedStudents()
    {
        return $this->belongsToMany(Student::class, 'game_assignments');
    }
}