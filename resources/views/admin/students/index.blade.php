@extends('layouts.app')

@section('title', 'Kelola Siswa')

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
            <a class="nav-link" href="{{ route('admin.parents.index') }}">
                <i class="bi bi-people-fill"></i> Kelola Orang Tua
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.students.index') }}">
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
        <h2>Kelola Siswa</h2>
        <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Siswa
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Kelas</th>
                            <th>Orang Tua</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $index => $student)
                            <tr>
                                <td>{{ $students->firstItem() + $index }}</td>
                                <td>{{ $student->nama_lengkap }}</td>
                                <td>{{ \Carbon\Carbon::parse($student->tanggal_lahir)->format('d/m/Y') }}</td>
                                <td>{{ $student->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $student->kelas ?? '-' }}</td>
                                <td>{{ $student->parent->nama_lengkap ?? '-' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
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
                                <td colspan="7" class="text-center">Belum ada data siswa</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $students->links() }}
            </div>
        </div>
    </div>
@endsection
