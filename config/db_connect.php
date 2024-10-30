<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "pizza"; 

$conn = mysqli_connect($servername , $username , $password , $dbname);

if(!$conn){
	echo 'connecction error'. mysqli_connect_error();
}