<?php
include "query_user.php";
if($query_user['level']==1){
	$tampil_sidebar = "none";
} else {
	$tampil_sidebar = "";
	if($query_user['level']==2){
		$admin_manager = "Manager";
	} else {
		$admin_manager = "Admin";
	}
}
?>

<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="data/userprofile/<?php echo $query_user['profpic'];?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $query_user['f_name'] ." ". $query_user['l_name']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
	  <!-- khusus admin -->
	  <ul class="sidebar-menu" style="display:<?php echo $tampil_sidebar; ?>">
        <li class="header">Navigasi <?php echo $admin_manager; ?></li>
        <li class="<?php if(!empty($_GET['p'])){if($_GET['p']=="adm_home"){echo 'active treeview';}};?> ajax">
          <a href="dashboard?p=adm_home">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
          </a>
        </li>
		<li class="<?php if(!empty($_GET['p'])){if($_GET['p']=="adm_addData"){echo 'active treeview';}};?> ajax"><a href="dashboard?p=adm_addData">
            <i class="fa fa-download"></i> <span>Tambah Data</span></i>
          </a>
        </li>
		<li class="<?php if(!empty($_GET['p'])){if($_GET['p']=="profile"){echo 'active treeview';}};?> ajax"><a href="dashboard?p=profile">
            <i class="fa fa-user"></i> <span>Pengguna</span></i>
          </a>
        </li>
      </ul>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Navigasi Pengguna</li>
        <li class="<?php if(empty($_GET['p'])){echo 'active treeview';};?> ajax">
          <a href="dashboard">
            <i class="fa fa-dashboard"></i> <span>Selayang Pandang</span></i>
          </a>
        </li>
		<li class="<?php if(!empty($_GET['p'])){if($_GET['p']=="profile"){echo 'active treeview';}};?> ajax"><a href="dashboard?p=profile">
            <i class="fa fa-user"></i> <span>Profil</span></i>
          </a>
        </li>
		<li class="<?php if(!empty($_GET['p'])){if($_GET['p']=="data_download"){echo 'active treeview';}};?> ajax"><a href="dashboard?p=data_download">
            <i class="fa fa-download"></i> <span>Unduh Data</span></i>
          </a>
        </li>
		<li class="<?php if(!empty($_GET['p'])){if($_GET['p']=="download_history"){echo 'active treeview';}};?> ajax"><a href="dashboard?p=download_history">
            <i class="fa fa-clock-o"></i> <span>Riwayat Unduh</span></i>
          </a>
        </li>
        <li class="<?php if(!empty($_GET['p'])){if($_GET['p']=="contact"){echo 'active treeview';}};?> ajax">
          <a href="dashboard?p=contact">
            <i class="fa fa-envelope"></i> <span>Kontak</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>