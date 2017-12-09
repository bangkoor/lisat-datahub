<?php
include "config.php";
include "query_user.php";
include "function.php";

$data_id = $_GET['data_id'];

$user_id = $query_user['user_id'];

$query = mysqli_query($link, "SELECT count(*) as jumlah, data_url FROM lord_data WHERE data_id='".$data_id."'");
$query_data = mysqli_fetch_array($query);

if($query_data['jumlah'] > 0){
	$name= $query_data['data_url'];
	//connect to the server
	$conn_id = ftp_konek($ftp_server);
	if($conn_id){
		 // login with username and password
		 $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
	}
	// check connection
	if ((!$conn_id) || (!$login_result)) {
		$ftp_server = "172.17.48.30";
		$change_ip = ftp_konek($ftp_server);
		if($change_ip){
			 // login with username and password
			 $login_result = ftp_login($change_ip, $ftp_user_name, $ftp_user_pass);
		}
		if (($change_ip) || ($login_result)) {
			header('Location: ftp://'.$ftp_server.'/lisatstor01/'.$name.'');
		}else{
			echo "koneksi gagal";
		}
		// close the FTP stream 
		ftp_close($change_ip);
	} else {
		header('Location: ftp://'.$ftp_server.'/lisatstor01/'.$name.'');
		// close the FTP stream 
		ftp_close($conn_id);
	   
	}
}else{
	echo "<script>alert('Download gagal! Data tidak tersedia');document.location='index.php?p=data_download';</script>";
} 
?>