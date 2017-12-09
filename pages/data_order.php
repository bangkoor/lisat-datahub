
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Order
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Download</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	<div class="row">
        <div class="col-md-12">
		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Informasi Request Data</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
				<div class="form-group">
					<label>Area of Interest (AOI) Tekstual</label>
					<input name="aoi_teks" type="text" class="form-control" id="email" placeholder="Kab. Bogor, Prov. Jabar" required>
					<span class="help-block">Nama Kabupaten dan Provinsi</span>
				</div>
				<div class="form-group">
					<label>Area of Interest (AOI) Spasial</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-map-marker"></i>
						</div>
						<input name="aoi_spa" id="aoi_spa" type="file" class="file" data-preview-file-type="text" required>
					</div>
					<span class="help-block">Mohon upload file AOI dalam format .zip atau .rar berisi file .shp, .shx, .prj, dan .dbf</span>
				</div>
				<div class="form-group">
					<label>Tanggal awal akuisisi</label>
					<div class="input-group">
					  <div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					  </div>
					  <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
					</div>
				</div>
				<div class="col-md-4">
				</div>
				<div class="col-md-4" align="center">
					<input type="submit" name="tambah" value="Submit" class="btn btn-primary"/>
				</div>
				<div class="col-md-4">
				</div>
			</div>
		  </div>
		</div>
		</div>
		</div>
	</div>
</section>
</div>