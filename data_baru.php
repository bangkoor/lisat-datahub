<?php 
include "config.php";
$sql = mysqli_query($link, "SELECT area_name, data_name, acquisition_date, date(upload_date) as upload_date FROM lord_data ORDER BY upload_date DESC LIMIT 3");
		$data_baru = mysqli_fetch_array($sql);
echo $data_baru['area_name'];
		?>