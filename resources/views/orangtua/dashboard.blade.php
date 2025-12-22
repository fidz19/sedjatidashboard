@extends('layouts.app')

@section('title', 'Dashboard Orang Tua')

@section('sidebar')
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('orangtua.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        @foreach($students as $student)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('orangtua.students.show', $student) }}">
                <i class="bi bi-person"></i> {{ $student->nama_lengkap }}
            </a>
        </li>
        @endforeach
    </ul>
@endsection

@section('content')
    <h2 class="mt-4">Dashboard Orang Tua</h2>
    <p class="text-muted">Selamat datang, {{ Auth::user()->nama_lengkap }}</p>

    <div class="row mt-4">
        @foreach($students as $student)
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header text-white" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <h5 class="mb-0">{{ $student->nama_lengkap }}</h5>
                </div>
                <div class="card-body">
                    <p><strong>Kelas:</strong> {{ $student->kelas }}</p>
                    <p><strong>Jadwal Minggu Ini:</strong> {{ $student->schedules->count() }} sesi</p>
                    <p><strong>Game Tersedia:</strong> {{ $student->assignedGames->where('is_published', true)->count() }} game</p>
                    <a href="{{ route('orangtua.students.show', $student) }}" class="btn btn-primary mt-2">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection