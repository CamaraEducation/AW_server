<?php 
 // open mysql connection
    $host = "localhost";
    $username = "xxxxxx";
    $password = "xxxxxx!";
    $dbname = "aw_database";
    $con = mysqli_connect($host, $username, $password, $dbname) or die('Error in Connecting: ' . mysqli_error($con));
 ?>