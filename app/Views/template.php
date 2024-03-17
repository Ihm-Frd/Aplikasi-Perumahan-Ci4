
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $jdlapp?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap4.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css')?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/daterangepicker/daterangepicker.css')?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/summernote/summernote-bs4.css')?>">
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/style.css')?>">

  <link rel="icon" href="<?= base_url('assets/dist/img/ico.png')?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- jQuery -->
  <script src="<?= base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js')?>"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <script>var baseurl = "<?= base_url()?>";</script>
</head>
<body class="hold-transition sidebar-mini layout-fixed" id="appbd">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-blue bg-gradient-blue">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link"><?=strtoupper($set->app_name)?></a></li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('proses/keluar')?>">
          <i class="fas fa-sign-out-alt text-red"></i> Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-blue elevation-4" style="overflow-x: hidden">
    <!-- Brand Logo -->
    <a href="<?= base_url()?>" class="brand-link">
      <img src="<?= base_url('assets/dist/img/ico.png')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text"><marquee><?=strtoupper($set->app_title)?></marquee></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar sidebar-light-blue">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/dist/img/user.png')?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= base_url('hal/mt/'.encme('mst_akun')) ?>" class="d-block"><?= $usnama."<br><small>@ $usname</small>"?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
			<?php
        $aktf = explode('/', uri_string());
        if(!isset($aktf[1])){$aktf[1]='';}
        if(!isset($aktf[2])){$aktf[2]='';}
      ?>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= base_url()?>" class="nav-link <?=($aktf[1]=='')?'active':''?>">
              <i class="nav-icon fas fa-home"></i>
              <p>Home</p>
            </a>
          </li>
          <?php if($uslvl>=5){?>
          <li class="nav-item">
            <a href="<?= base_url('hal/mt/'.encme('tbl_alternatif'))?>" class="nav-link <?=($aktf[2]==encme('tbl_alternatif'))?'active':''?>">
              <i class="nav-icon fas fa-users"></i>
              <p>Data Alternatif</p>
            </a>
          </li>
          <li class="nav-item has-treeview <?=($aktf[2]==encme('tbl_kriteria') || $aktf[2]==encme('tbl_subk'))?'menu-open':''?>">
            <a href="<?= base_url('hal/mt/'.encme('tbl_kriteria'))?>" class="nav-link">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>Kriteria<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('hal/mt/'.encme('tbl_kriteria'))?>" class="nav-link <?=($aktf[2]==encme('tbl_kriteria'))?'active':''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kriteria</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('hal/mt/'.encme('tbl_subk'))?>" class="nav-link <?=($aktf[2]==encme('tbl_subk'))?'active':''?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub Kriteria</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('hal/sub') ?>" class="nav-link <?=($aktf[1]=='sub')?'active':''?>">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>Pembobotan</p>
            </a>
          </li>
          <?php }?>
          <li class="nav-item">
            <a href="<?= base_url('hal/hitung')?>" class="nav-link <?=($aktf[1]=='hitung')?'active':''?>">
              <i class="nav-icon fas fa-hourglass-half"></i>
              <p>Perhitungan</p>
            </a>
          </li>
          <?php if($uslvl>=5){?>
          <li class="nav-header">SETTING</li>
          <li class="nav-item">
            <a href="<?= base_url('hal/setapp')?>" class="nav-link <?=($aktf[1]=='setapp')?'active':''?>">
              <i class="nav-icon fas fa-cog"></i>
              <p>Seting Aplikasi</p>
            </a>
          </li>
          <?php }?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $jdlhal?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <?php foreach($bcb as $r){if ($r['url']!=''){?>
              <li class="breadcrumb-item"><a href="<?= $r['url']?>"><?= $r['jdl']?></a></li>
              <?php }else{?>
              <li class="breadcrumb-item active"><?= $r['jdl']?></li>
              <?php }}?>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid"><?= $contents;?></div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020-<?=date('Y')?> <a href="https://youtube.com/channel/UCyONSVq9Pm84BnIL--niNPA">Sistem Pendukung Keputusan</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      Page rendered in <strong>{elapsed_time}</strong> seconds. (<?=round((memory_get_usage()/1024)/1024)?> MB)
    </div>
  </footer>
</div>
<!-- ./wrapper -->
<!-- Modal -->
<div id="mCf" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="BantuKelas" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content bg-warning">
			<div class="modal-header">
        <h4 class="modal-title" id='ttApp'></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="warnApp"></div>
		</div>
	</div>
</div>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets/plugins/moment/moment.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/daterangepicker/daterangepicker.js')?>"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/plugins/summernote/summernote-bs4.min.js')?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
<!-- FastClick -->
<script src="<?= base_url('assets/plugins/fastclick/fastclick.js')?>"></script>

<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap4.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/dist/js/adminlte.js')?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url('assets/dist/js/pages/dashboard.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/dist/js/demo.js')?>"></script>

<script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 5000
  });

  function GetxhrObject(){
    var xhr=null;
    try {xhr=new XMLHttpRequest();}
    catch (e){
      try {xhr=new ActiveXObject("Msxml2.XMLHTTP");}
      catch (e){xhr=new ActiveXObject("Microsoft.XMLHTTP");}
    }
    return xhr;
  };

  <?php if (isset($_SESSION['alert_psn'])){?>
    Toast.fire({
      type: '<?= $_SESSION['alert_jns']?>',
      html: '<?= $_SESSION['alert_psn']?>'
    });
  <?php }?>
  
  $(function() {$("#dtTabel").DataTable({"lengthChange": false});})
</script>
</body>
</html>
