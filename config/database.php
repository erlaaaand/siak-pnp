<?php
/**
 * Database Configuration
 * Using Eloquent ORM via Capsule
 */

use Illuminate\Database\Capsule\Manager as Capsule;

// Load environment variables if .env exists
if (file_exists(__DIR__ . '/../.env')) {
    $env = parse_ini_file(__DIR__ . '/../.env');
    foreach ($env as $key => $value) {
        $_ENV[$key] = $value;
    }
}

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $_ENV['DB_HOST'] ?? '127.0.0.1',
    'database'  => $_ENV['DB_DATABASE'] ?? 'db_siak',
    'username'  => $_ENV['DB_USERNAME'] ?? 'siak_user',
    'password'  => $_ENV['DB_PASSWORD'] ?? 'password123',
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
    'strict'    => true,
    'engine'    => null,
]);

// Set as global
$capsule->setAsGlobal();

// Boot Eloquent
$capsule->bootEloquent();

// Enable query logging in development
if (($_ENV['APP_ENV'] ?? 'production') === 'development') {
    $capsule->connection()->enableQueryLog();
}