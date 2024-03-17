<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $jdlapp;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">

  <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/style.css')?>">

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="icon" href="<?= base_url('assets/dist/img/ico.png')?>">
</head>
<body class="hold-transition lockscreen bgalt">
<!-- Automatic element centering -->
<?php
	$logoprof="user.png";
?>
<div class="lockscreen-wrapper loginadm">
  <div class="lockscreen-logo">
    <a href="#" style="color: #111; font-weight: 600;"><b>MASUK SISTEM</b></a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name" id="nmakun"></div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="<?= base_url('assets/dist/img/'.$logoprof)?>" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <div id="fus">
    <div class="lockscreen-credentials">
			<div class="input-group">
				<input type="text" id="user" class="form-control" placeholder="Username.." autocomplete="off">
        <div class="input-group-append">
          <button type="button" class="btn" onclick="login('u')"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
			</div>
		</div>
		</div>
		
		<div id="fpw" hidden="hidden">
		<div class="lockscreen-credentials">
			<div class="input-group">
				<input type="password" id="pw" class="form-control" placeholder="Password..">
        <div class="input-group-append">
          <button type="button" class="btn" onclick="login('p')"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
			</div>
			<input type="checkbox" id="lhtpw" onchange="lhpw(this)" hidden>
    </div>
    </div>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center" id="ketlg" style="color:#555">
    Mohon Masukan Username Anda dengan Benar.
  </div>
	
  <div class="lockscreen-footer text-center">
    <strong>Copyright &copy; 2020 <a href="https://youtube.com/channel/UCyONSVq9Pm84BnIL--niNPA">Sistem Pendukung Keputusan</a>.</strong>
  </div>
</div>
<!-- /.center -->

<!-- jQuery 2.2.0 -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js')?>"></script>

<script>
	const Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 5000
  });

	<?php if (isset($_SESSION['alert_psn'])){?>
		Toast.fire({
      type: '<?= $_SESSION['alert_jns']?>',
      html: '<?= $_SESSION['alert_psn']?>'
    });
	<?php }?>

	function login(a){
		// var xhr		 = GetxhrObject();
		// let formData = new FormData();
		var data,user;
		
		if (a=='u'){
			// formData.append("username", $("#user").val());
			data={"username": $("#user").val()}
		}else{
			// formData.append("username", $("#user").val());
			// formData.append("password", $("#pw").val());
			data={"username": $("#user").val(),"password": $("#pw").val()}
		}
		
		$.ajax({
			method : 'post',
			data : data,
			url : '<?= base_url('proses/valid')?>'+'/'+a,
			success : (res)=>{
				if (a=='u'){
					if (res!='N'){
						$("#fus").attr("hidden","hidden");
						$("#fpw").removeAttr("hidden");
						$("#nmakun").html(res);
						$("#pw").focus();
					}else{
						Toast.fire({
							type: "warning",
							html: "<b>Login GAGAL.!!</b><br>Username yang Anda Masukan tidak Dikenali.!!"
						});
					}
				}else{
					if (res=='Y'){
						location.href="./";
					}else{
						Toast.fire({
							type: "warning",
							html: "<b>Password SALAH.!!</b><br>Password yang Anda Masukan tidak COCOK dengan Username : "+$("#user").val()
						});
					}
				}
			},
			error : (res)=>{Swal.fire('','Gagal Memproses Permintaan.!','error')}
		});
	}

	var enus = document.getElementById("user");
	var enpw = document.getElementById("pw");
	enus.addEventListener("keyup", function(event) {
		// Cancel the default action, if needed
		event.preventDefault();
		if (event.keyCode === 13) {
			login("u");
		}
	});
	enpw.addEventListener("keyup", function(event) {
		// Cancel the default action, if needed
		event.preventDefault();
		if (event.keyCode === 13) {
			login("p");
		}
	});
	$("#user").focus();
</script>
</body>
</html>
