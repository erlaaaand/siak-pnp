<?php
namespace App\Controllers;

use App\Models\Mahasiswa;

class DashboardController {
    public function index() {
        // Ambil data mahasiswa berdasarkan NIM di session
        // Include relasi ke Prodi dan Jurusan (nested relationship)
        $mahasiswa = Mahasiswa::with(['prodi.jurusan'])->find($_SESSION['nim']);

        // Kirim data ke View
        require '../views/dashboard/index.php';
    }
}