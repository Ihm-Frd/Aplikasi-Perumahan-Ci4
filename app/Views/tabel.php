<?php
$db=db_connect();
	$ftbl=json_decode($tabel->tabel);
	$brlnk=base_url('hal/kelola/'.encme($tabel->nama_tbl).'/'.encme('baru'));
?>
<div class="row">
	<div class="col-md-12">
		<div class="card card-blue card-outline">
			<div class="card-body">
			<?php if ($uslvl>=7){?><a class="btn btn-primary float-left" href="<?= $brlnk?>"><i class="fa fa-plus-square"></i> Tambah</a><?php }?>
				<table class="table table-hover table-striped table-sm" id="dtTabel">
					<thead>
					<tr>
						<th>#</th>
						<?php $n=0;foreach ($ftbl as $k => $v){$n++;
							if ($k=='jk'){$lb='Jenis Kelamin';}else
							if ($k=='jenis_sub'){$lb='Jenis Subkriteria';}else
							if ($k=='nis'){$lb='NIS';}else
							if ($k=='id'){$lb='ID';}else
							if ($k=='lvl'){$lb='Level';}else
							if ($k=='nik'){$lb='NIK';}else{$lb=$k;}
							
							if($v->ai=='Y'){}else{?>
						<th><?= ucwords(str_replace('_',' ',$lb))?></th>
						<?php }if($n==7){break;}}?>
						<?php if($tabel->nama_tbl=='tbl_kriteria'){?><th>Aktif</th><?php }?>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php $n=0; foreach($dtbl as $r){$n++;?>
					<tr>
						<td><?= $n?></td>
						<?php $rjk1=''; $nof=0; foreach ($ftbl as $k => $v){$nof++;
							//if ($rjk1==''){$rjk1=$r->$k;}else{$rjk1=$rjk1.';'.$r->$k;}
							$tpkls=null;
							if ($v->pk=='Y'){$rjk1=$r->$k;}
							if ($v->edt=='1'){
								if($k=='jumlah' or $k=='harga' or $k=='total_bayar' or $k=='nominal'){$rcn='Rp. '.number_format($r->$k,0,',','.');}else{$rcn=$r->$k;}
							}else
							if ($v->edt=='2'){$rcn=date('d-m-Y',$r->$k);}else
							if ($v->edt=='4'){if ($uslvl==9){$rcn=desme($r->$k);}else{$rcn='***';}}else
							if ($v->edt=='6'){$rcn=substr($r->$k,0,15).'..';}else
							if ($v->edt=='7'){
								//$rcreftbl=$this->db->field_data($v->ref->tblr);
								$rcreftbl=json_decode($db->table("master_tbl")->where("nama_tbl",$v->ref->tblr)->get()->getRow()->tabel);
								$tpref=$v->ref->tmpr;
								$whr=array();
								foreach($rcreftbl as $kk => $vv){
									if ($vv->pk=='Y'){$whr[$kk]=$r->$k;}
								}
								$dref=$db->table($v->ref->tblr)->where($whr)->get()->getRow();
								$rcn=$dref->$tpref;
								if ($v->ref->tblr=='tbl_kelas'){$rcn=$rcn." (".$this->M_data->data("tbl_tp",array("nomor"=>$dref->th_ajaran))->row()->th_ajaran.")";$tpkls=$dref->th_ajaran;}
							}else{$rcn=$r->$k;}
							if($tabel->nama_tbl=="tbl_alternatif" and $k=="nama"){$rcn="<a href='".base_url('hal/submas/'.encme($rjk1))."'>".$rcn."</a>";}
							if($tabel->nama_tbl=="tbl_kriteria" and $k=="nama_kriteria"){$rcn="<a href='".base_url('hal/mt/'.encme('tbl_subk').'/'.encme($rjk1))."'>".$rcn."</a>";}
							if($v->ai=='Y'){}else{
						?>
						<td><?= $rcn?></td>
						<?php }if($nof==7){break;}}?>
						<?php if($tabel->nama_tbl=='tbl_kriteria'){?>
							<td><input type="checkbox" name="aktif" id="aktif" onchange="gnti(this,'<?= $rjk1?>')" <?php if($r->aktif==1){echo "checked";}?>></td>
						<?php }?>
						<td align="right" width="160px">
							<button type="button" title="Rincian Data" class="btn btn-sm btn-primary pt-0 pb-0" onclick="rincitbl('<?= $tabel->nama_tbl?>','<?= $rjk1?>')"><i class="fa fa-eye"></i></button>
							<?php if($uslvl==9){?>
							<a class="btn btn-sm btn-warning pt-0 pb-0" href="<?= base_url('hal/kelola/'.encme($tabel->nama_tbl).'/'.encme($rjk1))?>"><i class="fa fa-edit"></i></a>
							<button type="button" class="btn btn-sm btn-danger pt-0 pb-0" onclick="hpstbl('<?= $tabel->nama_tbl?>','<?= $rjk1?>')"><i class="fa fa-trash"></i></button>
							<?php }?>
						</td>
					</tr>
					<?php }?>
					</tbody>
				</table>
			</div>
		</div>
		
	</div>
	<div class="clearfix"></div>
</div>
					<!-- Modal -->
					<div id="mBantu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="BantuKelas" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content" id="fbody">
								
							</div>
						</div>
					</div>
					<!-- Modal Hapus -->
					<div id="mHps" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="HapusKelas" aria-hidden="true">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header"><h4><i class="fa fa-question-circle"></i> Konfrmasi..</h4></div>
								<div class="modal-body">
									<h4>Yakin ingin menghapus data ini.?</h4>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Tidak</button>
									<a class="btn btn-outline" href="" id="thps"><i class="fa fa-trash"></i> Hapus</a>
								</div>
							</div>
						</div>
					</div>
<script>
	function rincitbl(a,b){
		$.ajax({
			method: "POST",
			url: "<?= base_url('form_bantu/rinci')?>/"+a+"/"+b
		})
		.done(function( msg ) {
			if (msg!=""){
				$("#fbody").html(msg);
				$("#mBantu").modal({keyboard:false,backdrop:'static'});
			}else{Toast.fire({type:"warning",html:"<b>Gagal Memuat Rincian.!!</b><br>Mohon ulangi beberapa saat lagi.!!"})}
		});
	}
	function gnti(a,b){
		var n=0, al='Non Aktifkan';
		if(a.checked){n=1; al='Aktifkan';}
		$.ajax({
			method: "POST",
			data : {n},
			url: "<?= base_url('proses/prosatu/'.$tabel->nama_tbl)?>/"+b
		})
		.done(function( msg ) {
			if (msg=="Y"){
				Toast.fire({type:"success",html:"<b>Berhasil Mengubah Data.</b><br>Kriteria berhasil di "+al});
			}else{Toast.fire({type:"warning",html:"<b>Gagal Mengubah Data.!!</b><br>Mohon ulangi beberapa saat lagi.!!"})}
		});
	}
	function hpstbl(a,b){
		var r=confirm("Yakin ingin menghapus data ini.??");
		if (r == true) {
		$.ajax({
			method: "POST",
			data : {b},
			url: "<?= base_url('proses/hapus_data_tbl')?>/"+a
		})
		.done(function( msg ) {
			if (msg=='1'){
				Toast.fire({type:"success",html:"<b>Data berhasil dihapus.!!</b><br>Mohon Refresh Halaman.."});
			}else{
				Toast.fire({type:"warning",html:"<b>Data tidak berhasil dihapus.!!</b><br>Dikarenakan masih menjadi referensi di tabel lain.."});
			}
		});
		}
	}
</script>