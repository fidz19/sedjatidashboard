<?php

namespace App\Http\Controllers\OrangTua;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $students = Student::where('parent_id', Auth::id())
            ->with(['schedules', 'gameScores'])
            ->get();

        return view('orangtua.dashboard', compact('students'));
    }
}