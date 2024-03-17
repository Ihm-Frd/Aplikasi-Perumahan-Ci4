<?php
namespace App\Controllers;
	
class Form_bantu extends BaseController {
	function rinci($nmtbl,$rjk){
		$uslvl = desme(session(encme("UserLvl")));
		$usid = desme(session(encme("UserID")));
		$whr=[];
		$fldtbl=json_decode($this->db->table('master_tbl')->where('nama_tbl',$nmtbl)->get()->getRow()->tabel);
		//$jdlform=$fldtbl->nm_tmp;
		foreach($fldtbl as $k=>$v){if($v->pk=='Y'){$whr[$k]=$rjk;}}
		
		$data=$this->db->table($nmtbl)->where($whr)->get()->getRow();
		?>
		<div class="card card-default">
			<div class="card-header"><h3 class="box-title">Rincian Data</h3></div>
			<div class="card-body" id="bodyrinci">
				<table class="table table-striped">
					<tr><th colspan="2">Detail</th></tr>
					<?php foreach($fldtbl as $k=>$v){
						if ($k=='jk'){$lb='Jenis Kelamin';}else
						if ($k=='jenis_sub'){$lb='Jenis Subkriteria';}else
						if ($k=='nis'){$lb='NIS';}else
						if ($k=='lvl'){$lb='Level';}else
						if ($k=='id'){$lb='id';}else{$lb=ucwords(str_replace('_',' ',$k));}
						
						if ($v->edt=='1'){
							if($k=='jumlah' or $k=='harga' or $k=='total_harga' or $k=='total_bayar' or $k=='nominal'){$rcn='Rp. '.number_format($data->$k,0,',','.');}else{$rcn=$data->$k;}
						}else
						if ($v->edt=='2'){$rcn=date('d-m-Y',$data->$k);}else
						if ($v->edt=='4'){if ($uslvl==9){$rcn=desme($data->$k);}else{$rcn='***';}}else
						if ($v->edt=='6'){$rcn=$data->$k;}else
						if ($v->edt=='7'){
							//$rcreftbl=$this->db->field_data($v->ref->tblr);
							$rcreftbl=json_decode($this->db->table("master_tbl")->where(["nama_tbl"=>$v->ref->tblr])->get()->getRow()->tabel);
							$tpref=$v->ref->tmpr;
							$whr=[];
							foreach($rcreftbl as $kk => $vv){
								if ($vv->pk=='Y'){$whr[$kk]=$data->$k;}
							}
							$dref=$this->db->table($v->ref->tblr)->like($whr)->get()->getRow();
							$rcn=$dref->$tpref;
							if ($v->ref->tblr=='tbl_kelas'){$rcn=$rcn." (".$this->db->table("tbl_tp")->where(["nomor"=>$dref->th_ajaran])->get()->getRow()->th_ajaran.")";}
						}else{$rcn=$data->$k;}
					?>
					<tr>
						<td><?= $lb?></td>
						<td>: <?= $rcn?></td>
					</tr>
					<?php }?>
				</table>
			</div>
			<div class="card-footer"><button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button></div>
		</div>
		<?php
	}

	function loadalt($rjk){
		$alt=$this->db->table("tbl_alternatif")->get()->getResult();
		$tot=[]; $prsn = floor(100/(count($alt)+1));
		echo "<table class='table table-bordered table-striped'><tr><th>Alternatif</th>";
		foreach($alt as $r){echo "<th width='$prsn%'>".$r->nama."</th>";$tot[$r->id]=0;};
		echo "</tr>";
		foreach($alt as $r){echo "<tr><td>".$r->nama."</td>";
			foreach($alt as $r2){
				$dt=$this->db->table("tbl_bobotalt")->where(["kriteria"=>$rjk,"alternatif1"=>$r->id,"alternatif2"=>$r2->id])->get()->getRow();
				if(isset($dt->bobot)){
					$bb=$dt->bobot;
				}else{
					$bb=0;
					$dtsubmas1=$this->db->table("tbl_submas")->where(['id'=>$r->id,'kriteria'=>$rjk])->get()->getRow();
					$dtsubmas2=$this->db->table("tbl_submas")->where(['id'=>$r2->id,'kriteria'=>$rjk])->get()->getRow();
					if(isset($dtsubmas1->bobot) and isset($dtsubmas2->bobot)){$bb=$dtsubmas1->bobot/$dtsubmas2->bobot;}
					$this->db->table("tbl_bobotalt")->insert(["kriteria"=>$rjk,"alternatif1"=>$r->id,"alternatif2"=>$r2->id,"bobot"=>$bb]);
				}
				echo "<td ondblclick='edtnil2(`".$r->id."`,`".$r2->id."`,this)' class='".(($r->id==$r2->id)?'bg-blue':'')."'>".number_format($bb,2)."</td>";
				$tot[$r2->id]=$tot[$r2->id]+$bb;
			}
			echo "</tr>";
		}
		echo "<tr><th><span title='Penjumlah tiap kolom yang bersangkutan'>Jumlah</span></th>";
		foreach($alt as $r){echo "<th class='text-blue'>".number_format($tot[$r->id],2)."</th>";};
		echo "</tr></table>";
	}

	function loadkrta(){
		$krta=$this->db->table("tbl_kriteria")->where('aktif','1')->get()->getResult();
		$tot=[]; $prsn = floor(100/(count($krta)+1));
		echo "<div><center><h4>Matriks Perbandingan Kriteria</h4></center></div><table class='table table-bordered table-striped'><tr><th>Kriteria</th>";
		foreach($krta as $r){echo "<th width='$prsn%'>".$r->nama_kriteria." (K".$r->id_kriteria.")</th>";$tot[$r->id_kriteria]=0;};
		echo "</tr>";
		foreach($krta as $r){echo "<tr><td>".$r->nama_kriteria."</td>";
			foreach($krta as $r2){
				$dt=$this->db->table("tbl_bobotk")->where(["kriteria1"=>$r->id_kriteria,"kriteria2"=>$r2->id_kriteria])->get()->getRow();
				if(isset($dt->bobot)){
					$bb=$dt->bobot;
				}else{
					$bb=0;
					if($r->bobot!=0 and $r2->bobot!=0){$bb=$r->bobot/$r2->bobot;}
					$this->db->table("tbl_bobotk")->insert(["kriteria1"=>$r->id_kriteria,"kriteria2"=>$r2->id_kriteria,"bobot"=>$bb]);
				}
				echo "<td id='pbb".$r->id_kriteria.$r2->id_kriteria."' ondblclick='edtnil(`".$r->id_kriteria."`,`".$r2->id_kriteria."`,this)' class='".(($r->id_kriteria==$r2->id_kriteria)?'bg-blue':'')."'>".number_format($bb,2)."</td>";
				$tot[$r2->id_kriteria]=$tot[$r2->id_kriteria]+$bb;
			}
			echo "</tr>";
		}
		echo "<tr><th><span title='Penjumlah tiap kolom yang bersangkutan'>Jumlah</span></th>";
		foreach($krta as $r){echo "<th class='text-blue'>".number_format($tot[$r->id_kriteria],2)."</th>";};
		echo "</tr></table>";
	}

	function edtnil($k1,$k2){
		?>
		<select class="form-control" onchange="modKrta('<?=$k1?>','<?=$k2?>',this)" style="width: 100%">
			<option value="0">-pilih-</option>
			<option value="1">1 - Sama penting dengan</option>
			<option value="2">2 - Mendekati lebih penting dari</option>
			<option value="3">3 - Lebih penting dari</option>
			<option value="4">4 - Mendekati jelas lebih penting dari</option>
			<option value="5">5 - Jelas lebih penting dari</option>
			<option value="6">6 - Mendekati sangat jelas lebih penting dari</option>
			<option value="7">7 - Sangat jelas lebih penting dari</option>
			<option value="8">8 - Mendekati mutlak dari</option>
			<option value="9">9 - Mutlak lebih penting dari</option>
		</select>
		<?php
	}

	function edtnil2($a1,$a2){
		?>
		<select class="form-control" onchange="modAlt('<?=$a1?>','<?=$a2?>',this)" style="width: 100%">
			<option value="0">-pilih-</option>
			<option value="1">1 - Sama penting dengan</option>
			<option value="2">2 - Mendekati lebih penting dari</option>
			<option value="3">3 - Lebih penting dari</option>
			<option value="4">4 - Mendekati jelas lebih penting dari</option>
			<option value="5">5 - Jelas lebih penting dari</option>
			<option value="6">6 - Mendekati sangat jelas lebih penting dari</option>
			<option value="7">7 - Sangat jelas lebih penting dari</option>
			<option value="8">8 - Mendekati mutlak dari</option>
			<option value="9">9 - Mutlak lebih penting dari</option>
		</select>
		<?php
	}

	function konsistensi($tp=null){
		$krta=$this->db->table("tbl_kriteria")->where('aktif','1')->get()->getResult();
		$tot=[]; $prts=[]; $jml=[];
		$ri=[0.00,0.00,0.58,0.90,1.12,1.24,1.32,1.41,1.45,1.49,1.51,1.48,1.56,1.57,1.59];

		foreach($krta as $r){$tot[$r->id_kriteria]=0;};
		foreach($krta as $r){
			foreach($krta as $r2){
				$dt=$this->db->table("tbl_bobotk")->where(["kriteria1"=>$r->id_kriteria,"kriteria2"=>$r2->id_kriteria])->get()->getRow();
				if(isset($dt->bobot)){$bb=$dt->bobot;}else{$bb=0;}
				$tot[$r2->id_kriteria]=$tot[$r2->id_kriteria]+$bb;
			}
		}
		foreach($krta as $r){$jum=0;$n=0;
			foreach($krta as $r2){$n++;
				$dt=$this->db->table("tbl_bobotk")->where(["kriteria1"=>$r->id_kriteria,"kriteria2"=>$r2->id_kriteria])->get()->getRow();
				if(isset($dt->bobot)){$bb=$dt->bobot/$tot[$r2->id_kriteria];}else{$bb=0;}
				$jum=$jum+$bb;
			}
			$prts[$r->id_kriteria]=$jum/$n;
		}
		foreach($krta as $r){$jum=0;
			foreach($krta as $r2){
				$dt=$this->db->table("tbl_bobotk")->where(["kriteria1"=>$r->id_kriteria,"kriteria2"=>$r2->id_kriteria])->get()->getRow();
				if(isset($dt->bobot)){$bb=$dt->bobot*$prts[$r2->id_kriteria];}else{$bb=0;}
				$jum=$jum+$bb;
			}
			$jml[$r->id_kriteria]=$jum;
		}
		$jeig=0;$eig="";
		if($n>2){
			foreach ($krta as $r) {$jeig=$jeig+($jml[$r->id_kriteria]/$prts[$r->id_kriteria]);}
			$eigmax=$jeig/$n;
			$ci=($eigmax-$n)/($n-1);
			$rasio=$ci/$ri[$n-1];
			if($tp=='prts'){return $prts;}else{echo number_format($rasio,4);}
		}else{echo "Jumlah kriteria harus lebih dari 2.!!";}
	}
	
	// Proses SPK AHP
	function ahp(){
		$rg=explode(' - ',$this->request->getPost('tgl'));
		$tgl1=(isset($rg[0]))?strtotime($rg[0]):0;
		$tgl2=(isset($rg[1]))?strtotime($rg[1]):time();

		$krta=$this->db->table("tbl_kriteria",array('aktif'=>1))->get()->getResult();
		$alt=$this->db->table("tbl_alternatif")->where(['tgl_input >= '=>$tgl1,'tgl_input < '=>$tgl2+86400])->get()->getResult();
		$mpa=[];
		
		// Proses membaca seluruh kriteria
		foreach ($krta as $r) {
			$tot=[];
			foreach($alt as $r2){$tot[$r2->id]=0;};
			
			foreach($alt as $r2){$jum2=0;$n2=0;
				foreach($alt as $r3){$n2++;
					$dt=$this->db->table("tbl_bobotalt")->where(["kriteria"=>$r->id_kriteria,"alternatif1"=>$r2->id,"alternatif2"=>$r3->id])->get()->getRow();
					if(isset($dt->bobot)){$bb=$dt->bobot;}else{$bb=0;}
					$tot[$r3->id]=$tot[$r3->id]+$bb;
					//if($dt->num_rows()>0){$bb2=$dt->row()->bobot/$tot[$r3->id];}else{$bb2=0;}
					//$jum2=$jum2+$bb2;
				}
				//$mpa[$r2->id][$r->id_kriteria]=$jum2/$n2;
			}
			foreach($alt as $r2){$jum2=0;$n2=0;
				foreach($alt as $r3){$n2++;
					$dt=$this->db->table("tbl_bobotalt")->where(["kriteria"=>$r->id_kriteria,"alternatif1"=>$r2->id,"alternatif2"=>$r3->id])->get()->getRow();
					if(isset($dt->bobot)){$bb=$dt->bobot/$tot[$r3->id];}else{$bb=0;}
					$jum2=$jum2+$bb;
				}
				$mpa[$r2->id][$r->id_kriteria]=$jum2/$n2;
			}
		}

		$hsl=[]; $smpl=[]; $prts=$this->konsistensi('prts');
		foreach ($alt as $r) {
			foreach ($krta as $r2) {
				$hsl[$r->id][$r2->id_kriteria]=$mpa[$r->id][$r2->id_kriteria]*$prts[$r2->id_kriteria];
			}
		}
		foreach ($alt as $r) {$tot=0;
			foreach ($krta as $r2) {
				$tot=$tot+$hsl[$r->id][$r2->id_kriteria];
			}
			$smpl[$r->nama]=$tot;
		}
		arsort($smpl);
		// file_put_contents('hasil-ahp.json',json_encode($smpl));
		$this->db->table('tbl_hasil')->insert(['tanggal'=>time(),'hasil'=>json_encode($smpl),'rinci'=>json_encode($hsl)]);
		echo "Y";
	}
	
	function rnchsl(){
		$pos=$this->request->getPost();
		$alt=$this->db->table('tbl_alternatif')->where(['nama'=>$pos['nm']])->get()->getRow();
		$kom=($pos['p']==1)?0:2;
		?>
		<div class="modal-header"><h4 class="modal-title">Rincian Hasil Alternatif</h4></div>
		<div class="modal-body">
			<table class="table table-sm table-striped">
				<tr>
					<td>ID</td><th><?=$alt->id?></th>
				</tr>
				<tr>
					<td>Nama</td><th><?=$alt->nama?></th>
				</tr>
				<tr>
					<td>Tanggal Input</td><th><?=date('d-m-Y',$alt->tgl_input)?></th>
				</tr>
				<tr>
					<td>Hasil SPK</td>
					<th><?=number_format($pos['v'],4,',','.').' ('.number_format(($pos['p'])*100,$kom,',','.')?>%)</th>
				</tr>
				<tr>
					<td>Keterangan</td>
					<th>
						<?=($pos['p']>=0.7)?'<span class="badge badge-success"><i class="fa fa-check-square"></i> Diterima</span>':'<i class="fa fa-times"></i> Ditolak'?>
					</th>
				</tr>
			</table>
		</div>
		<?php
	}

	function ctkhsl($no){
		$dt=$this->db->table('tbl_hasil')->where(['nomor'=>$no])->get()->getRow();
		$ttg=0; $hsl=json_decode($dt->hasil); $n=1;
		?>
		<center><h4>HASIL PERHITUNGAN<br><?=strtoupper($this->set->app_name)?><br>TANGGAL : <?=date('d-m-Y',$dt->tanggal)?></h4></center>
		<table border="1" cellpadding="3" cellspacing="0" width="100%">
			<thead>
				<tr align="left">
					<th>Rangking</th><th>Nama Alternatif</th>
					<th>Nilai</th><th>Persentase</th><th>Keterangan</th>
				</tr>
			</thead>
			<tbody id="bdtbl">
				<?php foreach($hsl as $k=>$v){$ttg=($ttg < $v)?$v:$ttg;
					$nil=$v/$ttg; $kom=($nil==1)?0:2;
					$alt=$this->db->table('tbl_alternatif')->where(['nama'=>$k])->get()->getRow();
				?>
				<tr align="left">
					<td><?=$n++?></td>
					<td><?=$k?></td>
					<th><?=number_format($v,4,',','.')?></th>
					<th><?=number_format(($nil)*100,$kom,',','.')?>%</th>
					<th><?=($nil>=$this->set->persentase_diterima/100)?'<span style="color:green">Diterima</span>':'<span style="color:maroon">Ditolak</span>'?></th>
				</tr>
				<?php }?>
			</tbody>
		</table>
		<div class="callout callout-warning">
			<h5 class="text-orange"><i class="fas fa-bullhorn"></i> CATATAN :</h5><hr>
			<ol class="pl-3">
				<li>Persentase didapat dari nilai saat ini dibagi dengan nilai tertinggi</li>
				<li>Jika persentase lebih dari (>) <?=$this->set->persentase_diterima?>% maka Keterangan akan diterima, jika tidak maka akan ditolak.</li>
			</ol>
		</div>
		<?php
	}
}