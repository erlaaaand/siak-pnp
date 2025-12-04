<?php
// app/Models/Prodi.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model {
    protected $table = 'program_studis';
    protected $fillable = ['jurusan_id', 'kode', 'nama', 'jenjang'];

    public function jurusan() {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    public function mahasiswas() {
        return $this->hasMany(Mahasiswa::class, 'prodi_id');
    }

    public function matakuliahs() {
        return $this->hasMany(Matakuliah::class, 'prodi_id');
    }
}