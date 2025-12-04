<?php

// app/Controllers/NilaiController.php
namespace App\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;

class NilaiController {
    
    public function index() {
        $nim = $_SESSION['nim'];
        
        // Ambil semua KRS beserta nilainya
        $nilaiList = Krs::with(['jadwal_kelas.matakuliah', 'jadwal_kelas.tahunAkademik'])
                       ->where('nim', $nim)
                       ->orderBy('created_at', 'desc')
                       ->get();

        // Hitung IPK
        $totalBobot = 0;
        $totalSks = 0;
        
        foreach ($nilaiList as $krs) {
            if ($krs->nilai_angka > 0) {
                $sks = $krs->jadwal_kelas->matakuliah->sks;
                $totalBobot += $this->hitungBobot($krs->nilai_angka) * $sks;
                $totalSks += $sks;
            }
        }
        
        $ipk = $totalSks > 0 ? round($totalBobot / $totalSks, 2) : 0;

        require '../views/nilai/index.php';
    }

    private function hitungBobot($nilaiAngka) {
        if ($nilaiAngka >= 85) return 4.00;
        if ($nilaiAngka >= 80) return 3.67;
        if ($nilaiAngka >= 75) return 3.33;
        if ($nilaiAngka >= 70) return 3.00;
        if ($nilaiAngka >= 65) return 2.67;
        if ($nilaiAngka >= 60) return 2.33;
        if ($nilaiAngka >= 55) return 2.00;
        if ($nilaiAngka >= 50) return 1.67;
        if ($nilaiAngka >= 40) return 1.00;
        return 0;
    }

    private function getNilaiHuruf($nilaiAngka) {
        if ($nilaiAngka >= 85) return 'A';
        if ($nilaiAngka >= 80) return 'A-';
        if ($nilaiAngka >= 75) return 'B+';
        if ($nilaiAngka >= 70) return 'B';
        if ($nilaiAngka >= 65) return 'B-';
        if ($nilaiAngka >= 60) return 'C+';
        if ($nilaiAngka >= 55) return 'C';
        if ($nilaiAngka >= 50) return 'C-';
        if ($nilaiAngka >= 40) return 'D';
        return 'E';
    }
}