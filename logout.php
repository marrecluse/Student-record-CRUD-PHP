<?php
require 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    $_SESSION = [];
    session_destroy();
}

header('Location: index.php');
