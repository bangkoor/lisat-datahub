<?php
cekLevel($query_user['level']);
//lihat jumlah data
$query_data = mysqli_query($link, "SELECT COUNT(*) as jumlah FROM lord_data");
$jlhData = mysqli_fetch_array($query_data);
//hitung pengguna
$query_data = mysqli_query($link, "SELECT COUNT(*) as jumlah FROM lord_user");
$jlhUser = mysqli_fetch_array($query_data);
//hitung download
$query_data = mysqli_query($link, "SELECT COUNT(*) as jumlah FROM lord_download_log");
$jlhDownload = mysqli_fetch_array($query_data);
//hitung download hari ini
$today = date('Y-m-d');
$query_data = mysqli_query($link, "SELECT COUNT(*) as jumlah FROM lord_download_log WHERE DATE_FORMAT(tanggal_download,'%Y-%m-%d')='$today'");
$jlhDownloadtoday = mysqli_fetch_array($query_data);
?>
<script src="plugins/highcharts/highcharts.js"></script>
<script src="plugins/highcharts/highcharts-3d.js"></script>
<script src="plugins/highcharts/modules/exporting.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin/Manager Dashboard</li>
      </ol>
    </section>

    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-file"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Data Tersedia</span>
              <span class="info-box-number"><?php echo $jlhData['jumlah']; ?> <small>data</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah Pengguna</span>
              <span class="info-box-number"><?php echo $jlhUser['jumlah']; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-download"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah download</span>
              <span class="info-box-number"><?php echo $jlhDownload['jumlah']; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-download"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">download Hari Ini</span>
              <span class="info-box-number"><?php echo $jlhDownloadtoday['jumlah']; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-8">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Rekapitulasi Bulanan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
			  <p class="text-center">
                    <strong>Dari Bulan Sebelumnya</strong>
                  </p>
					<?php
					//hitung data bulan ini
					$thisMonth = date('m');
					$query1 = mysqli_query($link, "SELECT COUNT(*) as jumlah, DATE_FORMAT(upload_date,'%m') as bulanUpload FROM lord_data WHERE DATE_FORMAT(upload_date,'%m') = $thisMonth -1");
					$query2 = mysqli_query($link, "SELECT COUNT(*) as jumlah, DATE_FORMAT(upload_date,'%m') as bulanUpload FROM lord_data WHERE DATE_FORMAT(upload_date,'%m') = $thisMonth");
					$jumlah1 = mysqli_fetch_array($query1);
					$jumlah2 = mysqli_fetch_array($query2);
					$selisih = $jumlah2['jumlah'] - $jumlah1['jumlah'];
					if($jumlah1['jumlah'] == 0){
						$selisihPersen = "NaN";
						$warnaTeks = "text-yellow";
						$caret = "fa-caret-left";
					}else{
						$selisihPersen = ($selisih/$jumlah1['jumlah'])*100;
						if($selisih < 0){
							$warnaTeks = "text-red";
							$caret = "fa-caret-down";
						}else if($selisih > 0){
							$warnaTeks = "text-green";
							$caret = "fa-caret-up";
						}else{
							$warnaTeks = "text-yellow";
							$caret = "fa-caret-left";
						}
					}
					
					//hitung download bulan ini
					$thisMonth = date('m');
					$query1 = mysqli_query($link, "SELECT COUNT(*) as jumlah, DATE_FORMAT(tanggal_download,'%m') as bulanDownload FROM lord_download_log WHERE DATE_FORMAT(tanggal_download,'%m') = $thisMonth -1");
					$query2 = mysqli_query($link, "SELECT COUNT(*) as jumlah, DATE_FORMAT(tanggal_download,'%m') as bulanDownload FROM lord_download_log WHERE DATE_FORMAT(tanggal_download,'%m') = $thisMonth");
					$jumlah1 = mysqli_fetch_array($query1);
					$jumlah2 = mysqli_fetch_array($query2);
					$selisihDown = $jumlah2['jumlah'] - $jumlah1['jumlah'];
					if($jumlah1['jumlah'] == 0){
						$selisihPersenDown = "NaN";
						$warnaTeksDown = "text-yellow";
						$caretDown = "fa-caret-left";
					}else{
						$selisihPersenDown = ($selisihDown/$jumlah1['jumlah'])*100;
						if($selisih < 0){
						$warnaTeksDown = "text-red";
						$caretDown = "fa-caret-down";
						}else if($selisih > 0){
							$warnaTeksDown = "text-green";
							$caretDown = "fa-caret-up";
						}else{
							$warnaTeksDown = "text-yellow";
							$caretDown = "fa-caret-left";
						}
					}
					?>
					
                <div class="col-sm-6 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage <?php echo $warnaTeks; ?>"><i class="fa <?php echo $caret; ?>"></i> <?php echo $selisihPersen; ?> %</span>
                    <h5 class="description-header"><?php echo $selisih; ?></h5>
                    <span class="description-text">DATA BARU</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage <?php echo $warnaTeksDown; ?>"><i class="fa <?php echo $caretDown; ?>"></i><?php echo $selisihPersenDown; ?> %</span>
                    <h5 class="description-header"><?php echo $selisihDown; ?></h5>
                    <span class="description-text">TOTAL DOWNLOAD</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
		<div class="col-md-4">
			<div class="row">
			  <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Peringkat Download Pengguna</h3>

				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				  </div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div class="row">
				  <?php
				  $query_rank = mysqli_query($link, "SELECT prefix, f_name, l_name, institution, COUNT(*) as jumlah FROM lord_user_contact as a, lord_download_log as b WHERE a.user_id=b.user_id GROUP BY b.user_id ORDER BY jumlah DESC LIMIT 4");
				  ?>
					<div class="col-md-12">
					  <div class="chart">
						<table class="table table-condensed">
					<tr>
					  <th style="width: 10px">#</th>
					  <th>Nama Pengguna</th>
					  <th>Institusi</th>
					  <th style="width: 40px">Jumlah Download</th>
					</tr>
					<?php
					$no=1;
					while($data = mysqli_fetch_assoc($query_rank)){
					echo "
					<tr>
					  <td>".$no."</td>
					  <td>".$data['prefix']." ".$data['f_name']." ".$data['l_name']."</td>
					  <td>".$data['institution']."</td>
					  <td align='center'><span class='badge bg-red'>".$data['jumlah']."</span></td>
					</tr>";
					$no++;
					}
					?>
				  </table>
					  </div>
					  <!-- /.chart-responsive -->
					</div>
					<!-- /.col -->
				  </div>
				  <!-- /.row -->
				</div>
				<!-- ./box-body -->
			  </div>
			  <!-- /.box -->
			</div>
			<div class="row">
				<div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Data Paling Banyak Didownload</h3>

				  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				  </div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div class="row">
				  <?php
				  $query_rank = mysqli_query($link, "SELECT a.area_name, a.data_name, COUNT(*) as jumlah FROM lord_data as a, lord_download_log as b WHERE a.data_id=b.data_id GROUP BY b.data_id ORDER BY jumlah DESC LIMIT 4");
				  ?>
					<div class="col-md-12">
					  <div class="chart">
						<table class="table table-condensed">
					<tr>
					  <th style="width: 10px">#</th>
					  <th>Area</th>
					  <th>Spesifik</th>
					  <th style="width: 40px">Jumlah Download</th>
					</tr>
					<?php
					$no=1;
					while($data = mysqli_fetch_assoc($query_rank)){
					echo "
					<tr>
					  <td>".$no."</td>
					  <td>".$data['area_name']."</td>
					  <td>".$data['data_name']."</td>
					  <td align='center'><span class='badge bg-blue'>".$data['jumlah']."</span></td>
					</tr>";
					$no++;
					}
					?>
				  </table>
					  </div>
					  <!-- /.chart-responsive -->
					</div>
					<!-- /.col -->
				  </div>
				  <!-- /.row -->
				</div>
				<!-- ./box-body -->
			  </div>
			  <!-- /.box -->
			</div>			
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-6">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Pengguna Berdasarkan Institusi</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="userInstitution" style="height: 400px"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
		<div class="col-md-6">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Pengguna Berdasarkan Pekerjaan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="userJob" style="height: 400px"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
	  <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-6">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Download Berdasarkan Institusi</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="downloadInstitution" style="height: 400px"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
		<div class="col-md-6">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Download Berdasarkan Pekerjaan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="downloadJob" style="height: 400px"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
     
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">

Highcharts.chart('userInstitution', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45
        }
    },
	title: {
        text: 'Pengguna Berdasarkan Institusi'
    },
    plotOptions: {
        pie: {
            innerSize: 100,
            depth: 45
        }
    },
    series: [{
        name: 'Jumlah pengguna',
        data: [
        <?php
		$query = mysqli_query($link, "SELECT institution, count(*) as jumlah FROM lord_user_contact GROUP BY institution");
		while($data = mysqli_fetch_assoc($query)){
		echo "['".$data['institution']."', ".$data['jumlah']."],";
		}
		?>
        ]
    }]
});
		</script>
<script type="text/javascript">

Highcharts.chart('userJob', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45
        }
    },
	title: {
        text: ''
    },
    plotOptions: {
        pie: {
            innerSize: 100,
            depth: 45
        }
    },
    series: [{
        name: 'Jumlah pengguna',
        data: [
		<?php
		$query = mysqli_query($link, "SELECT c.jobName, c.id, count(*) as jumlah FROM lord_user_contact as a, lord_user as b, lord_user_job as c WHERE a.user_id=b.user_id AND a.job=c.id GROUP BY a.job ORDER BY c.id");
		while($data = mysqli_fetch_assoc($query)){
		echo "['".$data['jobName']."', ".$data['jumlah']."],";
		}
		?>
        ]
    }]
});
		</script>
<script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Data Tahun 2017'
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        title: {
            text: 'Data',
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        }
    }, { // Secondary yAxis
        title: {
            text: 'Download',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value}',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        opposite: true
    }],
    tooltip: {
        shared: true
    },
    legend: {
        layout: 'vertical',
        align: 'left',
        x: 120,
        verticalAlign: 'top',
        y: 100,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
    series: [{
        name: 'Jumlah Data Baru',
        type: 'column',
        yAxis: 1,
		data: [
		<?php
		//hitung download bulan ini
		$thisMonth = date('m');
		for($x=1;$x<=$thisMonth;$x++){
			$query = mysqli_query($link, "SELECT COUNT(*) as jumlah, DATE_FORMAT(upload_date,'%m') as bulanUpload FROM lord_data WHERE DATE_FORMAT(upload_date,'%m') = ".$x." GROUP BY bulanUpload");
			$data = mysqli_fetch_array($query);
			if($data['jumlah'] == 0){
				echo "0, ";
			}else{
				echo $data['jumlah'].",";
			}
		}
		?>
		],
        tooltip: {
            valueSuffix: ''
        }

    }, {
        name: 'Jumlah Download Unique',
        type: 'column',
        data: [
		<?php
		//hitung download bulan ini
		for($x=1;$x<=$thisMonth;$x++){
			$query = mysqli_query($link, "SELECT count(distinct data_id) as jumlah, DATE_FORMAT(tanggal_download,'%m') as bulanDownload FROM lord_download_log WHERE DATE_FORMAT(tanggal_download,'%m') = ".$x." GROUP BY bulanDownload");
			$data = mysqli_fetch_array($query);
			if($data['jumlah'] == 0){
				echo "0, ";
			}else{
				echo $data['jumlah'].",";
			}
		}
		/* $query = mysqli_query($link, "SELECT count(distinct data_id) as jumlah, DATE_FORMAT(tanggal_download,'%m') as bulanDownload FROM lord_download_log GROUP BY bulanDownload");
		while($data = mysqli_fetch_assoc($query)){
			echo $data['jumlah'].",";
		} */
		?>
		],
        tooltip: {
            valueSuffix: ''
        }
    }]
});
		</script>
		<script type="text/javascript">

Highcharts.chart('downloadInstitution', {
    chart: {
        type: 'column'
    },
	title: {
        text: ''
    },
    xAxis: {
        categories: [
            <?php
			$query = mysqli_query($link, "SELECT a.institution, c.id FROM lord_user_contact as a, lord_download_log as b, lord_user_job as c WHERE a.user_id=b.user_id GROUP BY a.institution ORDER BY a.institution");
			while($data = mysqli_fetch_assoc($query)){
			echo "'".$data['institution']."',";
			}
			?>
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Download'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">Jumlah: </td>' +
            '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
		showInLegend: false, 
		name: '',
        data: [
			<?php
			$query = mysqli_query($link, "SELECT a.institution, c.id, count(*) as jumlah FROM lord_user_contact as a, lord_download_log as b, lord_user_job as c WHERE a.user_id=b.user_id AND a.job=c.id GROUP BY a.job ORDER BY c.id");
			while($data = mysqli_fetch_assoc($query)){
			echo "['".$data['institution']."', ".$data['jumlah']."],";
			}
			?>
		]

    }]
});
		</script>
		<script type="text/javascript">

Highcharts.chart('downloadJob', {
    chart: {
        type: 'column'
    },
	title: {
        text: ''
    },
    xAxis: {
        categories: [
            <?php
			$query = mysqli_query($link, "SELECT c.jobName, c.id FROM lord_user_contact as a, lord_download_log as b, lord_user_job as c WHERE a.user_id=b.user_id AND a.job=c.id GROUP BY a.job ORDER BY c.id");
			while($data = mysqli_fetch_assoc($query)){
			echo "'".$data['jobName']."',";
			}
			?>
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Download'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">Jumlah: </td>' +
            '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
		showInLegend: false, 
		name: '',
        data: [
		<?php
		$query = mysqli_query($link, "SELECT c.jobName, c.id, count(*) as jumlah FROM lord_user_contact as a, lord_download_log as b, lord_user_job as c WHERE a.user_id=b.user_id AND a.job=c.id GROUP BY a.job ORDER BY c.id");
		while($data = mysqli_fetch_assoc($query)){
		echo "['".$data['jobName']."', ".$data['jumlah']."],";
		}
		?>
		]

    }]
});
		</script>