<?php
namespace App\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;

class AdminController {

    // --- DOSEN CRUD ---
    public function storeDosen() {
        try {
            Dosen::create([
                'nidn' => $_POST['nidn'],
                'nama' => $_POST['nama'],
                'jenis_kelamin' => $_POST['jenis_kelamin'],
                // Set default atau ambil dari form jika ada
                'jurusan_id' => 1 
            ]);
            header("Location: index.php?page=dashboard&mode=admin&msg=success");
        } catch (\Exception $e) {
            die("Gagal simpan: " . $e->getMessage());
        }
    }

    public function deleteDosen() {
        $nidn = $_GET['id'];
        Dosen::where('nidn', $nidn)->delete();
        header("Location: index.php?page=dashboard&mode=admin&msg=deleted");
    }

    // --- MAHASISWA CRUD ---
    public function storeMahasiswa() {
        try {
            Mahasiswa::create([
                'nim' => $_POST['nim'],
                'nama' => $_POST['nama'],
                'angkatan' => $_POST['angkatan'],
                'kelas_profil' => $_POST['kelas'],
                'prodi_id' => 1, // Default TRPL
                'semester_aktif' => 1
            ]);
            header("Location: index.php?page=dashboard&mode=admin&msg=success");
        } catch (\Exception $e) {
            die("Gagal simpan: " . $e->getMessage());
        }
    }

    public function deleteMahasiswa() {
        $nim = $_GET['id'];
        Mahasiswa::where('nim', $nim)->delete();
        header("Location: index.php?page=dashboard&mode=admin&msg=deleted");
    }

    // --- MATAKULIAH CRUD ---
    public function storeMatakuliah() {
        Matakuliah::create($_POST);
        header("Location: index.php?page=dashboard&mode=admin");
    }
}