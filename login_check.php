<?php
include('config.php');
if(isset($_POST['login'])){
	$user = $_POST['username'];
	$pass = md5($_POST['password']);
	//untuk menentukan expire cookie, dihtung dri waktu server + waktu umur cookie          
	$time = time();                 
	//cek jika setcookie di cek set cookie jika tidak ''
	$check = isset($_POST['setcookie'])?$_POST['setcookie']:'';
	
	$sql = mysqli_query($link, "SELECT * FROM lord_user WHERE username='".$user."' AND password='".$pass."'");
	if(mysqli_num_rows($sql) == 0){
		echo '<script language="javascript">alert("Username atau password salah! Pastikan anda memasukkan username atau password yang sesuai"); document.location="login.php";</script>';
	}else{
		$_SESSION['user']=$user;
		echo '<script language="javascript">alert("Welcome '.$_SESSION['user'].'! You are successfully logged in!"); document.location="index.php";</script>';
	if($check) {        
			setcookie("cookielogin[user]",$user , $time + 3600);        
			setcookie("cookielogin[pass]", $pass, $time + 3600);    
			}
	}
}
?>