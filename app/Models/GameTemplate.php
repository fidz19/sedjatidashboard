<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameTemplate extends Model
{
    protected $fillable = [
        'nama_template',
        'tipe_game',
        'deskripsi'
    ];

    public function games()
    {
        return $this->hasMany(Game::class, 'template_id');
    }
}
