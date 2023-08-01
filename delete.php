<?php
include 'conn.php';


//reading ID; to perform action specifically
$id = $_GET['id'];



$q = "DELETE FROM `user` WHERE id = $id ";

$stmt=$conn->prepare($q);

$stmt->execute();

if($stmt->execute()){

//To redirect on display page
header("location: display.php");

}

 ?>
