<?php
include "config.php";
		//hitung download bulan ini
		$thisMonth = date('m');
		for($x=1;$x<=6;$x++){
			$query = mysqli_query($link, "SELECT COUNT(*) as jumlah, DATE_FORMAT(upload_date,'%m') as bulanUpload FROM lord_data WHERE DATE_FORMAT(upload_date,'%m') = ".$x." GROUP BY bulanUpload");
			$data = mysqli_fetch_array($query);
			if($data['jumlah'] == 0){
				echo "0, ";
			}else{
				echo $data['jumlah'].",";
			}
		}
?>