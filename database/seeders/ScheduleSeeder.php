<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\User;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        $guru1 = User::where('username', 'guru1')->first();
        $guru2 = User::where('username', 'guru2')->first();
        $students = Student::all();

        foreach ($students as $student) {
            Schedule::create([
                'student_id' => $student->id,
                'teacher_id' => $guru1->id,
                'mata_pelajaran' => 'Bahasa Inggris',
                'hari' => 'Senin',
                'jam_mulai' => '15:00:00',
                'jam_selesai' => '16:30:00',
                'is_active' => true
            ]);

            Schedule::create([
                'student_id' => $student->id,
                'teacher_id' => $guru2->id,
                'mata_pelajaran' => 'Bahasa Arab',
                'hari' => 'Rabu',
                'jam_mulai' => '16:00:00',
                'jam_selesai' => '17:30:00',
                'is_active' => true
            ]);

            Schedule::create([
                'student_id' => $student->id,
                'teacher_id' => $guru1->id,
                'mata_pelajaran' => 'Matematika',
                'hari' => 'Jumat',
                'jam_mulai' => '15:00:00',
                'jam_selesai' => '16:30:00',
                'is_active' => true
            ]);
        }
    }
}