<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'parent_id',
        'nama_lengkap',
        'tanggal_lahir',
        'jenis_kelamin',
        'kelas',
        'alamat'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function gameScores()
    {
        return $this->hasMany(GameScore::class);
    }

    public function weeklyReports()
    {
        return $this->hasMany(WeeklyReport::class);
    }

    public function assignedGames()
    {
        return $this->belongsToMany(Game::class, 'game_assignments');
    }
}