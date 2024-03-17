<?php $db=db_connect()?>
<div class="row">
	<div class="col-md-12">
		<div class="card card-blue card-outline">
			<div class="card-header"><h3 class="card-title"><i class="fas fa-clipboard-list"></i> <?=$jdlhal.' (<i>'.$dmas->nama.'</i>)'?></h3></div>
			<div class="card-body">
				<table class="table"><tr><th>Kriteria</th><th colspan="2">Bobot</th></tr>
				<?php foreach($tblk as $r){
					$idk=$r->id_kriteria;
					$dtbl=$db->table('tbl_submas')->where(["id"=>$dmas->id,"kriteria"=>$idk])->get()->getRow();
				?>
					<tr>
						<td width="30%"><?=$r->nama_kriteria?></td>
						<td width="25%">
							<select class="form-control" onchange="gantiv(this.value,'<?=$dmas->id?>','<?=$idk?>')">
								<option value="0">-pilih-</option>
								<?php foreach($db->table('tbl_subk')->where(['kriteria'=>$idk])->get()->getResult() as $r2){?>
									<option value="<?=$r2->bobot?>" <?php if(isset($dtbl->id)){if($r2->bobot==$dtbl->bobot){echo "selected";}}?>><?=$r2->nama_sub?></option>
								<?php }?>
							</select>
						</td>
						<td id="td<?=$idk?>b"><?php if(isset($dtbl->bobot)){echo $dtbl->bobot;}?></td>
					</tr>
				<?php }?>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	function gantiv(v,id,idk){
		<?php if($uslvl>=7){?>
		$.ajax({
			method:"POST",
			data:{v,idk,id},
			url:baseurl+"/proses/ubahdmas",
			success:(msg)=>{
				if(msg=='Y'){
					Toast.fire({type:"success",html:"Bobot kriteria berhasil diubah.."});
					$("#td"+idk+"b").html(v);
				}else{Toast.fire({type:"error",html:"Bobot kriteria tidak berhasil diubah.."});}
			},
			error:()=>{Toast.fire({type:"error",html:"Gagal memuat permintaan.!!"});}
		})
		<?php }else{?>Toast.fire({type:"warning",html:"<b>Anda tidak di izinkan melakukan perubahan ini.!!"});<?php }?>
	}
</script>