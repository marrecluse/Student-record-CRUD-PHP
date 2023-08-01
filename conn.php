<?php

$host= 'localhost';
$username='abdul';
$password='Dani=7262';
$database='crudproject';

//Establish the database connection

$conn= new mysqli($host,$username, $password,$database);

//Check the connection for errors

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
