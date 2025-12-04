<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model {
    protected $table = 'mahasiswas';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $fillable = ['nim', 'user_id', 'nama', 'prodi_id', 'angkatan'];

    // Relasi balik ke User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}