<?php
namespace App\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\JadwalKelas;
use App\Models\Ruangan;

class AdminController {

    // === DASHBOARD ADMIN ===
    public function index() {
        // Ambil semua data master
        $dosens = Dosen::with('jurusan')->get();
        $mahasiswas = Mahasiswa::with('prodi')->get();
        $matakuliahs = Matakuliah::with('prodi')->get();
        $jadwals = JadwalKelas::with(['matakuliah', 'dosen', 'ruangan', 'tahunAkademik'])->get();
        $ruangans = Ruangan::all();

        require '../views/admin/dashboard.php';
    }

    // === DOSEN CRUD ===
    public function storeDosen() {
        try {
            Dosen::create([
                'nidn' => $_POST['nidn'],
                'nama' => $_POST['nama'],
                'jenis_kelamin' => $_POST['jenis_kelamin'],
                'jurusan_id' => $_POST['jurusan_id'] ?? 1
            ]);
            $_SESSION['success'] = 'Dosen berhasil ditambahkan!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Gagal menambahkan dosen: ' . $e->getMessage();
        }
        header("Location: index.php?page=admin");
        exit;
    }

    public function deleteDosen() {
        try {
            $nidn = $_GET['id'];
            Dosen::where('nidn', $nidn)->delete();
            $_SESSION['success'] = 'Dosen berhasil dihapus!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Gagal menghapus dosen: ' . $e->getMessage();
        }
        header("Location: index.php?page=admin");
        exit;
    }

    // === MAHASISWA CRUD ===
    public function storeMahasiswa() {
        try {
            Mahasiswa::create([
                'nim' => $_POST['nim'],
                'nama' => $_POST['nama'],
                'jenis_kelamin' => $_POST['jenis_kelamin'] ?? 'L',
                'angkatan' => $_POST['angkatan'],
                'kelas_profil' => $_POST['kelas'],
                'prodi_id' => $_POST['prodi_id'] ?? 1,
                'semester_aktif' => 1
            ]);
            $_SESSION['success'] = 'Mahasiswa berhasil ditambahkan!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Gagal menambahkan mahasiswa: ' . $e->getMessage();
        }
        header("Location: index.php?page=admin");
        exit;
    }

    public function deleteMahasiswa() {
        try {
            $nim = $_GET['id'];
            Mahasiswa::where('nim', $nim)->delete();
            $_SESSION['success'] = 'Mahasiswa berhasil dihapus!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Gagal menghapus mahasiswa: ' . $e->getMessage();
        }
        header("Location: index.php?page=admin");
        exit;
    }

    // === MATAKULIAH CRUD ===
    public function storeMatakuliah() {
        try {
            Matakuliah::create([
                'kode_mk' => $_POST['kode_mk'],
                'nama_mk' => $_POST['nama_mk'],
                'sks' => $_POST['sks'],
                'semester_paket' => $_POST['semester_paket'] ?? null,
                'prodi_id' => $_POST['prodi_id'] ?? 1
            ]);
            $_SESSION['success'] = 'Matakuliah berhasil ditambahkan!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Gagal menambahkan matakuliah: ' . $e->getMessage();
        }
        header("Location: index.php?page=admin");
        exit;
    }

    public function deleteMatakuliah() {
        try {
            $id = $_GET['id'];
            Matakuliah::destroy($id);
            $_SESSION['success'] = 'Matakuliah berhasil dihapus!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Gagal menghapus matakuliah: ' . $e->getMessage();
        }
        header("Location: index.php?page=admin");
        exit;
    }

    // === RUANGAN CRUD ===
    public function storeRuangan() {
        try {
            Ruangan::create([
                'kode_ruang' => $_POST['kode_ruang'],
                'nama_ruang' => $_POST['nama_ruang'],
                'kapasitas' => $_POST['kapasitas'] ?? 40
            ]);
            $_SESSION['success'] = 'Ruangan berhasil ditambahkan!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Gagal menambahkan ruangan: ' . $e->getMessage();
        }
        header("Location: index.php?page=admin");
        exit;
    }

    public function deleteRuangan() {
        try {
            $id = $_GET['id'];
            Ruangan::destroy($id);
            $_SESSION['success'] = 'Ruangan berhasil dihapus!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Gagal menghapus ruangan: ' . $e->getMessage();
        }
        header("Location: index.php?page=admin");
        exit;
    }
}