<?php
// app/Models/Jurusan.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model {
    protected $table = 'jurusans';
    protected $fillable = ['kode', 'nama'];

    public function prodis() {
        return $this->hasMany(Prodi::class, 'jurusan_id');
    }

    public function dosens() {
        return $this->hasMany(Dosen::class, 'jurusan_id');
    }
}