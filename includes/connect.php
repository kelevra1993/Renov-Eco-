<?php 
$dbhost = "renovecody.mysql.db" ;
$dbuser = "renovecody" ;
$dbpass = "nYrufNVgfKDZ" ;
$dbname = "renovecody" ;
$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) ;

 if(mysqli_connect_errno()){
 die("Database connection failed :" .
 mysqli_connect_error().
 " (" .mysqli_connect_errno() . ")" );
  }
 // else{echo "success of connection" ;}?>