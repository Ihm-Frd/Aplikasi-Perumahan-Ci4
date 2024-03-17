<?php
$db=db_connect();
	$fldtbl=json_decode($dtltbl->tabel);
	$field=array();
	
	if ($kdrjk=='baru'){
		$actionform=base_url("proses/tmbh_data_tbl/".$nmtbl);
		$jdlform="<i class='fa fa-plus-square'></i> Tambah ".$dtltbl->nm_tmp;
		
		foreach ($fldtbl as $k=>$v){
			if($v->ai=='Y'){}else{$field[$k]="";}
		}
	}else{
		$actionform=base_url("proses/ubah_data_tbl/".$nmtbl);
		$jdlform="<i class='fa fa-edit'></i> Ubah ".$dtltbl->nm_tmp;
		
		$whr=array(); $rjk1=$kdrjk;
		//$fdt=explode(';',$rjk1);$n=0;
		//foreach($fldtbl as $k=>$v){if($v->edt!='5'){$whr[$k]=$fdt[$n];}$n++;}
		foreach($fldtbl as $k=>$v){if($v->pk=='Y'){$whr[$k]=$rjk1;}}
		
		$dtbl=$db->table($nmtbl)->where($whr)->get()->getRow();
		
		foreach ($fldtbl as $k=>$v){
			if($v->ai=='Y'){}else{$field[$k]=$dtbl->$k;}
		}
	}
?>
<div class="card card-blue card-outline" style="width:80%">
<form class="form-horizontal" action="<?php echo $actionform?>" method="post" enctype="multipart/form-data">
	<div class="card-header">
		<h3 class="card-title"><?php echo $jdlform?></h3>
		<?php if ($kdrjk=='baru'){}else{?><input type="text" name="rjk1" value="<?php echo $rjk1?>" hidden="hidden"><?php }?>
	</div>
	<div class="card-body"><div class="row">
		<?php 
			foreach ($fldtbl as $k=>$v){
				if($v->ai=='Y'){}else{
					$aw=strpos($v->jns,'('); $ah=strpos($v->jns,')');
					if($aw==null and $ah==null){$jns=$v->jns; $pjg='';}else{
						$jns=substr($v->jns,0,$aw); $pjg=substr($v->jns,$aw+1,$ah-$aw-1);
					}
					if ($v->edt=='1'){$tpe='number';}else
					if ($v->edt=='3'){$tpe='email';}else
					if ($v->edt=='4'){$tpe='password';}else
					if ($v->edt=='5'){$tpe='file';}else{$tpe='text';}
					
					//ganti keterangan label
					if ($k=='jk'){$lb='Jenis Kelamin';}else
					if ($k=='jenis_sub'){$lb='Jenis Subkriteria';}else
					if ($k=='nis'){$lb='NIS';}else
					if ($k=='id'){$lb='ID';}else
					if ($k=='lvl'){$lb='Level';}else
					if ($k=='nik'){$lb='NIK';}else{$lb=$k;}
					//--
					
					if ($v->ref!=''){
						$tblref=json_decode($db->table("master_tbl")->where(["nama_tbl"=>$v->ref->tblr])->get()->getRow()->tabel);
						$tpsl=$v->ref->tmpr;
						foreach($tblref as $k2 => $v2){
							if ($v2->pk=="Y"){$vsl=$k2;}
						}
					}
					
					if ($v->edt=='2'){
						if ($field[$k]!=''){$valtxt=date("d-m-Y",$field[$k]);}else{$valtxt=date("d-m-Y");}
					}else if ($v->edt=='4'){
						$valtxt=desme($field[$k]);
					}else{$valtxt=$field[$k];}?>
			<div class="form-group <?php if ($v->edt=='6' or $pjg>=50){echo "col-sm-12";}else{echo "col-sm-6";}?>" id="dv<?php echo $k?>">
				<label for="<?php echo $k?>" class="control-label"><?php echo ucwords(str_replace('_',' ',$lb))?></label>
				<div>
				<?php if ($v->edt=='7'){?>
					<select class="form-control select2" id="<?php echo $k?>" name="<?php echo $k?>" required="required" style="width: 100%;">
						<option value="">-pilih-</option>
						<?php 
						if ($nmtbl=='tbl_pembayaran' and $v->ref->tblr=='tbl_tp'){$dtt=$db->table($v->ref->tblr)->where(['status'=>'1'])->get()->getResult();}else
						if ($nmtbl=='tbl_pembayaran' and $v->ref->tblr=='tbl_siswa'){
							if ($field[$k]!=''){$dtt=$db->table('tbl_siswa')->where(['nis'=>$field[$k]])->get()->getResult();}
							else{$dtt=$db->table('tbl_siswa')->get()->getResult();/*$this->db->query("select nis,nama from tbl_siswa where nis not in (select siswa from tbl_pembayaran where tp=".$tpa->nomor." and jenis!=3)")->result();*/}
						}else if ($nmtbl=='tbl_pelanggaran' and $v->ref->tblr=='tbl_kelas'){
							$dtt=$db->table($v->ref->tblr)->where(["th_ajaran"=>$tpa->nomor])->get()->getResult();
						}else{$dtt=$db->table($v->ref->tblr)->get()->getResult();}
						
						foreach($dtt as $r3){$rcn=$r3->$tpsl;
						if ($field[$k]==''){?>
							<option value="<?php echo $r3->$vsl?>"><?php echo $rcn?></option>
						<?php }else{?>
							<option value="<?php echo $r3->$vsl?>" <?php if ($r3->$vsl==$field[$k]){echo 'selected';}?>><?php echo $rcn?></option>
						<?php }}?>
					</select>
				<?php }else if ($v->edt=='6'){?>
					<textarea id="<?php echo $k?>" name="<?php echo $k?>" class="form-control textarea" maxlength="<?php echo $pjg?>" required><?php echo $field[$k]?></textarea>
				<?php }else{?>
					<input type="<?php echo $tpe?>" id="<?php echo $k?>" name="<?php echo $k?>" class="form-control <?php if ($v->edt=='2'){echo 'ambltgl';}?>" value="<?php echo $valtxt?>" maxlength="<?php echo $pjg?>" <?php if ($v->edt!='5' or $kdrjk=='baru'){echo "required";}if ($k=='jumlah' or $k=='harga' or $k=='nominal' or $k=='total_bayar'){echo " onkeyup='terbilang(this,`lbl".$k."`)'";}?> placeholder="<?php echo ucwords(str_replace('_',' ',$lb))?>">
					<?php if ($k=='jumlah' or $k=='harga' or $k=='nominal' or $k=='total_bayar'){?><i><span id="lbl<?php echo $k?>"></span></i><?php }?>
				<?php }?>
				</div>
			</div>
		<?php }}?>
	</div></div>
	<div class="card-footer">
		<button type="reset" class="btn btn-default" onclick="history.back()"><i class="fa fa-times"></i> Batal</button>
		<button type="submit" class="btn btn-success float-right"><i class="fa fa-save"></i> Simpan</button>
	</div>
</form>
</div>
<script>
	$(function() {
		$(".ambltgl").daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			locale: {
				format: 'DD-MM-YYYY'
			}
		});
		$(".textarea").wysihtml5();
		$(function () {$(".select2").select2();});
	});
	
	function cksiswa(a,b){
		var r=a.value;
		$.ajax({
			method: "POST",
			data : {r},
			url: "<?php echo base_url('form_bantu/cksiswa')?>"
		}).done(function( msg ) {
			$("#"+b).html(msg);
			$(".select2").select2();
		})
	}
</script>