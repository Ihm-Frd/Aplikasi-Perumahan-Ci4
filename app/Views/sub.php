<?php
	$db=db_connect();
?>
<div class="row">
	<div class="col-md-12">
		<div class="card card-blue card-outline">
			<div class="card-header"><h3 class="card-title"><i class="fas fa-clipboard-list"></i> Pembobotan Kriteria dan Alternatf</h3></div>
			<div class="card-body">
				<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="custom-content-below-kriteria-tab" data-toggle="pill" href="#custom-content-below-kriteria" role="tab" aria-controls="custom-content-below-kriteria" aria-selected="true">Nilai Bobot Kriteria</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="custom-content-below-alternatif-tab" data-toggle="pill" href="#custom-content-below-alternatif" role="tab" aria-controls="custom-content-below-alternatif" aria-selected="true">Nilai Bobot Alternatif</a>
					</li>
				</ul>
				<div class="tab-content" id="custom-content-below-tabContent">
					<div class="tab-pane fade show active" id="custom-content-below-kriteria" role="tabpanel" aria-labelledby="custom-content-below-kriteria-tab">
						<div class="card card-default card-outline">
							<div class="card-header">
								<?php if($uslvl>=7){?><button class="btn btn-warning float-right" onclick="resetK()"><i class="fa fa-history"></i> Reset Kriteria</button><?php }?>
							</div>
							<div class="card-body" id="bdkrta"></div>
							<div class="card-footer">
								<button type="button" class="btn btn-primary" onclick="konsis()">Cek Konsistensi Bobot Kriteria</button>
							</div>
						</div>
					</div>
					<div class="tab-pane fade show" id="custom-content-below-alternatif" role="tabpanel" aria-labelledby="custom-content-below-alternatif-tab">
						<div class="card card-default card-outline">
							<div class="card-header">
								<select class="form-control float-left mr-2 mb-2" id="rjkkrta" name="kr" style="width:200px" onchange="pilKrta(this)">
									<option value="">-Pilih kriteria-</option>
									<?php foreach($krta as $r){?>
									<option value="<?= $r->id_kriteria ?>"><?= $r->nama_kriteria ?></option>
									<?php }?>
								</select>
								<?php if($uslvl>=7){?><button class="btn btn-warning float-right" onclick="resetBK()"><i class="fa fa-history"></i> Reset Bobot Kriteria</button><?php }?>
							</div>
							<div class="card-body" id="bdalt"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(function() {
		loadKrta();
	});
	
	function konsis(){
		var hsl;
		$.ajax({
			method:"POST",
			url:baseurl+"/form_bantu/konsistensi",
			success:(msg)=>{
				hsl=parseFloat(msg)*100;
				if(hsl<=10){
					Toast.fire({type:"success",html:"Bobot kriteria ("+hsl+"%) dapat deterima karena masih dibawah 10%"});
				}else{
					Toast.fire({type:"warning",html:"Bobot kriteria ("+hsl+"%) tidak dapat deterima karena melebihi 10%"});
				}
			},
			error:()=>{Toast.fire({type:"error",html:"Gagal memuat permintaan.!!"});}
		})
	}
	function loadKrta(){
		$.ajax({
			method:"POST",
			url:baseurl+"/form_bantu/loadkrta"
		}).done(function( msg ) {$("#bdkrta").html(msg);});
	}
	function loadAlt(a){
		$.ajax({
			method:"POST",
			url:baseurl+"/form_bantu/loadalt/"+a
		}).done(function( msg ) {$("#bdalt").html(msg);});
	}

	function pilKrta(a){
		loadAlt(a.value);
	}

	function edtnil(k1,k2,id){
		id=id.id;
		<?php if($uslvl>=7){?>
			$.ajax({
				url:baseurl+"/form_bantu/edtnil/"+k1+"/"+k2
			}).done(function( msg ) {
				$("#"+id).html(msg);
			});
		<?php }else{?>Toast.fire({type:"warning",html:"<b>Anda tidak di izinkan melakukan perubahan ini.!!"});<?php }?>
	}

	function edtnil2(a1,a2,id){
		//id=id.id;
		<?php if($uslvl>=7){?>
		$.ajax({
			url:baseurl+"/form_bantu/edtnil2/"+a1+"/"+a2
		}).done(function( msg ) {
			//$("#"+id).html(msg);
			id.innerHTML=msg;
		});
		<?php }else{?>Toast.fire({type:"warning",html:"<b>Anda tidak di izinkan melakukan perubahan ini.!!"});<?php }?>
	}

	function modKrta(k1,k2,b){
		b=b.value;
		$.ajax({
			method:"POST",
			data:{k1,k2,b},
			url:baseurl+"/proses/ubahkrta"
		}).done(function( msg ) {
			if(msg=='Y'){
				loadKrta();
				Toast.fire({type:"success",html:"Bobot kriteria berhasil diubah.."});
			}else{Toast.fire({type:"danger",html:"Bobot kriteria tidak berhasil diubah.."});}
		});
	}

	function modAlt(a1,a2,b){
		var kr=$("#rjkkrta").val();
		b=b.value;

		if(kr!=''){
			$.ajax({
				method:"POST",
				data:{kr,a1,a2,b},
				url:baseurl+"/proses/ubahalt"
			}).done(function( msg ) {
				if(msg=='Y'){
					loadAlt(kr);
					Toast.fire({type:"success",html:"Bobot Alternatif berhasil diubah.."});
				}else{Toast.fire({type:"danger",html:"Bobot Alternatif tidak berhasil diubah.."});}
			});
		}else{Toast.fire({type:"warning",html:"Kriteria tidak boleh kosong.!!"});}
	}

	function resetK(){
		$.ajax({
			url:baseurl+"/proses/resetK/"
		}).done(function( msg ) {
			if(msg=='Y'){Toast.fire({type:"success",html:"Kriteria berhasil direset.."});loadKrta();}
			else{Toast.fire({type:"warning",html:"Kriteria tidak berhasil direset..!!"});}
		});
	}

	function resetBK(){
		var kr=$("#rjkkrta").val();
		if (kr!=""){
			$.ajax({
				url:baseurl+"/proses/resetBK/"+kr
			}).done(function( msg ) {
				if(msg=='Y'){Toast.fire({type:"success",html:"Bobot Kriteria berhasil direset.."});loadAlt(kr);}
				else{Toast.fire({type:"warning",html:"Bobot Kriteria tidak berhasil direset..!!"});}
			});
		}else{Toast.fire({type:"warning",html:"Mohon pilih kriteria terlebih dahulu..!!"});}
	}

</script>