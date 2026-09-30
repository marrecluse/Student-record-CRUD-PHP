<?php
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['username'], $_POST['pwd'])) {
    header('Location: index.php');
    exit;
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    header('Location: index.php?error=badtoken');
    exit;
}

$username = trim($_POST['username']);
$password = trim($_POST['pwd']);

if ($username === '' || $password === '') {
    header('Location: index.php?error=empty');
    exit;
}

$stmt = $conn->prepare('SELECT id, username, password_hash FROM students WHERE username = ?');
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password_hash'])) {
    session_regenerate_id(true);
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $user['username'];
    header('Location: display.php');
} else {
    header('Location: index.php?error=invalid');
}
