<?php
namespace App\Helpers;

use App\Models\TahunAkademik;
use Illuminate\Database\Capsule\Manager as DB;

class AppHelper {
    
    // Mendapatkan Tahun Akademik Aktif Berdasarkan Tanggal Hari Ini
    public static function getTahunAkademikSaatIni() {
        $today = date('Y-m-d');
        
        // Cari di DB yang rentang tanggalnya mencakup hari ini
        $active = TahunAkademik::where('tanggal_mulai', '<=', $today)
                    ->where('tanggal_selesai', '>=', $today)
                    ->first();
        
        // Fallback logic jika DB kosong/belum update:
        if (!$active) {
            $month = date('n');
            $year = date('Y');
            
            // Logika Umum: Ganjil (Agu-Jan), Genap (Feb-Jul)
            if ($month >= 8 || $month <= 1) {
                // Semester Ganjil
                $kode = ($month >= 8) ? $year . '1' : ($year - 1) . '1';
                $nama = ($month >= 8) ? "$year/".($year+1)." Ganjil" : ($year-1)."/$year Ganjil";
            } else {
                // Semester Genap
                $kode = ($year - 1) . '2';
                $nama = ($year-1)."/$year Genap";
            }
            
            return (object) ['kode' => $kode, 'nama' => $nama];
        }
        
        return $active;
    }

    // Menghitung Semester Mahasiswa Secara Real-time
    public static function hitungSemesterMahasiswa($angkatan) {
        $ta = self::getTahunAkademikSaatIni();
        $tahunSekarang = substr($ta->kode, 0, 4); // Ambil 4 digit tahun (misal 2024 dari 20241)
        $semesterTipe = substr($ta->kode, 4, 1); // 1 = Ganjil, 2 = Genap
        
        $selisihTahun = $tahunSekarang - $angkatan;
        $semester = ($selisihTahun * 2) + ($semesterTipe == '1' ? 1 : 2);
        
        return max(1, $semester); // Minimal semester 1
    }
}