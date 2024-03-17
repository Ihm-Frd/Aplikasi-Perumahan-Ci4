<div class="row">
	<div class="col-md-12">
		<div class="card card-default card-outline">
			<?php 
			$dkrta=[]; $dalt=[];
			// if(file_exists("hasil-ahp.json")){
				// $hsl=json_decode(file_get_contents("hasil-ahp.json"));
			if(isset($dhsl->nomor)){
				$hsl=json_decode($dhsl->hasil);
				$n=1; $bg=['','primary','green','warning','danger'];
				$ttg=0;
				foreach($alt as $r){$dalt[$r->id]=$r->nama;}
			?>
				<div class="card-header">
					<div class="input-group float-right" style="width: 360px;">
						<input type="text" name="tglrange" id="tglrange" class="form-control tgl" value="<?=date('01-m-Y - d-m-Y')?>">
						<span class="input-group-append">
							<button class="btn btn-info" onclick="proahp()" id="btnhit"><i class="fa fa-hourglass-half"></i> Hitung Ulang AHP</button>
						</span>
					</div>
					<h3 class="card-title"><i class="fas fa-clipboard-list"></i> Hasil Perhitungan AHP (<?=date('d-m-Y',$dhsl->tanggal)?>)</h3>
				</div>
				<div class="card-body row">
					<div class="col-sm-12" id="ctkahp">
						<table class="table table-striped" width="100%" style="font-size: 1.1em;">
							<thead>
								<tr align="left">
									<th>Rangking</th><th>Nama Alternatif</th>
									<th>Nilai</th><th>Persentase</th><th>Keterangan</th>
								</tr>
							</thead>
							<tbody id="bdtbl">
								<?php foreach($hsl as $k=>$v){$ttg=($ttg < $v)?$v:$ttg;
									$nil=$v/$ttg; $kom=($nil==1)?0:2;
								?>
								<tr align="left">
									<td><?=$n++?></td>
									<td onclick="rnchsl('<?=$k?>','<?=$v?>','<?=$nil?>')" style="cursor: pointer;" title="Klik untuk melihat rincian per alternatif"><?=$k?></td>
									<th><?=number_format($v,4,',','.')?></th>
									<th><?=number_format(($nil)*100,$kom,',','.')?>%</th>
									<th><?=($nil>=$set->persentase_diterima/100)?'<span class="badge badge-success"><i class="fa fa-check-square"></i> Diterima</span>':'<i class="fa fa-times"></i> Ditolak'?></th>
								</tr>
								<?php }?>
							</tbody>
						</table>
						<div class="callout callout-warning">
							<h5 class="text-orange"><i class="fas fa-bullhorn"></i> CATATAN :</h5><hr>
							<ol class="pl-3">
								<li>Persentase didapat dari nilai saat ini dibagi dengan nilai tertinggi</li>
								<li>Jika persentase lebih dari (>) <?=$set->persentase_diterima?>% maka Keterangan akan diterima, jika tidak maka akan ditolak.</li>
							</ol>
						</div>
					</div>
					<!-- <div class="col-sm-6">
						<p class="text-center"><strong>Persentase Berdasarkan Nilai Tertinggi</strong></p>
						<div class="card"><div id="grafahp" class="card-body">
							<php $n=1;foreach($hsl as $k=>$v){if($n<=4){$abg=$bg[$n];}else{$abg='secondary';}$n++;?>
							<div class='progress-group'><=$k?><span class='float-right'><b><=number_format($v*100,2,',','.')?>%</b></span><div class='progress progress-sm'><div class='progress-bar bg-gradient-<=$abg?>' style='width: <=number_format($v*100,2)?>%'></div></div>
							<php }?>
						</div></div>
					</div> -->
				</div>
				<div class="card-footer">
					<div class="input-group" style="width: 420px;">
						<select name="tglhitung" id="tglhitung" class="form-control">
							<?php foreach($htg as $r){
								echo "<option value='{$r->nomor}'>".date('d-m-Y H:i',$r->tanggal)."</option>";
							}?>
						</select>
						<span class="input-group-append">
							<button type='button' onclick='cetak()' class='btn btn-info'><i class='fa fa-print'></i> Cetak Hasil Perhitungan</button>
						</span>
					</div>
					<button type='button' onclick='rinci()' class='btn bg-gradient-danger float-right'><i class='fa fa-info-circle'></i> Lihat Rincian</button>
				</div>
			<?php }else{?>
				<div class="card-body">
					<center>
						<div class="input-group" style="width: 360px;">
							<input type="text" name="tglrange" id="tglrange" class="form-control tgl" value="<?=date('01-m-Y - d-m-Y')?>">
							<span class="input-group-append">
								<button class="btn bg-primary" onclick="proahp()" id="btnhit"><i class="fa fa-hourglass-half"></i> Hitung AHP</button>
							</span>
						</div>
					</center>
				</div>
			<?php }?>
		</div>
	</div>
</div>

<div class="modal fade" id="mRinci" style="font-size: 1.3em;">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">
					<i class="fa fa-info-circle"></i> RINCIAN PERHITUNGAN AHP
				</h3>
			</div>
			<div class="modal-body">
				<table class="table table-sm table-striped" id="tblRinci">
					<thead>
					<tr>
						<th>#</th><th>Alternatif</th>
						<?php foreach($krta as $r){echo "<th>{$r->nama_kriteria}</th>";}?>
						<th>Total</th>
					</tr>
					</thead>
					<tbody>
					<?php if(isset($dhsl->nomor)){$n=1; $trt=[];
						foreach(json_decode($dhsl->rinci) as $k=>$v){$tt=0;
							echo "
							<tr>
								<td>".($n++)."</td>
								<td>{$dalt[$k]}</td>";
								foreach($v as $k2=>$v2){
									echo "<td>".number_format($v2,4)."</td>";
									$tt+=$v2;
									$trt[$k2][0]=(isset($trt[$k2][0]))?(($v2>$trt[$k2][0])?$v2:$trt[$k2][0]):$v2;
									$trt[$k2][1]=(isset($trt[$k2][1]))?(($v2<$trt[$k2][1])?$v2:$trt[$k2][1]):$v2;
								}
							echo "<td>".number_format($tt,4)."</td></tr>";
							$trt['tt'][0]=(isset($trt['tt'][0]))?(($tt>$trt['tt'][0])?$tt:$trt['tt'][0]):$tt;
							$trt['tt'][1]=(isset($trt['tt'][1]))?(($tt<$trt['tt'][1])?$tt:$trt['tt'][1]):$tt;
						}
					}?>
					</tbody>
					<?php if(isset($trt)){if(count($trt)>0){?>
					<tfoot>
						<tr>
							<td colspan="2">
								Tertingi <i class="fa fa-arrow-alt-circle-up text-success"></i><br>
								Terendah <i class="fa fa-arrow-alt-circle-down text-danger"></i>
							</td>
							<?php foreach($krta as $r){
								echo "<td><span class='badge badge-success badge-pill'>".number_format($trt[$r->id_kriteria][0],4)."</span><br>
								<span class='badge badge-danger badge-pill'>".number_format($trt[$r->id_kriteria][1],4)."</span></td>";
							}
							echo "<td><span class='badge badge-success badge-pill'>".number_format($trt['tt'][0],4)."</span><br>
							<span class='badge badge-danger badge-pill'>".number_format($trt['tt'][1],4)."</span></td>";?>
						</tr>
					</tfoot>
					<?php }}?>
				</table>
			</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>

<div class="modal fade" id="mRnchsl" style="font-size: 1.1em;">
	<div class="modal-dialog">
		<div class="modal-content" id="mBdy"></div>
	</div>
</div>

<script>
	$(function() {
		$(".table").dataTable();
		$(".tgl").daterangepicker({locale:{format: 'DD-MM-YYYY'}})
	});
	//$("#appbd").addClass("sidebar-collapse");
	function cetak(){
		// var width = window.innerWidth * 0.75 ;
		// var height = width * window.innerHeight / window.innerWidth ;
		// window.open('<php echo base_url('hal/cetak')?>', 'newwindow', 'width=' + width + ', height=' + height + ', top=' + ((window.innerHeight - height) / 2) + ', left=' + ((window.innerWidth - width) / 2))
		
		// var divToPrint=$("#ctkahp").html();
		$.ajax({
			url : baseurl+"/form_bantu/ctkhsl/"+$("#tglhitung").val(),
			success : (res)=>{
				newWin= window.open("");
				newWin.document.write(res);
				newWin.print();
				newWin.close();
			},
			error : (res)=>{Swal.fire('','Gagal Memproses Permintaan.!','error')}
		});
	}

	function proahp(){
		var isbt=$("#btnhit").html();
		$("#btnhit").html("<i class='fa fa-circle-notch fa-spin'></i> Memproses Perhitungan SPK");
		$("#btnhit").addClass('disable');
		$.ajax({
			method:"POST",
			data:{tgl:$("#tglrange").val()},
			url:baseurl+"/form_bantu/ahp/",
			success: function( msg ) {
				$("#btnhit").html(isbt);
				$("#btnhit").removeClass('disable');
				if(msg=='Y'){
					Toast.fire({type:"success",html:"Perhitungan Selesai"});
					// .then(()=>{location.reload();});
					setTimeout(()=>{location.reload();},2000);
				}else{
					Toast.fire({type:"warning",html:"Perhitungan gagal..!!<br>Mohon ulangi beberapa saat lagi.."});
				}
			},
			error: ()=>{
				Swal.fire('Gagal.!!','Perhitungan Gagal.!!','error');
				$("#btnhit").html(isbt);
				$("#btnhit").removeClass('disable');
			}
		});
	}

	function rinci() {
		$("#mRinci").modal();
	}

	function rnchsl(nm,v,p){
		Swal.fire({
			title:'Mengambil data..',
			allowOutsideClick: false,
			onOpen : ()=>{Swal.showLoading()},
			showConfirmButton:false
		});
		$.ajax({
			method : 'post',
			data : {nm,v,p},
			url : baseurl+"/form_bantu/rnchsl",
			success : (res)=>{
				Toast.fire('','Data berhasil diambil..','success');
				$("#mBdy").html(res)
				$("#mRnchsl").modal()
			},
			error : (res)=>{Swal.fire('','Gagal Memproses Permintaan.!','error')}
		});
	}
</script>