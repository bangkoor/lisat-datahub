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
	set_time_limit(20);
	$conn_id = ftp_connect($ftp_server, 21, 10);
	if($conn_id){
		$conn_login = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
		$query = mysqli_query($link, "INSERT INTO lord_download_log (user_id, data_id) VALUES ('$user_id', '$data_id')");
		header('Location: ftp://'.$ftp_server.'/lisatstor01/'.$name.'');
		// close the connection
		//ftp_close($conn_id);
	}else{
		$ftp_server = "172.17.48.30";
		$pindah_ip = ftp_connect($ftp_server, 21, 10);
		if($pindah_ip){
			$conn_login = ftp_login($pindah_ip, $ftp_user_name, $ftp_user_pass);
			$query = mysqli_query($link, "INSERT INTO lord_download_log (user_id, data_id) VALUES ('$user_id', '$data_id')");
			echo "berhasil 172";
			header('Location: ftp://'.$ftp_server.'/lisatstor01/'.$name.'');
			// close the connection
			//ftp_close($pindah_ip);
			echo "Download berhasil!";
		}else{	
			echo "Couldn't establish a connection.";
		}
	}
	
}else{
	echo "<script>alert('Download gagal! Data tidak tersedia');document.location='index.php?p=data_download';</script>";
} 
?>