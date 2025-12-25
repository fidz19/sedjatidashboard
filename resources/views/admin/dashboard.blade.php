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
    <div class="row mt-4 g-4">
        <div class="col-md-3">
            <div class="card card-premium bg-gradient-emerald h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5>Total Guru</h5>
                            <h2>{{ $totalGuru }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-2">
                            <i class="bi bi-person-workspace fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-premium bg-gradient-blue h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5>Total Orang Tua</h5>
                            <h2>{{ $totalOrangTua }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-2">
                            <i class="bi bi-people-fill fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-premium bg-gradient-purple h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5>Total Siswa</h5>
                            <h2>{{ $totalSiswa }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-2">
                            <i class="bi bi-mortarboard-fill fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-premium bg-gradient-orange h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5>Total Game</h5>
                            <h2>{{ $totalGame }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-2">
                            <i class="bi bi-controller fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection