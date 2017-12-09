<?php

//lihat data terbaru
$sql2 = mysqli_query($link, "SELECT area_name, data_name, acquisition_date, date(upload_date) as upload_date FROM lord_data ORDER BY upload_date DESC LIMIT 3");

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Overview
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Overview</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
		<div class="col-lg-12 col-xs-12">
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">3 Data Terbaru</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
				<?php
						while($data = mysqli_fetch_assoc($sql2)){
							 echo "
							 <li class='item'>
							  <div class='product-img'>
								<img src='dist/img/default-50x50.gif' alt='Product Image'>
							  </div>
							  <div class='product-info'>
								<a href='' class='product-title'>".$data['data_name']."<span class='label label-success pull-right'>".$data['area_name']."</span></a>
									<span class='product-description'>
									  Tanggal Akuisisi: ".$data['acquisition_date']."</br>
									  Tersedia sejak: ".$data['upload_date']."
									</span>
							  </div>
							</li>";
						}
				?>
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="dashboard?p=data_download" class="uppercase">Lihat semua</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
		
        </div>
        
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li><a href="#tab_2-2" data-toggle="tab">Spesifikasi Teknis</a></li>
			  <li class="active"><a href="#tab_1-1" data-toggle="tab">Sejarah</a></li>
              <li class="pull-left header"><i class="fa fa-th"></i> Sekilas Satelit LAPAN-IPB</li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1-1">
                Pada tanggal 22 Juni 2016, satelit LAPAN-A3/IPB telah berhasil diluncurkan dari Sriharikota, India menggunakan roket peluncur PSLV-C34.<br/><br/> 
				Satelit ini merupakan satelit mikro yang dibuat dan dikembangkan di Indonesia, yang memiliki berat 115 kilogram, dan membawa misi penginderaan jauh eksperimental untuk memantau sumberdaya pangan. Selain itu, satelit ini juga mengemban misi pemantauan kapal laut.<br/><br/>
				Muatan pengindera satelit LAPAN-A3/IPB yang berupa 4 bands multispectral imager dengan resolusi 18 m dan swath 100 km. Sejak akhir tahun 2016, data satelit LAPAN-A3/IPB ini telah dapat diterima di Stasiun Bumi-Ranca Bungur, Bogor, Indonesia.<br/><br/>
				Dalam kaitannya dengan pemanfaatan data LAPAN-A3/IPB ini, dapat dilakukan berbagai penelitian terkait pengembangan algoritma dan penelitian aplikasi di berbagai bidang seperti bidang pertanian, kehutanan, klimatologi, perikanan dan kelautan. 
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-2">
                <table class="table table-bordered table-striped">
					<tbody>
						<tr>
							<td>
									Spacecraft dimensions
							</td>
							<td >
									50 cm x 57.4 cm x 42.4 cm
							</td>
						</tr>
						<tr>
							<td>
									Spacecraft mass
							</td>
							<td >
									~ 115 kg
							</td>
						</tr>
						<tr>
							<td>
									EPS (Electric Power Subsystem)
							</td>
							<td >
									- 5 GaAs solar arrays @ 46.5 cm x 26.2 cm, 30 cells in series; max power of 37 (BOL)<br />
									- 3 packs of Li-ion batteries, 4 cells per pack, 15 V nominal voltage, 6.1 Ah capacity
							</td>
						</tr>
						<tr>
							<td>
									OBDH (On-Board Data Handling) Subsystem
							</td>
							<td >
									- The OBC is a 32 bit RISC processor with 128/256 MB internal memory, 1 MB external static RAM, and 1 MB external flash memory
							</td>
						</tr>
						<tr>
							<td>
									ADCS (Attitude Determination and Control Subsystem)
							</td>
							<td >
									- 3 wheels/fiber optic laser gyros in orthogonal configuration<br />
									- 2 Star sensors (1 CCD and 1 CMOS)<br />
									- 3 magnetic coils<br />
									- 6 single solar cells for sun sensors<br />
									- 3-axis magnetometers
							</td>
						</tr>
						<tr>
							<td>
									RF Communications
							</td>
							<td>
									- 2 UHF TT&amp;Cs, frequency = 437.425 MHz, modulation = FFSK, 3.5 W RF output power<br />
									- X-band, frequency = 8200 MHz, data rate = 105 Mbit/s, 6 W max RF output power<br />
									- S-band, frequency = 2220 MHz, 3.5 W max RF output power
								
									- HDRM (High Data Rate Modem) for simulation experiments
							</td>
						</tr>
						<tr>
							<td>
									MSI (Multispectral Imager)
							</td>
							<td>
									- 300 mm lens<br/>
									- 8002 x 4 pixel array<br/>
									- 12 bit digitization<br/>
									- Landsat filter for the bands: 0.45-0.52 µm (blue); 0.52-0.60 µm (green): 0.63-0.69 µm (red); 0.76-0.90 µm (NIR)<br/>
									- Ground resolution = 19 m<br/>
									- Swath width = 100 km<br/>
							</td>
						</tr>
						<tr>
							<td>
									DSC (Digital Space Camera)
							</td>
							<td>
									- A CCD imager with a 1000 mm lens<br/>
									- 2000 x 2000 pixel array<br/>
									- Ground resolution of 5 m<br/>
									- Swath width = 10 km<br/>
							</td>
						</tr>
					</tbody>
				</table>
			  </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box -->
          <div class="box box-solid bg-light-blue-gradient">
            <div class="box-header">

              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
				  <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
				  <li data-target="#carousel-example-generic" data-slide-to="4" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="assets/images/carousel/lapan-a3-1.jpg" alt="First slide">

                    <div class="carousel-caption">
                      
                    </div>
                  </div>
                  <div class="item">
                    <img src="assets/images/carousel/lapan-a3-2.jpg" alt="Second slide">

                    <div class="carousel-caption">
                      
                    </div>
                  </div>
                  <div class="item">
                    <img src="assets/images/carousel/lapan-a3-3.jpg" alt="Third slide">

                    <div class="carousel-caption">
                      
                    </div>
                  </div>
				  <div class="item">
                    <img src="assets/images/carousel/lapan-a3-4.jpg" alt="Third slide">

                    <div class="carousel-caption">
                     
                    </div>
                  </div>
				  <div class="item">
                    <img src="assets/images/carousel/lapan-a3-5.jpg" alt="Third slide">

                    <div class="carousel-caption">
                      
                    </div>
                  </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>

          

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->