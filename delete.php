<?php
require 'conn.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    header('Location: display.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);

$stmt = $conn->prepare('DELETE FROM students WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();

header('Location: display.php');
