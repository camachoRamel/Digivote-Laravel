<?php
 
$conn = mysqli_connect('localhost', 'db_admin', 'db_password', 'digivote_db');

if(!$conn){
    echo 'Connection error ' . $mysqli_connect_error;
}


?>