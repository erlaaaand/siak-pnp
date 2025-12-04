<?php
// app/Models/Matakuliah.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model {
    protected $table = 'matakuliahs';
    protected $fillable = ['kode_mk', 'nama_mk', 'sks', 'semester_paket', 'prodi_id'];

    public function prodi() {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function jadwalKelas() {
        return $this->hasMany(JadwalKelas::class, 'matakuliah_id');
    }
}