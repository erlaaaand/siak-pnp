<?php
// app/Models/Dosen.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model {
    protected $table = 'dosens';
    protected $primaryKey = 'nidn';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['nidn', 'nama', 'jenis_kelamin', 'jurusan_id', 'foto'];

    public function jurusan() {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    public function jadwalKelas() {
        return $this->hasMany(JadwalKelas::class, 'dosen_id', 'nidn');
    }
}