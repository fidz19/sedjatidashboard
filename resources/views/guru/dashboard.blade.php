@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('sidebar')
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('guru.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('guru.games.index') }}">
                <i class="bi bi-controller"></i> Kelola Game
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('guru.games.create') }}">
                <i class="bi bi-plus-circle"></i> Buat Game Baru
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <h2 class="mt-4">Dashboard Guru</h2>
    <p class="text-muted">Selamat datang, {{ Auth::user()->nama_lengkap }}</p>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Total Game Dibuat</h5>
                    <h2>{{ $totalGameDibuat }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Game Published</h5>
                    <h2>{{ $gamePublished }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h5>Game Terbaru</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul Game</th>
                        <th>Template</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentGames as $game)
                    <tr>
                        <td>{{ $game->judul_game }}</td>
                        <td>{{ $game->template->nama_template }}</td>
                        <td>
                            @if($game->is_published)
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-warning">Draft</span>
                            @endif
                        </td>
                        <td>{{ $game->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h5>Template Game Tersedia</h5>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($templates as $template)
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <i class="bi bi-controller" style="font-size: 2rem;"></i>
                            <h6 class="mt-2">{{ $template->nama_template }}</h6>
                            <small class="text-muted">{{ $template->tipe_game }}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection