<?php
// app/Models/TahunAkademik.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model {
    protected $table = 'tahun_akademiks';
    protected $fillable = ['kode', 'tahun', 'semester', 'is_aktif'];

    public function jadwalKelas() {
        return $this->hasMany(JadwalKelas::class, 'tahun_akademik_id');
    }

    public static function getAktif() {
        return self::where('is_aktif', 1)->first();
    }
}