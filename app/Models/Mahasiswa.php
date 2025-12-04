<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mahasiswa extends Model {
    use SoftDeletes;
    
    protected $table = 'mahasiswas';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'nim', 'user_id', 'nama', 'tempat_lahir', 
        'tanggal_lahir', 'jenis_kelamin', 'prodi_id', 
        'angkatan', 'foto'
    ];

    protected $dates = ['tanggal_lahir', 'deleted_at'];

    // Relasi balik ke User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Prodi
    public function prodi() {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    // Relasi ke KRS
    public function krs() {
        return $this->hasMany(Krs::class, 'nim', 'nim');
    }

    // Helper method untuk mendapatkan nama lengkap dengan NIM
    public function getFullIdentityAttribute() {
        return $this->nim . ' - ' . $this->nama;
    }
}