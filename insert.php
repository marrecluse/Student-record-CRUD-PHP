<?php

include 'conn.php';

if(isset($_POST['done'])){

// Change/Replace the variables/values accordingly

 $username = $_POST['username'];
 $password = $_POST['password'];
 $q = "INSERT INTO `user`(`username`, `password`) VALUES (?,?)";
 $stmt=$conn->prepare($q);
 
 $stmt->bind_param("ss",$username,$password);
 $stmt->execute();

}
?>

<!DOCTYPE html>
<html>
<head>
 <title></title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->


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

        <label class="font-weight-bold"> Username: </label>
        <input type="text" name="username" class="form-control"> <br>

       <label class="font-weight-bold"> Password: </label>
       <input type="text" name="password" class="form-control"> <br>

       <button class="btn btn-success font-weight-bold" type="submit" name="done"> Add </button>
       <a href="index.php"></a>

        
        </form>
        <form class="form-group" action="display.php" method="post">
          <button style="width: 100%;" class="btn btn-block bg-dark text-white btn-outline-primary font-weight-bold" type="submit" name="display">DISPLAY DATA</button>
        </form>


      </div>

</body>
</html>
