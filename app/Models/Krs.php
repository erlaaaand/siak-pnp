<?php
// app/Models/Krs.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model {
    protected $table = 'krs';
    protected $fillable = [
        'nim', 'jadwal_kelas_id', 'nilai_angka', 
        'nilai_huruf', 'bobot', 'is_disetujui'
    ];

    public function mahasiswa() {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function jadwal_kelas() {
        return $this->belongsTo(JadwalKelas::class, 'jadwal_kelas_id');
    }
}