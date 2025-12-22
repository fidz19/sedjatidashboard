@extends('layouts.app')

@section('title', 'Laporan Mingguan - ' . $student->nama_lengkap)

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
            <h2><i class="bi bi-file-earmark-text"></i> Laporan Mingguan</h2>
            <p class="text-muted mb-0">{{ $student->nama_lengkap }} • Minggu ke-{{ now()->week }}, {{ now()->year }}</p>
        </div>
        <a href="{{ route('orangtua.students.show', $student) }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    @if($report)
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header text-white" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                        <h5 class="mb-0">Ringkasan Minggu Ini</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 border rounded">
                                    <i class="bi bi-calendar-check fs-1" style="color: #10b981;"></i>
                                    <h3 class="mt-2 mb-0">{{ $report->total_kehadiran }}</h3>
                                    <small class="text-muted">Total Kehadiran</small>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 border rounded">
                                    <i class="bi bi-controller fs-1" style="color: #3b82f6;"></i>
                                    <h3 class="mt-2 mb-0">{{ $report->total_game_dimainkan }}</h3>
                                    <small class="text-muted">Game Dimainkan</small>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 border rounded">
                                    <i class="bi bi-trophy fs-1" style="color: #f59e0b;"></i>
                                    <h3 class="mt-2 mb-0">{{ number_format($report->rata_rata_skor, 1) }}</h3>
                                    <small class="text-muted">Rata-rata Skor</small>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 border rounded">
                                    <i class="bi bi-star-fill fs-1" style="color: #8b5cf6;"></i>
                                    <h3 class="mt-2 mb-0">{{ $report->skor_tertinggi ?? '-' }}</h3>
                                    <small class="text-muted">Skor Tertinggi</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="bi bi-chat-left-text"></i> Catatan Guru</h5>
                    </div>
                    <div class="card-body">
                        @if($report->catatan_guru)
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                <strong>Catatan:</strong>
                                <p class="mb-0 mt-2">{{ $report->catatan_guru }}</p>
                            </div>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="bi bi-chat-left-text fs-1"></i>
                                <p class="mt-2">Belum ada catatan dari guru</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="bi bi-lightbulb"></i> Rekomendasi</h5>
                    </div>
                    <div class="card-body">
                        @if($report->rekomendasi)
                            <div class="alert alert-warning">
                                <i class="bi bi-lightbulb-fill"></i>
                                <strong>Rekomendasi:</strong>
                                <p class="mb-0 mt-2">{{ $report->rekomendasi }}</p>
                            </div>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="bi bi-lightbulb fs-1"></i>
                                <p class="mt-2">Belum ada rekomendasi</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-file-earmark-x fs-1 text-muted"></i>
                        <h4 class="mt-3">Laporan Belum Tersedia</h4>
                        <p class="text-muted">Laporan mingguan untuk minggu ini belum dibuat oleh guru.</p>
                        <a href="{{ route('orangtua.students.show', $student) }}" class="btn btn-primary mt-3">
                            <i class="bi bi-arrow-left"></i> Kembali ke Detail Siswa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('styles')
<style>
    .nav-link.active {
        background-color: #10b981;
        color: white !important;
        border-radius: 5px;
    }
</style>
@endpush
