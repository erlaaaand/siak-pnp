<?php
namespace App\Controllers;

use App\Models\Krs;
use App\Models\JadwalKelas;
use App\Models\Mahasiswa;
use Illuminate\Database\Capsule\Manager as DB;

class KrsController {
    
    // 1. Tampilkan KRS Saya
    public function index() {
        $nim = $_SESSION['nim'];
        
        // Ambil data KRS beserta detail Matakuliah, Dosen, dan Jadwalnya
        $krsSaya = Krs::with(['jadwal_kelas.matakuliah', 'jadwal_kelas.dosen', 'jadwal_kelas.ruangan'])
                      ->where('nim', $nim)
                      ->get();

        require '../views/krs/index.php';
    }

    // 2. Tampilkan Form Tambah Kelas (Lihat Jadwal Tersedia)
    public function tambah() {
        // Ambil semua jadwal kelas yang tersedia
        $jadwalTersedia = JadwalKelas::with(['matakuliah', 'dosen', 'ruangan'])->get();
        
        require '../views/krs/tambah.php';
    }

    // 3. Proses Simpan KRS
    public function store() {
        $nim = $_SESSION['nim'];
        $jadwalId = $_POST['jadwal_id'];

        // Cek Duplikasi: Apakah sudah ambil kelas ini?
        $cek = Krs::where('nim', $nim)->where('jadwal_kelas_id', $jadwalId)->first();
        if ($cek) {
            echo "<script>alert('Anda sudah mengambil matakuliah ini!'); window.location='index.php?page=krs&action=tambah';</script>";
            return;
        }

        // Simpan
        try {
            Krs::create([
                'nim' => $nim,
                'jadwal_kelas_id' => $jadwalId
            ]);
            header("Location: index.php?page=krs");
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // 4. Hapus KRS
    public function hapus() {
        $id = $_GET['id'];
        Krs::destroy($id); // Hapus berdasarkan Primary Key tabel KRS
        header("Location: index.php?page=krs");
    }
}