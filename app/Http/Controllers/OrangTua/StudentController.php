<?php

namespace App\Http\Controllers\OrangTua;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function show(Student $student)
    {
        if ($student->parent_id !== Auth::id()) {
            abort(403);
        }

        $schedules = $student->schedules()
            ->with('teacher')
            ->where('is_active', true)
            ->orderBy('hari')
            ->get();

        $games = $student->assignedGames()
            ->where('is_published', true)
            ->whereBetween('tanggal_mulai', [now()->startOfWeek(), now()->endOfWeek()])
            ->get();

        $scores = $student->gameScores()
            ->with('game')
            ->latest()
            ->take(10)
            ->get();

        return view('orangtua.students.show', compact('student', 'schedules', 'games', 'scores'));
    }

    public function weeklyReport(Student $student)
    {
        if ($student->parent_id !== Auth::id()) {
            abort(403);
        }

        $mingguKe = now()->week;
        $tahun = now()->year;

        $report = $student->weeklyReports()
            ->where('minggu_ke', $mingguKe)
            ->where('tahun', $tahun)
            ->first();

        return view('orangtua.students.report', compact('student', 'report'));
    }
}