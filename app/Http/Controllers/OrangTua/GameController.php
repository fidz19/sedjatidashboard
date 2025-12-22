<?php

namespace App\Http\Controllers\OrangTua;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Student;
use App\Models\GameScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function play(Student $student, Game $game)
    {
        if ($student->parent_id !== Auth::id()) {
            abort(403);
        }

        if (!$game->assignedStudents->contains($student->id)) {
            abort(403, 'Game tidak ditugaskan untuk siswa ini');
        }

        return view('orangtua.games.play', compact('student', 'game'));
    }

    public function submit(Request $request, Student $student, Game $game)
    {
        if ($student->parent_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'jawaban' => 'required|array',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date'
        ]);

        $kontenGame = $game->konten_game;
        $jawabanBenar = 0;
        $jawabanSalah = 0;
        $detailJawaban = [];

        foreach ($validated['jawaban'] as $index => $jawaban) {
            $soal = $kontenGame[$index] ?? null;
            if ($soal) {
                $isBenar = $this->checkAnswer($soal, $jawaban, $game->template->tipe_game);
                if ($isBenar) {
                    $jawabanBenar++;
                } else {
                    $jawabanSalah++;
                }

                $detailJawaban[] = [
                    'soal_index' => $index,
                    'jawaban' => $jawaban,
                    'benar' => $isBenar
                ];
            }
        }

        $skor = round(($jawabanBenar / count($kontenGame)) * 100, 2);
        $waktuMulai = \Carbon\Carbon::parse($validated['waktu_mulai']);
        $waktuSelesai = \Carbon\Carbon::parse($validated['waktu_selesai']);
        $durasi = $waktuSelesai->diffInSeconds($waktuMulai);

        GameScore::create([
            'game_id' => $game->id,
            'student_id' => $student->id,
            'skor' => $skor,
            'total_soal' => count($kontenGame),
            'benar' => $jawabanBenar,
            'salah' => $jawabanSalah,
            'detail_jawaban' => $detailJawaban,
            'waktu_mulai' => $waktuMulai,
            'waktu_selesai' => $waktuSelesai,
            'durasi_detik' => $durasi
        ]);

        return redirect()->route('orangtua.students.show', $student)
            ->with('success', 'Game selesai! Skor: ' . $skor);
    }

    private function checkAnswer($soal, $jawaban, $tipeGame)
    {
        switch ($tipeGame) {
            case 'mencocokkan_kata':
                return strtolower(trim($soal['jawaban'])) === strtolower(trim($jawaban));
            
            case 'tts_alat_tulis':
                return strtolower(trim($soal['jawaban'])) === strtolower(trim($jawaban));
            
            case 'hitung_hijaiyah':
                return intval($soal['jawaban']) === intval($jawaban);
            
            case 'kata_tersembunyi':
                return strtolower(trim($soal['jawaban'])) === strtolower(trim($jawaban));
            
            default:
                return false;
        }
    }
}