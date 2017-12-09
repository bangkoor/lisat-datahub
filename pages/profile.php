<?php
//aktivitas
$username = $query_user['username'];
$user_id = $query_user['user_id'];
//hitung jumlah download
$sql = mysqli_query($link, "SELECT count(distinct data_id) as hitung FROM lord_download_log WHERE user_id='".$user_id."'");
$data_hitung = mysqli_fetch_array($sql);
//lihat download terakhir
$sql = mysqli_query($link, "SELECT date(tanggal_download) as tanggal_download, data_url  FROM lord_download_log as a, lord_data as b WHERE user_id='".$user_id."' AND a.data_id=b.data_id ORDER BY tanggal_download DESC LIMIT 1");
$data_akhir = mysqli_fetch_array($sql);
//lihat data terbaru
$sql2 = mysqli_query($link, "SELECT area_name, data_name, acquisition_date, date(upload_date) as upload_date FROM lord_data ORDER BY upload_date DESC LIMIT 3");
//lihat pekerjaan
$query = mysqli_query($link, "SELECT c.jobName, c.id FROM lord_user_contact as a, lord_download_log as b, lord_user_job as c WHERE a.user_id=b.user_id AND a.job=c.id GROUP BY a.job ORDER BY c.id");
$pekerjaan = mysqli_fetch_array($query);

if(empty($data_akhir)){
	$ada_akhir="hidden";
}

if($query_user['level']==3){
	$level = "Administrator";
} else if($query_user['level']==2){
	$level = "Manager";
} else {
	$level = "Pengguna";
}

if(isset($_POST['submit'])){

	$password 		= @$_POST['password'];
	$prefix 		= @$_POST['prefix'];
	$f_name 		= @$_POST['f_name'];
	$l_name 		= @$_POST['l_name'];
	$job	 		= @$_POST['job'];
	$email 			= @$_POST['email'];
	$institution 	= @$_POST['institution'];
	$address 		= @$_POST['address'];
	$phone 			= @$_POST['phone'];
	
	$queryEdit = mysqli_query($link, "UPDATE lord_user_contact SET prefix='".$prefix."', f_name='".$f_name."', l_name='".$l_name."', job ='".$job."', email='".$email."', institution='".$institution."', address='".$address."', phone='".$phone."' WHERE user_id='".$user_id."';");
	echo "<meta http-equiv='refresh' content='0'>";
}
if(isset($_POST['gantiPassword'])){
	$oldpassword 	= @$_POST['oldpassword'];
	$newpassword 	= @$_POST['newpassword'];
	$newpassword2	= @$_POST['newpassword2'];
	
	$pw_check = mysqli_query($link, "SELECT login_pass FROM lord_user WHERE user_id='".$user_id."'");
	$pw_user = mysqli_fetch_array($pw_check);
	
	if(!empty($oldpassword) && !empty($newpassword) && !empty($newpassword2)){
			if($pw_user['login_pass'] == md5($oldpassword)){
				if($newpassword!=$newpassword2){
					echo '<script type="text/javascript">';
					echo 'setTimeout(function () { swal("No!","Password tidak cocok","warning");';
					echo '});</script>';
				}else{
					$gantiPassword = mysqli_query($link, "UPDATE lord_user SET login_pass='".md5($newpassword)."'");
					echo '<script type="text/javascript">';
					echo 'setTimeout(function () { swal("Yes!","Password berhasil diganti","success");';
					echo '});</script>';
					session_destroy();
				}
			}else{
				echo '<script type="text/javascript">';
				echo 'setTimeout(function () { swal("No!","Password lama tidak cocok","warning");';
				echo '});</script>';
			}
		}else{
			echo '<script type="text/javascript">';
			echo 'setTimeout(function () { swal("","Password tidak diganti","warning");';
			echo '});</script>';
		}
	
}	
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profil Anda
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profil</li>
      </ol>
	  </section>
	  <section class="content">	
	  <div class="row">
        <div class="col-md-4">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="data/userprofile/<?php echo $query_user['profpic'];?>">

              <h3 class="profile-username text-center"><?php echo $query_user['f_name']." ". $query_user['l_name']; ?></h3>

              <p class="text-muted text-center"><?php echo $query_user['institution'];?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Username</b> <a class="pull-right"><?php echo $query_user['username'];?></a>
                </li>
                <li class="list-group-item">
                  <b>Level</b> <a class="pull-right"><?php echo $level; ?></a>
                </li>
				<li class="list-group-item">
                  <b>Pekerjaan</b> <a class="pull-right"><?php echo $pekerjaan['jobName'];?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tentang Saya</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
              <p class="text-muted"><?php echo $query_user['address'];?></p>
              <hr>
              <strong><i class="fa fa-envelope-o margin-r-5"></i> Alamat Email</strong>
				<p class="text-muted"><?php echo $query_user['email'];?></p>
              <hr>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Aktivitas</a></li>
              <li><a href="#settings" data-toggle="tab">Pengaturan Profil</a></li>
			  <li><a href="#password" data-toggle="tab">Ganti Password</a></li>
            </ul>
            <div class="tab-content">
			  <div class="tab-pane" id="password">
				<form class="form-horizontal" id="ganti" action="" enctype="multipart/form-data" method="POST">
				<div class="form-group">
					<div class="col-sm-5">
					  <input type="password" class="form-control" name="oldpassword" placeholder="Password sekarang">
					</div>
                </div>
				<div class="form-group">
					<div class="col-sm-5">
					  <input type="password" class="form-control" name="newpassword" placeholder="Password baru">
					</div>
                </div>
				<div class="form-group">
					<div class="col-sm-5">
					  <input type="password" class="form-control" name="newpassword2" placeholder="Konfirmasi password baru">
					</div>
                </div>
				<div class="form-group">
                    <div class="col-sm-8">
					  <button type="submit" id="ganti" name="gantiPassword" class="btn bg-purple">Ganti</button>
                    </div>
                  </div>
				</form>
			  </div>
              <div class="active tab-pane" id="activity">
				<div class="small-box bg-aqua">
					<div class="inner">
					<small>Anda telah mendownload:</small>
					  <h3><?php echo $data_hitung['hitung']; ?></h3>
					  <p>File Data</p>
					</div>
					<div class="icon">
					  <i class="ion ion-android-download"></i>
					</div>
					<a href="dashboard?p=download_history" class="small-box-footer">Lihat Riwayat <i class="fa fa-arrow-circle-right"></i></a>
				  </div>
				  <div style="visibility:<?php echo $ada_akhir; ?>;">
						<h2>Download terakhir:</h2>
						<h3><strong><?php echo $data_akhir['data_url']; ?></strong></h3>
						pada <?php echo $data_akhir['tanggal_download']; ?>
					</div>
              </div>
              <!-- /.tab-pane -->
              

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" action="" enctype="multipart/form-data" method="POST">
                  <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Username</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" disabled="disabled" name="username" alt="username tidak bisa diganti" value="<?php echo $query_user['username'];?>">
                    </div>
                  </div>
                  <div class="form-group">
					<?php
					$prefix = $query_user['prefix'];
					?>
                    <label for="prefix" class="col-sm-2 control-label">Sapaan</label>

                    <div class="col-sm-10">
                      <div class="radio">
							<label>
							  <input type="radio" name="prefix" id="prefix1" value="Prof." <?php if ($prefix=="Prof."){echo "checked='checked'";}else{echo "";}; ?>>
							  Prof.
							</label>
						  </div>
						  <div class="radio">
							<label>
							  <input type="radio" name="prefix" id="prefix2" value="Dr." <?php if ($prefix=="Dr."){echo "checked='checked'";}else{echo "";}; ?>>
							  Dr.
							</label>
						  </div>
						  <div class="radio">
							<label>
							  <input type="radio" name="prefix" id="prefix3" value="Bapak" <?php if ($prefix=="Bapak"){echo "checked";}else{echo "";}; ?>>
							  Bapak
							</label>
						  </div>
						  <div class="radio">
							<label>
							  <input type="radio" name="prefix" id="prefix4" value="Ibu" <?php if ($prefix=="Ibu"){echo "checked='checked'";}else{echo "";}; ?>>
							  Ibu
							</label>
						  </div>
						  <div class="radio">
							<label>
							  <input type="radio" name="prefix" id="prefix5" value="Nona" <?php if ($prefix=="Nona"){echo "checked='checked'";}else{echo "";}; ?>>
							  Nona
							</label>
						  </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label">Nama Depan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="f_name" value="<?php echo $query_user['f_name'];?>">
                    </div>
				  </div>
				  <div class="form-group">
					<label for="lastname" class="col-sm-2 control-label">Nama belakang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="l_name" value="<?php echo $query_user['l_name'];?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" name="email" value="<?php echo $query_user['email'];?>">
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="institution" class="col-sm-2 control-label">Institusi Asal</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="institution" value="<?php echo $query_user['institution'];?>">
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="job" class="col-sm-2 control-label">Pekerjaan</label>

                    <div class="col-sm-10">
                      <div class="radio">
							<label>
							  <input type="radio" name="job" id="job1" value="2" <?php if ($query_user['job']=="2"){echo "checked='checked'";}else{echo "";}; ?>>
							  Dosen
							</label>
						  </div>
						  <div class="radio">
							<label>
							  <input type="radio" name="job" id="job2" value="1" <?php if ($query_user['job']=="1"){echo "checked='checked'";}else{echo "";}; ?>>
							  Mahasiswa
							</label>
						  </div>
						  <div class="radio">
							<label>
							  <input type="radio" name="job" id="job3" value="3" <?php if ($query_user['job']=="3"){echo "checked";}else{echo "";}; ?>>
							  Peneliti
							</label>
						  </div>
						  <div class="radio">
							<label>
							  <input type="radio" name="job" id="job4" value="4" <?php if ($query_user['job']=="4"){echo "checked='checked'";}else{echo "";}; ?>>
							  Lainnya
							</label>
						  </div>
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="institution" class="col-sm-2 control-label">Nomor Telepon</label>

                    <div class="col-sm-10">
                      <input type="text" pattern="[0-9]*" class="form-control" name="phone" value="<?php echo $query_user['phone'];?>">
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="address" class="col-sm-2 control-label">Alamat Lengkap</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" rows="5" name="address"><?php echo $query_user['address'];?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" name="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>