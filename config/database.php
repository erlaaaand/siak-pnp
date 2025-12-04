<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'database'  => 'db_siak',
    'username'  => 'siak_user',  // Ganti 'root' jadi ini
    'password'  => 'password123', // Masukkan password yang kamu buat
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Bagian PENTING yang menyebabkan error kamu:
$capsule->setAsGlobal(); 
$capsule->bootEloquent();