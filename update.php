<?php

require 'conn.php';
requireLogin();

$error = null;
$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);

if ($id <= 0) {
    header('Location: display.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['done'])) {
    if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
        $error = 'Your session expired, please try again.';
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '') {
            $error = 'Username is required.';
        } elseif ($password !== '') {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare('UPDATE students SET username = ?, password_hash = ? WHERE id = ?');
            $stmt->bind_param('ssi', $username, $passwordHash, $id);
            $stmt->execute();
            header('Location: display.php');
            exit;
        } else {
            $stmt = $conn->prepare('UPDATE students SET username = ? WHERE id = ?');
            $stmt->bind_param('si', $username, $id);
            $stmt->execute();
            header('Location: display.php');
            exit;
        }
    }
}

$stmt = $conn->prepare('SELECT username FROM students WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($currentUsername);
if (!$stmt->fetch()) {
    header('Location: display.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
 <title></title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/bootstrap/js/jquery.min.js">
   <link rel="stylesheet" href="assets/bootstrap/js/bootstrap.min.js">

<style>
  body{

background-image: url("assets/images/grad.jpg");
background-size: cover;

}
</style>


 </head>

 <body>

  <div class="col-lg-6 m-auto">

  <form method="post" action="update.php?id=<?php echo (int) $id; ?>">

  <br><br><div class="card">

  <div class="card-header bg-dark">
  <h1 class="text-white text-center">  Update Record </h1>
  </div><br>

  <?php if ($error): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <?php echo csrfField(); ?>
  <input type="hidden" name="id" value="<?php echo (int) $id; ?>">

  <label> Username: </label>
  <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($currentUsername); ?>"> <br>

 <label> Password (leave blank to keep unchanged): </label>
 <input type="password" name="password" class="form-control"> <br>

 <button class="btn btn-success" type="submit" name="done"> Submit </button><br>

 </div>
 </form>
 </div>
</body>
</html>
