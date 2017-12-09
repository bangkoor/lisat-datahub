<?php
include 'config.php';
// connect and login to FTP server
$conn_id = ftp_connect($ftp_server, 21, 10);
$login = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
// turn passive mode on
ftp_pasv($conn_id, true);

if($login){
	$chdir = ftp_chdir($conn_id, "lisatstor01");
	$local_file = "local.zip";
	$server_file = "LA3_2016-10-19_Lumajang.zip";

	// download server file
	if (ftp_nb_get($conn_id, $local_file, $server_file, FTP_BINARY))
	  {
		  $quoted = sprintf('"%s"', addcslashes(basename($local_file), '"\\'));
		  $size   = filesize($local_file);

		  header('Content-Description: File Transfer');
		  header('Content-Type: application/octet-stream');
		  header('Content-Disposition: attachment; filename=' . $quoted); 
		  header('Content-Transfer-Encoding: binary');
		  header('Connection: Keep-Alive');
		  header('Expires: 0');
		  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		  header('Pragma: public');
		  header('Content-Length: ' . $size);
		  
		echo "Successfully written to $local_file.";
	  }
	else
	  {
	  echo "Error downloading $server_file.";
	}
}else{
	echo "login failed";
}
// close connection
ftp_close($conn_id);
?>