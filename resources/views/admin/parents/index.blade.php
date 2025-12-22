@extends('layouts.app')

@section('title', 'Kelola Orang Tua')

@section('sidebar')
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="bi bi-people"></i> Kelola Guru
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.parents.index') }}">
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
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h2>Kelola Orang Tua</h2>
        <a href="{{ route('admin.parents.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Orang Tua
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($parents as $index => $parent)
                            <tr>
                                <td>{{ $parents->firstItem() + $index }}</td>
                                <td>{{ $parent->username }}</td>
                                <td>{{ $parent->nama_lengkap }}</td>
                                <td>{{ $parent->email }}</td>
                                <td>{{ $parent->no_telepon ?? '-' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.parents.edit', $parent) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.parents.destroy', $parent) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus orang tua ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data orang tua</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $parents->links() }}
            </div>
        </div>
    </div>
@endsection
