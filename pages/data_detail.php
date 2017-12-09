<?php
require_once("./plugins/cipher/Cipher.php");
$data_id = $_GET['data_id'];

$sql = mysqli_query($link, "SELECT data_id, area_name, data_name, acquisition_date, data_size, data_url FROM lord_data WHERE data_id='".$data_id."'");
$data = mysqli_fetch_array($sql);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Detail
		<small><?php echo $data['data_name'] ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="dashboard?p=data_download">Data Download</a></li>
		<li class="active">Data Detail <?php echo $data['data_name'] ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="box box-primary">
        <div class="box-body">
          <div class="row">
			<div class="col-md-4">
				<div class="box box-solid">
					<div class="box-header with-border">
					  <i class="fa fa-tag"></i>

					  <h3 class="box-title">Deskripsi</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
					  <dl>
						<dt>Area</dt>
						<dd><?php echo $data['area_name']; ?></dd>
						<dt>Area Spesifik</dt>
						<dd><?php echo $data['data_name']; ?></dd>
						<dt>Tanggal Akuisisi</dt>
						<dd><?php echo $data['acquisition_date'] ?></dd>
						<dt>Ukuran File</dt>
						<dd><?php echo $data['data_size'] ?> GB</dd>
						
					  </dl>
					</div>
					<!-- /.box-body -->
				</div>
				<div align="right" style="margin:10px;">
				<a href="download.php?data_id=<?php echo $data['data_id']; ?>"><button type='button' class='btn btn-success btn-sm'>Download</button></a>
				<a href="dashboard?p=data_download"><button type='button' class='btn btn-gray btn-sm'>Kembali</button></a>
				</div>
			</div>
            <div class="col-md-8">
				<div id="map" class="map" style="height:400px;"></div>
			</div>
		  </div>
		</div>
		</div>
	</section>
</div>
<script>
		window.addEventListener("load", func1);
var map;

function func1() {
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: {
      lat: 0,
      lng: 0
    }
  });
  // Set the stroke width, and fill color for each polygon
  var featureStyle = {
    fillColor: '#ADFF2F',
    fillOpacity: 0.1,
    strokeColor: '#ADFF2F',
    strokeWeight: 1
  };

  // zoom to show all the features
  var bounds = new google.maps.LatLngBounds();
  map.data.addListener('addfeature', function(e) {
    processPoints(e.feature.getGeometry(), bounds.extend, bounds);
    map.fitBounds(bounds);
  });

  // zoom to the clicked feature
  map.data.addListener('click', function(e) {
    var bounds = new google.maps.LatLngBounds();
    processPoints(e.feature.getGeometry(), bounds.extend, bounds);
    map.fitBounds(bounds);
  });
  //Load mapdata via geoJson
  map.data.loadGeoJson('maps/<?php echo $data_id ?>.json');
}

function processPoints(geometry, callback, thisArg) {
  if (geometry instanceof google.maps.LatLng) {
    callback.call(thisArg, geometry);
  } else if (geometry instanceof google.maps.Data.Point) {
    callback.call(thisArg, geometry.get());
  } else {
    geometry.getArray().forEach(function(g) {
      processPoints(g, callback, thisArg);
    });
  }
}
	</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABi8h0OxhjvxG2jvHPkGnr2D4poJjUWFY&callback=initMap">
		</script>