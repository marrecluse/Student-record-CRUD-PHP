<?php

require 'conn.php';
requireLogin();

$error = null;

if (isset($_POST['done'])) {
    if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
        $error = 'Your session expired, please try again.';
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $error = 'Username and password are required.';
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $q = 'INSERT INTO students (username, password_hash) VALUES (?, ?)';
            $stmt = $conn->prepare($q);
            $stmt->bind_param('ss', $username, $passwordHash);

            if ($stmt->execute()) {
                header('Location: display.php');
                exit;
            }

            $error = 'Could not add student (username may already be taken).';
        }
    }
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

   <style media="screen">


     body{

       background-image: url("assets/images/grad.jpg");
       background-size: cover;
          }

    button{
      margin-top: 30px;
    }


   </style>

 </head>
 <body>

  <div class="col-lg-6 m-auto">

     <form method="post" action="insert.php">

        <br> <br> <br> <div class="card">

        <div class="card-header bg-dark">
        <h1 class="text-warning text-center">  Add Student </h1>
        </div><br>

        <?php if ($error): ?>
          <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php echo csrfField(); ?>

        <label class="font-weight-bold"> Username: </label>
        <input type="text" name="username" class="form-control"> <br>

       <label class="font-weight-bold"> Password: </label>
       <input type="password" name="password" class="form-control"> <br>

       <button class="btn btn-success font-weight-bold" type="submit" name="done"> Add </button>
       <a href="display.php"></a>


        </form>
        <form class="form-group" action="display.php" method="get">
          <button style="width: 100%;" class="btn btn-block bg-dark text-white btn-outline-primary font-weight-bold" type="submit" name="display">DISPLAY DATA</button>
        </form>


      </div>

</body>
</html>
