@extends('layouts.app')

@section('title', 'Kelola Jadwal')

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
            <a class="nav-link" href="{{ route('admin.students.index') }}">
                <i class="bi bi-person-badge"></i> Kelola Siswa
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('admin.schedules.index') }}">
                <i class="bi bi-calendar-week"></i> Kelola Jadwal
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <h2>Kelola Jadwal</h2>
        <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Jadwal
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Mata Pelajaran</th>
                            <th>Siswa</th>
                            <th>Guru</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schedules as $index => $schedule)
                            <tr>
                                <td>{{ $schedules->firstItem() + $index }}</td>
                                <td>{{ $schedule->hari }}</td>
                                <td>{{ $schedule->jam_mulai->format('H:i') }} - {{ $schedule->jam_selesai->format('H:i') }}</td>
                                <td>{{ $schedule->mata_pelajaran }}</td>
                                <td>{{ $schedule->student->nama_lengkap }}</td>
                                <td>{{ $schedule->teacher->nama_lengkap }}</td>
                                <td>
                                    @if($schedule->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.schedules.edit', $schedule) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
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
                                <td colspan="8" class="text-center">Belum ada data jadwal</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $schedules->links() }}
            </div>
        </div>
    </div>
@endsection
