<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Game;
use App\Models\GameScore;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGuru = User::whereHas('role', function($q) {
            $q->where('name', 'guru');
        })->count();

        $totalOrangTua = User::whereHas('role', function($q) {
            $q->where('name', 'orang_tua');
        })->count();

        $totalSiswa = Student::count();
        $totalGame = Game::where('is_published', true)->count();

        return view('admin.dashboard', compact(
            'totalGuru',
            'totalOrangTua',
            'totalSiswa',
            'totalGame'
        ));
    }
}