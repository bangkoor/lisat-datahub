<?php
require_once("./plugins/cipher/Cipher.php");
$cipher = new Cipher(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
?>
<script type="text/javascript">

function tampilArea()
{
	var htmlobjek;
    var area = $("#area").val();
    $.ajax({
        url: "./getarea.php",
        data: "area="+area,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=dept>
            $("#tampil_data").html(msg);
        }
    });
}

</script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Unduh Data
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Unduh Data</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="box box-primary">
        <div class="box-header with-border">
			<form method="post" action="" enctype="multipart/form-data">
			<div class="col-md-12">
			<label>Pilih area</label>
			<div class="input-group input-group-md">
                <select class="form-control" id="area" name="area" onchange="tampilArea();">
					<option id="all" value="all" selected>Semua area</option>
					<option id="sum" value="sum">Sumatera</option>
                    <option id="jaw" value="jaw">Jawa & Bali</option>
                    <option id="kal" value="kal">Kalimantan</option>
                    <option id="sul" value="sul">Sulawesi</option>
                    <option id="pap" value="pap">Papua</option>
					<option id="mal" value="mal">Maluku dan wilayah lainnya</option>
                </select>
              </div>
			</div>
			</form>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
				<table id="tampil_data" name="tampil_data" class="table table-bordered table-striped">
				<thead>
				<tr>
				<th>#</th>
				<th>Area</th>
				<th>Area Spesifik</th>
				<th>Tanggal Akuisisi</th>
				<th>Ukuran File</th>
				<th>Download</th>
				</tr>
				</thead>
				<?php
				echo	"<tbody>";
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
						 $no=$no+1;
					}
				}
				?>
				</table>
			</div>
		  </div>
		</div>
		</div>
	</section>
</div>
<script>
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>