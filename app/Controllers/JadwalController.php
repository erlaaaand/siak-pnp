<?php
// app/Controllers/JadwalController.php
namespace App\Controllers;

use App\Models\Krs;

class JadwalController {
    
    public function index() {
        $nim = $_SESSION['nim'];
        
        // Ambil jadwal berdasarkan KRS yang sudah diambil
        $jadwalKuliah = Krs::with(['jadwal_kelas.matakuliah', 'jadwal_kelas.dosen', 'jadwal_kelas.ruangan'])
                          ->where('nim', $nim)
                          ->get()
                          ->map(function($item) {
                              return $item->jadwal_kelas;
                          })
                          ->sortBy(function($jadwal) {
                              $hariOrder = ['Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4, 'Jumat' => 5, 'Sabtu' => 6];
                              return ($hariOrder[$jadwal->hari] ?? 7) . $jadwal->jam_mulai;
                          });

        require '../views/jadwal/index.php';
    }
}