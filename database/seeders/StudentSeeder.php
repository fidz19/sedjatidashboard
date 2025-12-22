<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $orangTua1 = User::where('username', 'orangtua1')->first();
        $orangTua2 = User::where('username', 'orangtua2')->first();

        // Siswa untuk orang tua 1
        Student::create([
            'parent_id' => $orangTua1->id,
            'nama_lengkap' => 'Andi Pratama',
            'tanggal_lahir' => '2012-05-15',
            'jenis_kelamin' => 'L',
            'kelas' => 'SD Kelas 5',
            'alamat' => 'Jl. Merdeka No. 123, Jakarta'
        ]);

        Student::create([
            'parent_id' => $orangTua1->id,
            'nama_lengkap' => 'Dina Maharani',
            'tanggal_lahir' => '2014-08-20',
            'jenis_kelamin' => 'P',
            'kelas' => 'SD Kelas 3',
            'alamat' => 'Jl. Merdeka No. 123, Jakarta'
        ]);

        // Siswa untuk orang tua 2
        Student::create([
            'parent_id' => $orangTua2->id,
            'nama_lengkap' => 'Rizky Firmansyah',
            'tanggal_lahir' => '2013-03-10',
            'jenis_kelamin' => 'L',
            'kelas' => 'SD Kelas 4',
            'alamat' => 'Jl. Sudirman No. 456, Jakarta'
        ]);
    }
}