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
        header("Location: index.php?page=dashboard");
        exit;
    }

    public function updateDosen() {
        try {
            $nidn = $_POST['nidn'];
            $dosen = Dosen::where('nidn', $nidn)->first();
            
            if (!$dosen) {
                $_SESSION['error'] = 'Dosen tidak ditemukan!';
                header("Location: index.php?page=dashboard");
                exit;
            }

            $dosen->nama = $_POST['nama'];
            $dosen->jenis_kelamin = $_POST['jenis_kelamin'];
            $dosen->jurusan_id = $_POST['jurusan_id'];
            $dosen->save();

            $_SESSION['success'] = 'Data dosen berhasil diupdate!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Gagal mengupdate dosen: ' . $e->getMessage();
        }
        header("Location: index.php?page=dashboard");
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
        header("Location: index.php?page=dashboard");
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
        header("Location: index.php?page=dashboard");
        exit;
    }

    public function updateMahasiswa() {
        try {
            $nim = $_POST['nim'];
            $mahasiswa = Mahasiswa::where('nim', $nim)->first();
            
            if (!$mahasiswa) {
                $_SESSION['error'] = 'Mahasiswa tidak ditemukan!';
                header("Location: index.php?page=dashboard");
                exit;
            }

            $mahasiswa->nama = $_POST['nama'];
            $mahasiswa->jenis_kelamin = $_POST['jenis_kelamin'];
            $mahasiswa->angkatan = $_POST['angkatan'];
            $mahasiswa->kelas_profil = $_POST['kelas'];
            $mahasiswa->prodi_id = $_POST['prodi_id'];
            $mahasiswa->save();

            $_SESSION['success'] = 'Data mahasiswa berhasil diupdate!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Gagal mengupdate mahasiswa: ' . $e->getMessage();
        }
        header("Location: index.php?page=dashboard");
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
        header("Location: index.php?page=dashboard");
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
        header("Location: index.php?page=dashboard");
        exit;
    }

    public function updateMatakuliah() {
        try {
            $id = $_POST['id'];
            $matakuliah = Matakuliah::find($id);
            
            if (!$matakuliah) {
                $_SESSION['error'] = 'Matakuliah tidak ditemukan!';
                header("Location: index.php?page=dashboard");
                exit;
            }

            $matakuliah->kode_mk = $_POST['kode_mk'];
            $matakuliah->nama_mk = $_POST['nama_mk'];
            $matakuliah->sks = $_POST['sks'];
            $matakuliah->semester_paket = $_POST['semester_paket'] ?? null;
            $matakuliah->prodi_id = $_POST['prodi_id'];
            $matakuliah->save();

            $_SESSION['success'] = 'Data matakuliah berhasil diupdate!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Gagal mengupdate matakuliah: ' . $e->getMessage();
        }
        header("Location: index.php?page=dashboard");
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
        header("Location: index.php?page=dashboard");
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
        header("Location: index.php?page=dashboard");
        exit;
    }

    public function updateRuangan() {
        try {
            $id = $_POST['id'];
            $ruangan = Ruangan::find($id);
            
            if (!$ruangan) {
                $_SESSION['error'] = 'Ruangan tidak ditemukan!';
                header("Location: index.php?page=dashboard");
                exit;
            }

            $ruangan->kode_ruang = $_POST['kode_ruang'];
            $ruangan->nama_ruang = $_POST['nama_ruang'];
            $ruangan->kapasitas = $_POST['kapasitas'];
            $ruangan->save();

            $_SESSION['success'] = 'Data ruangan berhasil diupdate!';
        } catch (\Exception $e) {
            $_SESSION['error'] = 'Gagal mengupdate ruangan: ' . $e->getMessage();
        }
        header("Location: index.php?page=dashboard");
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
        header("Location: index.php?page=dashboard");
        exit;
    }
}