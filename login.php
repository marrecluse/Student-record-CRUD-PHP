<?php
include "conn.php";

$username="";
$password="";

if(isset($_POST["username"]) && $_POST["pwd"]) {

      $username = trim($_POST["username"]);

    if(empty(trim($_POST["username"]))) {
        //$username_err = "Please enter a username.";
        header("location:index.php");

    }

    else{
      $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["pwd"]))){
      header("location:index.php");
      //$password_err = "Please enter a password.";
    }
    else{
      $password = trim($_POST["pwd"]);
    }

  
    //Prepared queries to avoid sql injection
    $q= "SELECT * FROM `crudtable` WHERE `username` = ? AND `password` = ? ";
    $stmt=$conn->prepare($q);
    
    // only for PDO
      // $stmt->bind_param(':username',$username);
      // $stmt->bind_param(':password',$password);

    // for mysqli
    $stmt->bind_param('ss',$username,$password);  


    $stmt->execute();
    $stmt->store_result();
    $count =$stmt->num_rows();

    if($count == 1) {
        header('location:display.php');
                      }

      else {
      header('location:index.php');

        }


  }

else {
 header('location:index.php');

   }





 ?>
