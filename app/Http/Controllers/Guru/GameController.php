<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameTemplate;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::where('teacher_id', Auth::id())
            ->with('template')
            ->latest()
            ->paginate(15);

        return view('guru.games.index', compact('games'));
    }

    public function create()
    {
        $templates = GameTemplate::all();
        return view('guru.games.create', compact('templates'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'template_id' => 'required|exists:game_templates,id',
            'judul_game' => 'required',
            'deskripsi' => 'nullable',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'konten_game' => 'required|json'
        ]);

        $tanggalMulai = Carbon::parse($validated['tanggal_mulai']);
        $validated['minggu_ke'] = $tanggalMulai->week;
        $validated['tahun'] = $tanggalMulai->year;
        $validated['teacher_id'] = Auth::id();
        $validated['konten_game'] = json_decode($validated['konten_game'], true);

        Game::create($validated);

        return redirect()->route('guru.games.index')
            ->with('success', 'Game berhasil dibuat');
    }

    public function edit(Game $game)
    {
        if ($game->teacher_id !== Auth::id()) {
            abort(403);
        }

        $templates = GameTemplate::all();
        return view('guru.games.edit', compact('game', 'templates'));
    }

    public function update(Request $request, Game $game)
    {
        if ($game->teacher_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'template_id' => 'required|exists:game_templates,id',
            'judul_game' => 'required',
            'deskripsi' => 'nullable',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'konten_game' => 'required|json'
        ]);

        $tanggalMulai = Carbon::parse($validated['tanggal_mulai']);
        $validated['minggu_ke'] = $tanggalMulai->week;
        $validated['tahun'] = $tanggalMulai->year;
        $validated['konten_game'] = json_decode($validated['konten_game'], true);

        $game->update($validated);

        return redirect()->route('guru.games.index')
            ->with('success', 'Game berhasil diupdate');
    }

    public function publish(Game $game)
    {
        if ($game->teacher_id !== Auth::id()) {
            abort(403);
        }

        $game->update(['is_published' => true]);

        return redirect()->back()
            ->with('success', 'Game berhasil dipublish');
    }

    public function destroy(Game $game)
    {
        if ($game->teacher_id !== Auth::id()) {
            abort(403);
        }

        $game->delete();
        return redirect()->route('guru.games.index')
            ->with('success', 'Game berhasil dihapus');
    }

    public function assignStudents(Game $game)
    {
        if ($game->teacher_id !== Auth::id()) {
            abort(403);
        }

        $students = Student::with('parent')->get();
        $assignedStudents = $game->assignedStudents->pluck('id')->toArray();

        return view('guru.games.assign', compact('game', 'students', 'assignedStudents'));
    }

    public function updateAssignments(Request $request, Game $game)
    {
        if ($game->teacher_id !== Auth::id()) {
            abort(403);
        }

        $studentIds = $request->input('students', []);
        $game->assignedStudents()->sync($studentIds);

        return redirect()->route('guru.games.index')
            ->with('success', 'Penugasan game berhasil diupdate');
    }
}