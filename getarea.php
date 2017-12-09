<?php
include "config.php";
include "query_user.php";

$area = $_GET['area'];
//$deg="s2s3";
echo 	"<thead>";
echo	"<tr>";
echo    "<th>#</th>";
echo    "<th>Area</th>";
echo	"<th>Area Spesifik</th>";
echo	"<th>Tanggal Akuisisi</th>";
echo	"<th>Ukuran File</th>";
echo	"<th>Download</th>";
echo	"</tr>";
echo	"</thead>";
echo	"<tbody>";
if($area=='all'){
	$sql = mysqli_query($link, "SELECT data_id, area_name, data_name, acquisition_date, data_size, data_url FROM lord_data ORDER BY area_name");
    if(mysqli_num_rows($sql) != 0){
		$no=1;
        while($data = mysqli_fetch_assoc($sql)){
			$id_data = $data['data_id'];
             echo "
			 <tr>
			 <td width='5%'>".$no."</td>
			 <td width='20%'>".$data['area_name']."</td>
			 <td width='20%'>".$data['data_name']."</td>
			 <td width='25%'>".$data['acquisition_date']."</td>
			 <td width='10%'>".$data['data_size']." GB</td>
			 <td width='20%'><a href='download.php?data_id=".$id_data."' target='_blank'><button type='button' class='btn btn-success btn-sm'>Download</button></a> <a href='dashboard?p=data_detail&data_id=".$id_data."'><button type='button' class='btn btn-warning btn-sm'>Detail</button></a></td>
			 </tr>";
			 $no++;
        }
    }
} else {
$sql = mysqli_query($link, "SELECT data_id, area_name, data_name, acquisition_date, data_size, data_url FROM lord_data WHERE area_id='".$area."' ORDER BY area_name");	
    if(mysqli_num_rows($sql) != 0){
		$no=1;
        while($data = mysqli_fetch_assoc($sql)){
			$id_data = $data['data_id'];
            echo "
			 <tr>
			 <td width='5%'>".$no."</td>
			 <td width='20%'>".$data['area_name']."</td>
			 <td width='20%'>".$data['data_name']."</td>
			 <td width='25%'>".$data['acquisition_date']."</td>
			 <td width='10%'>".$data['data_size']." GB</td>
			 <td width='20%'><a href='download.php?data_id=".$id_data."'><button type='button' class='btn btn-success btn-sm'>Download</button></a> <a href='dashboard?p=data_detail&data_id=".$id_data."'><button type='button' class='btn btn-warning btn-sm'>Detail</button></a></td>
			 </tr>";
			 $no++;
        }
    }
}
?>