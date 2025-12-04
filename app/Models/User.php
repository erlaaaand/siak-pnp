<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'users';
    protected $fillable = ['nama_lengkap', 'password'];

    // Relasi ke Data Mahasiswa
    public function mahasiswa() {
        return $this->hasOne(Mahasiswa::class, 'user_id');
    }
}