<?php
$user_id = $query_user['user_id'];
$sql = mysqli_query($link, "SELECT * FROM lord_download_log WHERE user_id='".$user_id."'");
$data = mysqli_fetch_array($sql);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Riwayat Unduh
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Riwayat Unduh</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="box box-primary">
        <div class="box-header with-border">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
				<?php
				$sql = mysqli_query($link, "SELECT * FROM lord_download_log WHERE user_id='".$data['user_id']."'");
					if(mysqli_num_rows($sql) != 0){
				?>
					<table id="tampil_history" name="tampil_history" class="table table-bordered table-striped">
					<?php
					echo 	"<thead>";
					echo	"<tr>";
					echo    "<th>#</th>";
					echo    "<th>Tanggal Download</th>";
					echo    "<th>Area</th>";
					echo    "<th>Area Spesifik</th>";
					echo    "<th>Ukuran File</th>";
					echo	"</tr>";
					echo	"</thead>";
					echo	"<tbody>";
						$no=1;
						while($data = mysqli_fetch_assoc($sql)){
							$sql2 = mysqli_query($link, "SELECT * FROM lord_data WHERE data_id='".$data['data_id']."'");
							$data2 = mysqli_fetch_assoc($sql2);
							 echo "
							 <tr>
							 <td width='5%'>".$no."</td>
							 <td width='20%'>".$data['tanggal_download']."</td>
							 <td width='30%'>".$data2['area_name']."</td>
							 <td width='30%'>".$data2['data_name']."</td>
							 <td width='20%'>".$data2['data_size']." GB</td>
							 </tr>";
							 $no=$no+1;
						}
					} else {
						echo "
						<div class='alert alert-warning alert-dismissible'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-ban'></i> Error!</h4>
							Anda belum mendownload data apapun!
						  </div>
						"; 
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
  $(function () {
    $("#example1").DataTable();
    $('#tampil_data').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>