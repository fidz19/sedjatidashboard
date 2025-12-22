<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameTemplate;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalGameDibuat = Game::where('teacher_id', Auth::id())->count();
        $gamePublished = Game::where('teacher_id', Auth::id())
            ->where('is_published', true)
            ->count();
        
        $recentGames = Game::where('teacher_id', Auth::id())
            ->with('template')
            ->latest()
            ->take(5)
            ->get();

        $templates = GameTemplate::all();

        return view('guru.dashboard', compact(
            'totalGameDibuat',
            'gamePublished',
            'recentGames',
            'templates'
        ));
    }
}
