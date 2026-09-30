<?php
require 'conn.php';
requireLogin();
?>
<!DOCTYPE html>
<html>
<head>
 <title></title>

 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
 <link rel="stylesheet" href="assets/bootstrap/js/jquery.min.js">
 <link rel="stylesheet" href="assets/bootstrap/js/bootstrap.min.js">

 <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
   <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>



   <style media="screen">


     body{

     background-image: url("assets/images/grad.jpg");
     background-size: cover;
     background-position: fixed;
  }

  th{
    font-weight: bolder;
    color: green;
  }
   </style>



</head>
<body>

 <div class="container">
 <div class="col-lg-12">
 <br><br>
 <h1 class="text-warning text-center" > Display Student Data </h1>
 <br>
 <table  id="tabledata" class=" table table-striped table-hover table-bordered">

 <tr class="bg-dark text-white text-center">

 <th class="text-warning"> ID </th>
 <th class="text-warning"> Username </th>
 <th class="text-warning"> Delete </th>
 <th class="text-warning"> Update </th>

 </tr>

 <?php

 $q = 'SELECT id, username FROM students ORDER BY id';
 $stmt = $conn->prepare($q);
 $stmt->execute();
 $stmt->bind_result($id, $username);

 while ($stmt->fetch()) {
 ?>
 <tr class="text-center">
 <td class="text-white"> <?php echo htmlspecialchars($id); ?> </td>
 <td class="text-white"> <?php echo htmlspecialchars($username); ?> </td>
 <td class="text-white">
   <form action="delete.php" method="post" onsubmit="return confirm('Delete this student?');" style="display:inline;">
     <?php echo csrfField(); ?>
     <input type="hidden" name="id" value="<?php echo (int) $id; ?>">
     <button type="submit" class="btn-danger btn text-white">Delete</button>
   </form>
 </td>
 <td class="text-white"> <button class="btn-primary btn"> <a href="update.php?id=<?php echo (int) $id; ?>" class="text-white"> Update </a> </button> </td>

 </tr>

 <?php
 }
 ?>

 </table>

 <center>
 <form class="form-group" action="insert.php" method="get">
   <button  class="btn btn-block bg-dark text-white btn-outline-primary font-weight-bold" type="submit" name="insert">Add Student</button>
 </form>

 <form class="form-group mt-3" action="logout.php" method="post">
   <?php echo csrfField(); ?>
   <button class="btn btn-block bg-dark text-white btn-outline-primary font-weight-bold" type="submit" name="logout">Log Out</button>
 </form>
 </center>
 </div>


 </div>



</body>
</html>
