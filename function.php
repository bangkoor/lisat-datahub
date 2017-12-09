<?php
function cekPassword($old, $new, $new2, $pw_user){
		if(!empty($old) && !empty($new) && !empty($new2)){
			if($pw_user == md5($old)){
				if($new!=$new2){
					echo '<script type="text/javascript">';
					echo 'setTimeout(function () { swal("No!","Password tidak cocok","warning");';
					echo '});</script>';
				}else{
					$gantiPassword = mysqli_query($link, "UPDATE lord_user SET login_pass='new'");
					echo '<script type="text/javascript">';
					echo 'setTimeout(function () { swal("Yes!","Password berhasil diganti","success");';
					echo '});</script>';
					session_destroy();
				}
			}else{
				echo '<script type="text/javascript">';
				echo 'setTimeout(function () { swal("No!","Password lama tidak cocok","warning");';
				echo '});</script>';
			}
		}else{
			echo '<script type="text/javascript">';
			echo 'setTimeout(function () { swal("","Password tidak diganti","warning");';
			echo '});</script>';
		}
	}

function ftp_konek($ftp_server){
		set_time_limit(20);
		$conn_id = ftp_connect($ftp_server, 21, 10);
		return $conn_id;
	}	
	
function cekLevel($user_level){
	$user_level = $user_level;
	if($user_level == 1){
		//echo "<script>alert('Anda tidak dapat mengakses halaman ini');document.location='index.php';</script>";
		/* echo '<script type="text/javascript">';
		echo 'setTimeout(function () { swal("","Anda tidak dapat mengakses halaman ini","error");';
		echo '});</script>'; */
		echo "<script>document.location='dashboard';</script>";
	}
}
/* function updateProfile($file_ext, $allowed_ext, file_size, $file_name, $user_id, $file_tmp ) {
	if(in_array($file_ext, $allowed_ext) === true){
					if($file_size < 204800){
						if(!$file_name == NULL){
							$queryEdit = mysqli_query($link, "UPDATE lord_user SET profpic='".$user_id.".".$file_ext."' WHERE user_id='".$user_id."';");
						}
						$lokasi = 'data/userprofile/'.$namaFile.'.'.$file_ext;
						move_uploaded_file($file_tmp, $lokasi);
						$queryEdit = mysqli_query($link, "UPDATE lord_user_contact SET prefix='".$prefix."', f_name='".$f_name."', l_name='".$l_name."', job ='".$job."', email='".$email."', institution='".$institution."', address='".$address."', phone='".$phone."' WHERE user_id='".$user_id."';");
						echo "<meta http-equiv='refresh' content='0'>";
					}else{
						$errorProfpic = "ERROR: File is to large! (max = 100 kb)";
					}
				}else{
					$errorProfpic = "ERROR: File extention not allowed! Please use jpg, png, or gif";
				}
} */

?>