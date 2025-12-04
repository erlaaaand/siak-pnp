<?php
// app/Models/JadwalKelas.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class JadwalKelas extends Model {
    protected $table = 'jadwal_kelas';
    protected $fillable = [
        'tahun_akademik_id', 'matakuliah_id', 'dosen_id', 
        'ruangan_id', 'nama_kelas', 'hari', 'jam_mulai', 
        'jam_selesai', 'kuota'
    ];

    public function tahunAkademik() {
        return $this->belongsTo(TahunAkademik::class, 'tahun_akademik_id');
    }

    public function matakuliah() {
        return $this->belongsTo(Matakuliah::class, 'matakuliah_id');
    }

    public function dosen() {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'nidn');
    }

    public function ruangan() {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function krs() {
        return $this->hasMany(Krs::class, 'jadwal_kelas_id');
    }
}