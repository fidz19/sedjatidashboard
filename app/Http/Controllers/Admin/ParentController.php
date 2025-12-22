<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ParentController extends Controller
{
    public function index()
    {
        $parents = User::whereHas('role', function($q) {
            $q->where('name', 'orang_tua');
        })->paginate(20);
        
        return view('admin.parents.index', compact('parents'));
    }

    public function create()
    {
        return view('admin.parents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nama_lengkap' => 'required',
            'no_telepon' => 'nullable',
        ]);

        $parentRole = Role::where('name', 'orang_tua')->firstOrFail();
        $validated['role_id'] = $parentRole->id;

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.parents.index')
            ->with('success', 'Orang Tua berhasil ditambahkan');
    }

    public function edit(User $parent)
    {
        // Ensure the user is actually a parent
        if (!$parent->isParent()) {
            return redirect()->route('admin.parents.index')->with('error', 'User bukan orang tua');
        }
        
        return view('admin.parents.edit', compact('parent'));
    }

    public function update(Request $request, User $parent)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users,username,' . $parent->id,
            'email' => 'required|email|unique:users,email,' . $parent->id,
            'nama_lengkap' => 'required',
            'no_telepon' => 'nullable',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $parent->update($validated);

        return redirect()->route('admin.parents.index')
            ->with('success', 'Orang Tua berhasil diupdate');
    }

    public function destroy(User $parent)
    {
        // Check if parent has associated students before deleting
        if ($parent->students()->exists()) {
             return redirect()->route('admin.parents.index')
            ->with('error', 'Tidak dapat menghapus orang tua yang masih memiliki siswa terkait');
        }

        $parent->delete();
        return redirect()->route('admin.parents.index')
            ->with('success', 'Orang Tua berhasil dihapus');
    }
}
