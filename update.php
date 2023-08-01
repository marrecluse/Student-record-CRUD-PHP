<?php

include 'conn.php';

if (isset($_POST['done'])) {

  $id=$_GET['id'];
  $username=$_POST['username'];
  $password=$_POST['password'];


$q = " update user set id=$id, username='$username', password='$password' where id=$id ";
$q= "update user set id=$id, username= ?, password=? where id=$id";

$stmt=$conn->prepare($q);
$stmt->bind_param('ss',$username,$password);

$stmt->execute();

if ($stmt->execute()) {

    header('location:display.php');
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

<style>
  body{

background-image: url("assets/images/grad.jpg");
background-size: cover;

}
</style>


 </head>

 <body>

  <div class="col-lg-6 m-auto">

  <form method="post">

  <br><br><div class="card">

  <div class="card-header bg-dark">
  <h1 class="text-white text-center">  Update Record </h1>
  </div><br>

  <label> Username: </label>
  <input type="text" name="username" class="form-control"> <br>

 <label> Password: </label>
 <input type="text" name="password" class="form-control"> <br>

 <button class="btn btn-success" type="submit" name="done"> Submit </button><br>

 </div>
 </form>
 </div>
</body>
</html>
