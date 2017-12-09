<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LISAT Symposium | Registration Page</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="plugins/sweetalert/sweetalert.css">
  <script src="plugins/sweetalert/sweetalert-min.js"></script>
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
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<?php
include "config.php";
$site_key 	= '6Le1uiEUAAAAAN_j-iHRU5pgixQkDjrFmyfrS8f6'; 
$secret_key = '6Le1uiEUAAAAAOcRaDi07D2dE5fZ3cZnRAC2VI98';
$captcha = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response']:''; 

if (isset($_POST['submitRegister']))
{
	if ($captcha != '') {
	   $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret_key) . '&response=' . $captcha;   
	   $recaptcha = file_get_contents($url);
	   $recaptcha = json_decode($recaptcha, true);
	   if (!$recaptcha['success']) {
		  echo '<script language="javascript">alert("Gagal! Mohon cek captcha!");</script>';
	   } else {
			$password 		= @$_POST['password'];
			$username 		= @$_POST['username'];
			$prefix 		= @$_POST['prefix'];
			$f_name 		= @$_POST['f_name'];
			$l_name 		= @$_POST['l_name'];
			$job	 		= @$_POST['job'];
			$email 			= @$_POST['email'];
			$institution 	= @$_POST['institution'];
			$address 		= @$_POST['address'];
			$phone 			= @$_POST['phone'];
			
			$q_1 			= @$_POST['q_1'];
			$q_2 			= @$_POST['q_2'];
			$q_3 			= @$_POST['q_3'];
			
			$cek_user=mysqli_query($link, "SELECT count(*) FROM lord_user as a, lord_user_contact as b WHERE a.username='".$username."' OR b.email='".$email."'");
			$hitung_user = mysqli_fetch_row($cek_user);
			if($hitung_user==0){
				$tambah_user=mysqli_query($link, "INSERT INTO lord_user (username, password, profpic, level) VALUES ('$username', md5('$password'), 'default.png', 1)");
				$tambah_user_contact=mysqli_query($link, "INSERT INTO lord_user_contact (prefix, f_name, l_name, address, job, institution, phone, email) VALUES ('$prefix', '$f_name', '$l_name', '$address', '$job', '$institution', '$phone', '$email')");
				$tambah_questionnaire=mysqli_query($link, "INSERT INTO lord_questionnaire (q_1, q_2, q_3) VALUES ('$q_1', '$q_2', '$q_3')");
				echo '<script language="javascript">alert("Anda berhasil mendaftar. Silakan login");document.location="login?reg=success";</script>';
			} else {
				echo '<script type="text/javascript">';
				echo 'setTimeout(function () { swal("No!","Username atau email telah terdaftar. Pastikan anda memasukkan username atau email yang belum terdaftar!","warning");';
				echo '});</script>';
			}
	   }
	} else {
	   echo '<script language="javascript">alert("Gagal! Mohon cek captcha!");</script>';
	}
}
?>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="login-logo">
    <a href=""><b>LAPAN-IPB Satellite (LAPAN A3)</b><br/>Data Hub</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Daftar Anggota Baru</p>

    <form action="" method="post">
      <div class="form-group">
					<label>Gelar/Sapaan</label>
					<select class="form-control" id="prefix" name="prefix" required>
						<option value="" selected="selected"></option>
						<option value="Bapak" >Bapak</option>
						<option value="Ibu" >Ibu</option>
						<option value="Nona" >Nona</option>
						<option value="Dr." >Dr.</option>
						<option value="Prof." >Prof.</option>
					</select>
				</div>
				<div class="form-group">
					<label>Nama lengkap sesuai KTP</label>
						<table style="width:100%">
							<tr>
								<label style="display:none;" for="FirstName">Nama Depan</label>
								<label style="display:none;" for="LastName">Nama Belakang</label>
								<td><input style="width: 97%" class="form-control" id="FirstName" name="f_name" placeholder="Nama Depan" type="text" required/></td>
								<td><input style="width: 97%" class="form-control" id="LastName" name="l_name" placeholder="Nama Belakang" type="text" required/></td>
							</tr>
						</table>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea name="address" class="form-control" rows="3" id="address" required></textarea>
				</div>
				<div class="form-group">
					<label>Nomor Telepon</label>
					<input type="text" name="phone" class="form-control" id="phone" placeholder="" required>			
				</div>
				<div class="form-group">
					<label>Alamat Email</label>
					<input type="email" name="email" class="form-control" id="email" placeholder="i.e. budi@apps.ipb.ac.id" value="" required>					
				</div>
				<div class="form-group">
					<label>Pekerjaan</label>
					<select class="form-control" id="job" name="job" required>
						<option value="" selected="selected"></option>
						<option value="mahasiswa">Mahasiswa</option>
						<option value="dosen">Dosen</option>
						<option value="peneliti">Peneliti</option>
						<option value="lainnya">Lainnya</option>
					</select>
				</div>
				<div class="form-group">
					<label>Institusi/Perusahaan asal</label>
					<input type="text" name="institution" class="form-control" id="institution" placeholder="i.e. Pusat Penelitian Lingkungan Hidup (PPLH) IPB" required>					
				</div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control" id="username" required>					
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control" id="password" required>					
				</div>
				<div class="form-group">
					<label>Konfirmasi Password</label>
					<input type="password" name="password2" class="form-control" id="confirm_password" required>					
				</div>
				<h3>Survey Evaluasi</h3>(wajib diisi)
				<div class="form-group">
					<label>Apa tujuan utama anda menggunakan data LISAT?</label>
					<textarea name="q_1" class="form-control" rows="4" id="q_1" required></textarea>
				</div>
				<div class="form-group">
					<label>Apa bidang penelitian anda?</label>
					<select class="form-control" id="q_2" name="q_2" required>
						<option value="" selected="selected"></option>
						<option value="lingkungan hidup">Lingkungan hidup</option>
						<option value="kehutanan">Kehutanan</option>
						<option value="pertanian">Pertanian</option>
						<option value="kelautan & perikanan">Kelautan & Perikanan</option>
						<option value="teknologi satelit">Teknologi satelit</option>
						<option value="lainnya">Lainnya</option>
					</select>
				</div>
				<div class="form-group">
					<label>Tuliskan uraian singkat mengenai rencana penelitian anda menggunakan data LISAT!</label>
					<textarea name="q_3" class="form-control" rows="4" id="q_3" required></textarea>
				</div>
	  <div class="g-recaptcha" data-sitekey="6Le1uiEUAAAAAN_j-iHRU5pgixQkDjrFmyfrS8f6"></div><br/><br/>
      <div align="center">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="submitRegister">Daftar</button>
        </div>
        <!-- /.col -->
		<div align="center">
		<a href="login" class="text-center">Saya sudah memiliki akun</a>
		</div>
	  </div>
	  
    </form>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
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
<script type="text/javascript">
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords tidak cocok!");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
</body>
</html>
