@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('sidebar')
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="bi bi-people"></i> Kelola Guru
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.parents.index') }}">
                <i class="bi bi-people-fill"></i> Kelola Orang Tua
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.students.index') }}">
                <i class="bi bi-person-badge"></i> Kelola Siswa
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.schedules.index') }}">
                <i class="bi bi-calendar-week"></i> Kelola Jadwal
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <h2 class="mt-4">Dashboard Admin</h2>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <div class="card-body">
                    <h5>Total Guru</h5>
                    <h2>{{ $totalGuru }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                <div class="card-body">
                    <h5>Total Orang Tua</h5>
                    <h2>{{ $totalOrangTua }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                <div class="card-body">
                    <h5>Total Siswa</h5>
                    <h2>{{ $totalSiswa }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <div class="card-body">
                    <h5>Total Game</h5>
                    <h2>{{ $totalGame }}</h2>
                </div>
            </div>
        </div>
    </div>
@endsection