<?php
namespace App\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Matakuliah;
use App\Models\JadwalKelas;
use App\Models\Ruangan;
use App\Models\Krs;

class DashboardController {
    public function index() {
        $nim = $_SESSION['nim'];
        $viewMode = $_SESSION['view_mode'] ?? 'student';

        if ($viewMode === 'admin') {
            $this->adminView();
        } else {
            $this->studentView($nim);
        }
    }

    private function studentView($nim) {
        // Dashboard Mahasiswa (View Mode)
        $mahasiswa = Mahasiswa::with(['prodi.jurusan'])->find($nim);

        // Statistik
        $totalKRS = Krs::where('nim', $nim)->count();
        $totalSKS = Krs::where('nim', $nim)
            ->join('jadwal_kelas', 'krs.jadwal_kelas_id', '=', 'jadwal_kelas.id')
            ->join('matakuliahs', 'jadwal_kelas.matakuliah_id', '=', 'matakuliahs.id')
            ->sum('matakuliahs.sks');

        $nilaiDiinput = Krs::where('nim', $nim)
            ->where('nilai_angka', '>', 0)
            ->count();

        $avgNilai = Krs::where('nim', $nim)
            ->where('nilai_angka', '>', 0)
            ->avg('nilai_angka');

        $ipk = $avgNilai ? number_format($avgNilai / 25, 2) : '0.00';

        require '../views/dashboard/student.php';
    }

    private function adminView() {
        // Dashboard Admin (CRUD Mode)
        $dosens = Dosen::with('jurusan')->get();
        $mahasiswas = Mahasiswa::with('prodi')->get();
        $matakuliahs = Matakuliah::with('prodi')->get();
        $jadwals = JadwalKelas::with(['matakuliah', 'dosen', 'ruangan', 'tahunAkademik'])->get();
        $ruangans = Ruangan::all();

        require '../views/dashboard/admin.php';
    }
}