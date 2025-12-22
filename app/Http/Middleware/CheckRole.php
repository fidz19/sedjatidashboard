<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if ($role === 'admin' && !$user->isAdmin()) {
            abort(403, 'Unauthorized action. Debug: Name=' . $user->nama_lengkap . ', Role=' . ($user->role ? $user->role->name : 'None'));
        }

        if ($role === 'guru' && !$user->isTeacher()) {
            abort(403, 'Unauthorized action.');
        }

        if ($role === 'orang_tua' && !$user->isParent()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}