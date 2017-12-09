<?php
session_start();
//koneksi ke database 
$user_name = "root";
$password = "password";
$database = "lisat.order.new";
$host_name = "localhost"; 
 
$link=mysqli_connect($host_name, $user_name, $password, $database);

$ftp_user_name='userlisat';
$ftp_user_pass='pslvc34';
$ftp_server='172.17.48.30';
 
?>
