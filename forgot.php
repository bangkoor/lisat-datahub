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
include 'config.php';

if(isset($_SESSION['user'])){
	echo '<script language="javascript">document.location="index.php";</script>';
}

if (isset($_POST['reset'])) {
	date_default_timezone_set("Asia/Jakarta");
	$pass="1A2B4HTjsk5kwhadbwlff"; $panjang='8'; $len=strlen($pass); 
	$start=$len-$panjang; $xx=rand('0',$start); 
	$yy=str_shuffle($pass); 
	$passwordbaru=substr($yy, $xx, $panjang);
	 
	$email = trim(strip_tags($_POST['email']));
	$password = md5($passwordbaru);
	$datetime=date("h:i:s-j-M-Y");
	
	$sql = mysqli_query($link, "SELECT * FROM lord_user_contact as a, lord_user as b WHERE a.email='".$_POST['email']."' AND a.user_id = b.user_id");
	$data = mysqli_fetch_array($sql);
	if(mysqli_num_rows($sql) == 0){
		echo '<script type="text/javascript">';
		echo 'setTimeout(function () { swal("No!","Email tidak terdaftar!","warning");';
		echo '});</script>';
		//echo "<script language='javascript'>document.location='login.php';</script>";
	}else{
		// title atau subject email
		$alamat_email = $data['email'];
		$title = "Permintaan Password Baru";
		// isi pesan email disertai password
		$pesan = "Kami telah mereset Ulang Kata sandi anda. Silakan menggunakan password yang baru untuk login ke LISAT DataHub \n\n 
		Kata sandi Anda yang baru adalah: ".$passwordbaru."\n\n
		\n\n";
		// header email berisi alamat pengirim
		$header = "From: LISAT Data Centre <support_lisat@apps.ipb.ac.id>";
		// mengirim email
		$kirimEmail = mail('$alamat_email', $title, $pesan, $header);
		// cek status pengiriman email
		if ($kirimEmail) { 
			// update password baru ke database (jika pengiriman email sukses)
			$query = "UPDATE lord_user SET login_pass='".$password."' WHERE username = '".$user_id."'";
			$hasil = mysqli_query($link, $query);
			 
			if ($hasil){
				echo "berhasil";
				echo '<script type="text/javascript">';
				echo 'setTimeout(function () { swal("Yes!","Kata sandi baru telah direset dan sudah dikirim ke email anda. Silahkan cek email anda","success");';
				echo '});</script>';		
			}
		} else {
			echo '<script type="text/javascript">';
			echo 'setTimeout(function () { swal("No!","Pengaturan kembali kata sandi gagal!","error");';
			echo '});</script>';	
		}
	}

}
?>
<body class="hold-transition login-page">
<div class="login-box" style="padding-bottom:20px;">
  <div class="login-logo">
    <a href=""><b>LAPAN-IPB Satellite (LAPAN A3)</b><br/>Data Hub</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Masukkan email anda</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email anda" name="email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <!--<div class="checkbox icheck">
            <label>
              <input type="checkbox" name="setcookie" value="true" id="setcookie"> Remember Me
            </label>
          </div>-->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <input type="submit" class="btn btn-primary btn-block btn-flat" name="reset" value="Submit"></input>
        </div>
        <!-- /.col -->
      </div>
    </form>
	<a href="login" class="text-center">Kembali ke login</a><br/>
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
