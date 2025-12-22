<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('parent')->paginate(20);
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $parents = User::whereHas('role', function($q) {
            $q->where('name', 'orang_tua');
        })->get();
        return view('admin.students.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => 'required|exists:users,id',
            'nama_lengkap' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas' => 'nullable',
            'alamat' => 'nullable'
        ]);

        Student::create($validated);

        return redirect()->route('admin.students.index')
            ->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit(Student $student)
    {
        $parents = User::whereHas('role', function($q) {
            $q->where('name', 'orang_tua');
        })->get();
        return view('admin.students.edit', compact('student', 'parents'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'parent_id' => 'required|exists:users,id',
            'nama_lengkap' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas' => 'nullable',
            'alamat' => 'nullable'
        ]);

        $student->update($validated);

        return redirect()->route('admin.students.index')
            ->with('success', 'Siswa berhasil diupdate');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')
            ->with('success', 'Siswa berhasil dihapus');
    }
}