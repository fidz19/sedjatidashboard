@extends('layouts.app')

@section('title', 'Detail Siswa - ' . $student->nama_lengkap)

@section('sidebar')
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('orangtua.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        @foreach(Auth::user()->students as $s)
        <li class="nav-item">
            <a class="nav-link {{ $s->id === $student->id ? 'active' : '' }}" href="{{ route('orangtua.students.show', $s) }}">
                <i class="bi bi-person"></i> {{ $s->nama_lengkap }}
            </a>
        </li>
        @endforeach
    </ul>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div>
            <h2>{{ $student->nama_lengkap }}</h2>
            <p class="text-muted mb-0">Kelas {{ $student->kelas }} • {{ $student->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
        </div>
        <a href="{{ route('orangtua.students.report', $student) }}" class="btn btn-outline-primary">
            <i class="bi bi-file-earmark-text"></i> Laporan Mingguan
        </a>
    </div>

    <!-- Student Info Card -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <p class="mb-2"><strong>Nama Lengkap:</strong></p>
                            <p>{{ $student->nama_lengkap }}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-2"><strong>Tanggal Lahir:</strong></p>
                            <p>{{ $student->tanggal_lahir->format('d M Y') }} ({{ $student->tanggal_lahir->age }} tahun)</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-2"><strong>Kelas:</strong></p>
                            <p>{{ $student->kelas }}</p>
                        </div>
                        <div class="col-md-3">
                            <p class="mb-2"><strong>Alamat:</strong></p>
                            <p>{{ $student->alamat ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white shadow-sm" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Jadwal Aktif</h6>
                            <h2 class="mt-2 mb-0">{{ $schedules->count() }}</h2>
                            <small>sesi per minggu</small>
                        </div>
                        <i class="bi bi-calendar3 fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white shadow-sm" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Game Minggu Ini</h6>
                            <h2 class="mt-2 mb-0">{{ $games->count() }}</h2>
                            <small>game tersedia</small>
                        </div>
                        <i class="bi bi-controller fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white shadow-sm" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Rata-rata Skor</h6>
                            <h2 class="mt-2 mb-0">{{ $scores->count() > 0 ? number_format($scores->avg('skor'), 1) : '-' }}</h2>
                            <small>dari {{ $scores->count() }} game</small>
                        </div>
                        <i class="bi bi-trophy fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-calendar-week"></i> Jadwal Belajar</h5>
                </div>
                <div class="card-body">
                    @if($schedules->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Hari</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Guru</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($schedules as $schedule)
                                    <tr>
                                        <td><span class="badge" style="background-color: #10b981;">{{ $schedule->hari }}</span></td>
                                        <td>{{ $schedule->mata_pelajaran }}</td>
                                        <td>{{ $schedule->teacher->nama_lengkap }}</td>
                                        <td>{{ $schedule->jam_mulai }} - {{ $schedule->jam_selesai }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-calendar-x fs-1"></i>
                            <p class="mt-2">Belum ada jadwal belajar</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Games Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-controller"></i> Game Minggu Ini</h5>
                </div>
                <div class="card-body">
                    @if($games->count() > 0)
                        <div class="row">
                            @foreach($games as $game)
                            <div class="col-md-6 mb-3">
                                <div class="card border">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $game->judul_game }}</h6>
                                        <p class="card-text text-muted small">{{ Str::limit($game->deskripsi, 100) }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="bi bi-calendar"></i> {{ $game->tanggal_mulai->format('d M') }} - {{ $game->tanggal_selesai->format('d M Y') }}
                                            </small>
                                            @php
                                                $hasPlayed = $student->gameScores()->where('game_id', $game->id)->exists();
                                            @endphp
                                            @if($hasPlayed)
                                                <span class="badge bg-success">
                                                    <i class="bi bi-check-circle"></i> Selesai
                                                </span>
                                            @else
                                                <a href="{{ route('orangtua.games.play', [$student, $game]) }}" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-play-fill"></i> Mainkan
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-controller fs-1"></i>
                            <p class="mt-2">Belum ada game untuk minggu ini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Scores Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-graph-up"></i> Riwayat Skor Terbaru</h5>
                </div>
                <div class="card-body">
                    @if($scores->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama Game</th>
                                        <th>Skor</th>
                                        <th>Benar/Salah</th>
                                        <th>Durasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($scores as $score)
                                    <tr>
                                        <td>{{ $score->created_at->format('d M Y H:i') }}</td>
                                        <td>{{ $score->game->judul_game }}</td>
                                        <td>
                                            <span class="badge {{ $score->skor >= 80 ? 'bg-success' : ($score->skor >= 60 ? 'bg-warning' : 'bg-danger') }}">
                                                {{ number_format($score->skor, 1) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-success">{{ $score->benar }}</span> / 
                                            <span class="text-danger">{{ $score->salah }}</span>
                                            <small class="text-muted">({{ $score->total_soal }} soal)</small>
                                        </td>
                                        <td>{{ gmdate('i:s', $score->durasi_detik) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-graph-up fs-1"></i>
                            <p class="mt-2">Belum ada riwayat skor</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-2px);
    }
    .nav-link.active {
        background-color: #10b981;
        color: white !important;
        border-radius: 5px;
    }
</style>
@endpush
