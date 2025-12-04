<?php
namespace App\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Matakuliah;
use App\Models\JadwalKelas;
use App\Models\Krs;
use App\Helpers\AppHelper;

class MainController {

    // --- VIEW: DASHBOARD (Dual Mode) ---
    public function index() {
        // Mode view: 'admin' atau 'student' (Default admin karena superuser)
        $mode = $_GET['mode'] ?? 'admin'; 
        
        // Data Global Real-time
        $taSaatIni = AppHelper::getTahunAkademikSaatIni();
        
        if ($mode == 'student') {
            $this->renderStudentDashboard($taSaatIni);
        } else {
            $this->renderAdminDashboard($taSaatIni);
        }
    }

    // --- LOGIC: ADMIN (CRUD Master Data) ---
    private function renderAdminDashboard($ta) {
        // Ambil Data Master untuk CRUD
        $data = [
            'mahasiswas' => Mahasiswa::with('prodi')->get(),
            'dosens' => Dosen::all(),
            'matakuliahs' => Matakuliah::all(),
            'jadwals' => JadwalKelas::with(['matakuliah', 'dosen', 'ruangan'])->get(),
            'ta' => $ta
        ];
        require '../views/admin/dashboard.php';
    }

    // --- LOGIC: STUDENT (Pra/Per/Pasca Kuliah) ---
    private function renderStudentDashboard($ta) {
        // Hardcode ID Mahasiswa (Simulasi Login User Tunggal)
        // Kita ambil salah satu mahasiswa sebagai "Saya"
        $me = Mahasiswa::with('prodi')->first(); 
        
        if (!$me) {
            echo "Belum ada data mahasiswa. Silakan masuk mode Admin dan buat data dulu.";
            return;
        }

        $semesterSaya = AppHelper::hitungSemesterMahasiswa($me->angkatan);

        // 1. PRA-KULIAH: Data Teman Sekelas & Dosen
        $temanSekelas = Mahasiswa::where('kelas_profil', $me->kelas_profil)->get();
        $dosenKelas = JadwalKelas::with('dosen')->where('nama_kelas', $me->kelas_profil)->get()->pluck('dosen')->unique('nidn');

        // 2. PERKULIAHAN: KRS & Transkrip
        $krsSaya = Krs::with(['jadwal_kelas.matakuliah', 'jadwal_kelas.dosen'])
                    ->where('nim', $me->nim)
                    ->get();
        
        // Hitung IPK Realtime
        $totalSks = 0;
        $totalBobot = 0;
        foreach($krsSaya as $k) {
            if($k->nilai_angka > 0) {
                $sks = $k->jadwal_kelas->matakuliah->sks;
                $totalSks += $sks;
                $totalBobot += ($k->bobot * $sks);
            }
        }
        $ipk = $totalSks > 0 ? round($totalBobot / $totalSks, 2) : 0;

        // 3. PASCA-KULIAH: Rapor (Ambil data KHS semester ini)
        // (Logic disederhanakan: ambil dari KRS yang sudah ada nilai)

        require '../views/student/dashboard.php';
    }

    // --- GENERIC CRUD HANDLER (Contoh: Simpan Dosen) ---
    public function storeDosen() {
        Dosen::create($_POST);
        header('Location: index.php?mode=admin&tab=dosen');
    }
    
    // ... (Tambahkan function storeMahasiswa, storeMK, delete, dll disini) ...
}