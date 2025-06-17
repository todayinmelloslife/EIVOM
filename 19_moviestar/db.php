<?php

$configPath = __DIR__ . '/config.ini';
$config = [];
if (file_exists($configPath)) {
    $config = parse_ini_file($configPath);
}

$db_name = getenv('DB_NAME') ?: ($config['DB_NAME'] ?? 'moviestar');
$db_host = getenv('DB_HOST') ?: ($config['DB_HOST'] ?? 'localhost');
$db_user = getenv('DB_USER') ?: ($config['DB_USER'] ?? 'root');
$db_pass = getenv('DB_PASS') ?: ($config['DB_PASS'] ?? '');

$conn = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_host, $db_user, $db_pass);

// Habilitar erros PDO
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
