<?php

/**
 * Bootstraps the DB connection, session, and CSRF helpers for every page.
 * Credentials come from environment variables (.env), never from source.
 */

function loadEnv(string $path): void
{
    if (!file_exists($path)) {
        return;
    }
    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }
        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        if (getenv($key) === false) {
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

loadEnv(__DIR__ . '/.env');

$host     = getenv('DB_HOST') ?: 'localhost';
$port     = (int) (getenv('DB_PORT') ?: 3306);
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_NAME') ?: 'crudproject';

if ($username === false || $password === false) {
    die('Database credentials not configured. Copy .env.example to .env and fill in DB_USERNAME/DB_PASSWORD.');
}

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function csrfField(): string
{
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($_SESSION['csrf_token']) . '">';
}

function verifyCsrfToken(?string $token): bool
{
    return isset($_SESSION['csrf_token']) && $token !== null && hash_equals($_SESSION['csrf_token'], $token);
}

function requireLogin(): void
{
    if (empty($_SESSION['loggedin'])) {
        header('Location: index.php');
        exit;
    }
}
