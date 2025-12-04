<?php
// app/Models/Ruangan.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model {
    protected $table = 'ruangans';
    protected $fillable = ['kode_ruang', 'nama_ruang', 'kapasitas'];

    public function jadwalKelas() {
        return $this->hasMany(JadwalKelas::class, 'ruangan_id');
    }
}