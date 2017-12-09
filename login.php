<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LISAT DATA HUB LOGIN</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="plugins/sweetalert/sweetalert.css">
  <script src="plugins/sweetalert/sweetalert-min.js"></script>
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
	<style>
	html{
	background: url(assets/images/background.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
	}
	</style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<?php
include('config.php');

if(isset($_SESSION['user'])){
	echo '<script language="javascript">document.location="dashboard";</script>';
}

if(isset($_POST['login'])){
	$user = $_POST['username'];
	$pass = md5($_POST['password']);
	//untuk menentukan expire cookie, dihtung dri waktu server + waktu umur cookie          
	$time = time();                 
	//cek jika setcookie di cek set cookie jika tidak ''
	$check = isset($_POST['setcookie'])?$_POST['setcookie']:'';
	
	$sql = mysqli_query($link, "SELECT * FROM lord_user as a, lord_user_contact as b WHERE a.username='".$user."' AND a.login_pass='".$pass."' AND a.user_id=b.user_id");
	$data = mysqli_fetch_array($sql);
	if(mysqli_num_rows($sql) == 0){
		echo '<script type="text/javascript">';
	  echo 'setTimeout(function () { swal("No!","Username atau password tidak terdaftar!","warning");';
	  echo '});</script>';
		//echo "<script language='javascript'>document.location='login.php';</script>";
	}else{
		$_SESSION['user']=$user;
		$pesan = "Selamat Datang!";
		$title_alert = "Yes!";
		$type_alert = "success";
		if($data['level'] == 1){
			echo '<script language="javascript">document.location="dashboard";</script>';
		}else{
			echo '<script language="javascript">document.location="dashboard?p=adm_home";</script>';
		}
		if($check) {        
				setcookie("cookielogin[user]",$user , $time + 3600);        
				setcookie("cookielogin[pass]", $pass, $time + 3600);    
				}
	}
?>
<?php
}
?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>LAPAN-IPB Satellite (LAPAN A3)</b><br/>Data Hub</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Masuk ke dalam sistem</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="setcookie" value="true" id="setcookie"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <input type="submit" class="btn btn-primary btn-block btn-flat" name="login" value="Masuk"></input>
        </div>
		
        <!-- /.col -->
      </div>
    </form>

    <!--<div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->
	<a href="forgot" class="text-center">Lupa password</a><br/>
    <a href="register" class="text-center">Daftar menjadi anggota</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- sweetalert -->
<script src="plugins/sweetalert/sweetalert.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
