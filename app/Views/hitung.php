<?php
	$db=db_connect();
?>
<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
	<li class="nav-item">
		<a class="nav-link" id="cc-krta-tab" data-toggle="pill" href="#cc-krta" role="tab" aria-controls="cc-krta" aria-selected="true">Mengukur Konsistensi Kriteria</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="cc-alt-tab" data-toggle="pill" href="#cc-alt" role="tab" aria-controls="cc-alt" aria-selected="true">Matriks Perbandingan Alternatif</a>
	</li>
	<li class="nav-item">
		<a class="nav-link active" id="cc-hsl-tab" data-toggle="pill" href="#cc-hsl" role="tab" aria-controls="cc-hsl" aria-selected="true">Hasil Akhir</a>
	</li>
</ul>
<div class="tab-content" id="cc-tabContent">
	<div class="tab-pane fade show" id="cc-krta" role="tabpanel" aria-labelledby="cc-krta-tab">
<?php
// $krta=$this->M_data->data("tbl_kriteria",array('aktif'=>1))->result();
$tot=[]; $prts=[]; $jml=[];
$ri=array(0.00,0.00,0.58,0.90,1.12,1.24,1.32,1.41,1.45,1.49,1.51,1.48,1.56,1.57,1.59);

echo "<div class='card card-blue card-outline'><div class='card-header'><h3 class='card-title'>Matriks Perbandingan Kriteria</h3></div><div class='card-body'>";
echo "<table class='table table-bordered table-striped'><tr><th>Kriteria</th>";
foreach($krta as $r){echo "<th>".$r->nama_kriteria." (K".$r->id_kriteria.")</th>";$tot[$r->id_kriteria]=0;};
echo "</tr>";
foreach($krta as $r){echo "<tr><td>".$r->nama_kriteria."</td>";
	foreach($krta as $r2){
		$dt=$db->table("tbl_bobotk")->where(["kriteria1"=>$r->id_kriteria,"kriteria2"=>$r2->id_kriteria])->get()->getRow();
		if(isset($dt->bobot)){$bb=$dt->bobot;echo "<td>".number_format($bb,2)."</td>";}else{$bb=0;echo "<td>0</td>";}
		$tot[$r2->id_kriteria]=$tot[$r2->id_kriteria]+$bb;
	}
	echo "</tr>";
}
echo "<tr><th><span title='Penjumlah tiap kolom yang bersangkutan'>Jumlah</span></th>";
foreach($krta as $r){echo "<th class='text-blue'>".number_format($tot[$r->id_kriteria],2)."</th>";};
echo "</tr></table></div></div>";

echo "<div class='card card-default card-outline'><div class='card-header'><h3 class='card-title'>Matriks Bobot Prioritas Kriteria</h3></div><div class='card-body'><p>Setiap sel pada tabel Matriks Perbandingan Kriteria dibagi dengan jumlah pada kolom yang bersangkutan, hingga menghasilkan sbb :</p><table class='table table-bordered table-striped'><tr><th>Kriteria</th>";
foreach($krta as $r){echo "<th>K".$r->id_kriteria."</th>";};
echo "<th><span title='Penjumlahan nilai tiap baris / total kriteria'>Bobot Prioritas</span></th></tr>";
foreach($krta as $r){echo "<tr><td>K".$r->id_kriteria."</td>";$jum=0;$n=0;
	foreach($krta as $r2){$n++;
		$dt=$db->table("tbl_bobotk")->where(["kriteria1"=>$r->id_kriteria,"kriteria2"=>$r2->id_kriteria])->get()->getRow();
		if(isset($dt->bobot)){$bb=$dt->bobot/$tot[$r2->id_kriteria];echo "<td>".number_format($bb,2)."</td>";}else{$bb=0;echo "<td>0</td>";}
		$jum=$jum+$bb;
	}
	$prts[$r->id_kriteria]=$jum/$n;
	echo "<th class='text-blue'>".number_format($jum/$n,2)."</th></tr>";
}
echo "</table></div></div>";

echo "<div class='card card-blue card-outline'><div class='card-header'><h3 class='card-title'>Menghitung Rasio Konsistensi</h3></div><div class='card-body'><p>1. Melakukan perkalian antara Matriks Perbandingan Kriteria (Tabel 1) dan Bobot Prioritas (Tabel 2)</p><div class='row'><div class='col-sm-6'><table class='table table-bordered table-striped'><tr><th></th>";
foreach($krta as $r){echo "<th>K".$r->id_kriteria." (".number_format($prts[$r->id_kriteria],2).")</th>";};
echo "</tr>";
foreach($krta as $r){echo "<tr><td>K".$r->id_kriteria."</td>";
	foreach($krta as $r2){
		$dt=$db->table("tbl_bobotk")->where(["kriteria1"=>$r->id_kriteria,"kriteria2"=>$r2->id_kriteria])->get()->getRow();
		if(isset($dt->bobot)){$bb=$dt->bobot;echo "<td>".number_format($bb,2)."</td>";}else{$bb=0;echo "<td>0</td>";}
	}
	echo "</tr>";
}
echo "</table></div><div class='col-sm-6'><table class='table table-bordered table-striped'><tr><th></th>";
foreach($krta as $r){echo "<th>K".$r->id_kriteria."</th>";};
echo "<th>Jumlah</th></tr>";
foreach($krta as $r){echo "<tr><td>K".$r->id_kriteria."</td>";$jum=0;
	foreach($krta as $r2){
		$dt=$db->table("tbl_bobotk")->where(["kriteria1"=>$r->id_kriteria,"kriteria2"=>$r2->id_kriteria])->get()->getRow();
		if(isset($dt->bobot)){$bb=$dt->bobot*$prts[$r2->id_kriteria];echo "<td>".number_format($bb,2)."</td>";}else{$bb=0;echo "<td>0</td>";}
		$jum=$jum+$bb;
	}
	$jml[$r->id_kriteria]=$jum;
	echo "<td class='text-blue'>".number_format($jum,2)."</td></tr>";
}
echo "</table></div></div><br><p>2. Nilai penjumlahan sel (Tabel 4) dibagi dengan nilai masing-masing sel pada Bobot Prioritas (Tabel 2)</p><table><tr><td width='10px' class='bl'></td><td>";
foreach ($krta as $r) {echo number_format($jml[$r->id_kriteria],2)."<br>";}
echo "</td><td width='10px' class='br'></td><td width='20px' align='center'>:</td><td width='10px' class='bl'></td><td>";
foreach ($krta as $r) {echo number_format($prts[$r->id_kriteria],2)."<br>";}
echo "</td><td width='10px' class='br'></td><td width='20px' align='center'>=</td><td width='10px' class='bl'></td><td>";
foreach ($krta as $r) {echo number_format($jml[$r->id_kriteria]/$prts[$r->id_kriteria],2)."<br>";}
echo "</td><td width='10px' class='br'></td></tr></table><br><br><p>3. Mencari nilai Eigen Maksimum (λ <sub>maks</sub>)</p><blockquote class='quote-primary'><b>λ <sub>maks</sub> = (";
$jeig=0;$eig="";
foreach ($krta as $r) {$eig = $eig.number_format($jml[$r->id_kriteria]/$prts[$r->id_kriteria],2)." + ";$jeig=$jeig+($jml[$r->id_kriteria]/$prts[$r->id_kriteria]);}
$eigmax=$jeig/$n;
echo trim($eig," + ").")/".$n." = ".number_format($eigmax,2)."</b></blockquote><br><br><p>4. Hitung nilai Consistency Index (CI)</p><blockquote class='quote-primary'><b>CI = (λ <sub>maks</sub> - n) / n - 1<br>CI = (".number_format($eigmax,2)." - ".$n.") / (".$n." - 1) = ".number_format(($eigmax-$n)/($n-1),2)."</b></blockquote><br><br><p>5. Hitung nilai Consistency Ratio (CR) berdasarkan nilai Random Index (RI)</p><table class='table table-striped table-bordered'><tr align='center' valign='middle'><th rowspan='2' valign='middle'>RI</th>";
$ci=($eigmax-$n)/($n-1);
foreach ($ri as $k => $v) {if(($k+1)==$n){echo "<th class='bg-green'>".($k+1)."</th>";}else{echo "<th>".($k+1)."</th>";}}
echo "</tr><tr align='center'>";
foreach ($ri as $k => $v) {if(($k+1)==$n){echo "<td class='bg-green'>".$v."</td>";}else{echo "<td>".$v."</td>";}}
$rasio=$ci/$ri[$n-1];
if($rasio>0.1){$kt="tidak dapat diterima karena lebih besar";}else{$kt="dapat diterima karena lebih kecil";}
echo "</tr></table><br><p><blockquote class='quote-primary'><b>CR = CI / RI<br>CR = ".number_format($ci,2)." / ".($ri[$n-1])." = ".number_format($rasio,4)."</b></blockquote></p><br>Nilai <b>".number_format($rasio,4)."</b> ini menyatakan bahwa rasio konsistensi dari hasil penilaian pembandingan di atas mempunyai rasio <b>".(number_format($rasio,4)*100)."%</b>. Sehingga penilaian di atas<b> $kt </b>dari 10% (Saaty).";

echo "</div></div>";
?>
	</div>
	<div class="tab-pane fade show" id="cc-alt" role="tabpanel" aria-labelledby="cc-alt-tab">
<?php
// $krta=$this->M_data->data("tbl_kriteria",array('aktif'=>1))->result();
// $alt=$this->M_data->data("tbl_siswa")->result();
$mpa=[];

foreach ($krta as $r) {
	$tot=[];
	echo "<div class='card card-blue card-outline'><div class='card-header'><h3 class='card-title'>Matriks Perbandingan Alternatif berdasarkan Kriteria (<b>".$r->nama_kriteria."</b>)</h3></div><div class='card-body'><div class='row'>";
	echo "<div class='col-sm-12'><table class='table table-bordered table-striped'><tr><th width='15%'></th>";
	foreach($alt as $r2){echo "<th width='15%'>".$r2->nama."</th>";$tot[$r2->id]=0;}
	echo "<th></th></tr>";
	foreach($alt as $r2){echo "<tr><td>".$r2->nama."</td>";
		foreach($alt as $r3){
			$dt=$db->table("tbl_bobotalt")->where(["kriteria"=>$r->id_kriteria,"alternatif1"=>$r2->id,"alternatif2"=>$r3->id])->get()->getRow();
			if(isset($dt->bobot)){$bb=$dt->bobot;echo "<td>".number_format($bb,2)."</td>";}else{$bb=0;echo "<td>0</td>";}
			$tot[$r3->id]=$tot[$r3->id]+$bb;
		}
		echo "</tr>";
	}
	echo "<tr><th><span title='Penjumlah tiap kolom yang bersangkutan'>Jumlah</span></th>";
	foreach($alt as $r2){echo "<th class='text-blue'>".number_format($tot[$r2->id],2)."</th>";};
	echo "</tr></table></div>";

	echo "<div class='col-sm-12'><table class='table table-bordered table-striped'><tr><th width='15%'></th>";
	foreach($alt as $r2){echo "<th width='15%'>".$r2->nama."</th>";};
	echo "<th><span title='Penjumlahan nilai tiap baris / total Alternatif'>Bobot</span></th></tr>";
	foreach($alt as $r2){echo "<tr><td>".$r2->nama."</td>";$jum2=0;$n2=0;
		foreach($alt as $r3){$n2++;
			$dt=$db->table("tbl_bobotalt")->where(["kriteria"=>$r->id_kriteria,"alternatif1"=>$r2->id,"alternatif2"=>$r3->id])->get()->getRow();
			if(isset($dt->bobot)){$bb=$dt->bobot/$tot[$r3->id];echo "<td>".number_format($bb,2)."</td>";}else{$bb=0;echo "<td>0</td>";}
			$jum2=$jum2+$bb;
		}
		$mpa[$r2->id][$r->id_kriteria]=$jum2/$n2;
		echo "<th class='text-blue'>".number_format($jum2/$n2,2)."</th></tr>";
	}
	echo "</tr></table></div>";
	echo "</div></div></div>";
}
?>
	</div>
	<div class="tab-pane fade show active" id="cc-hsl" role="tabpanel" aria-labelledby="cc-hsl-tab">
		<div class='card card-blue card-outline'>
			<div class='card-header'>
				<h3 class='card-title'>Perhitungan Bobot Prioritas Kriteria dan Bobot Alternatif</h3>
			</div>
			<div class='card-body'>
				<p>Setelah menemukan bobot dari masing-masing kriteria terhadap alternatif yang sudah ditentukan, langkah selanjutnya adalah mengalikan bobot prioritas kriteria dengan bobot dari masing-masing alternatif, kemudian hasil perkalian tersebut dijumlahkan perbaris. Sehingga didapatkan total prioritas global seperti pada tabel berikut.</p>

				<div class="row" id="ctkhsl">
					<div class="col-sm-12">
						<table class="table table-bordered table-striped" border="1" width='100%'><tr><th width='15%'></th>
						<?php $hsl=[]; $smpl=[];
						foreach ($krta as $r){echo "<th width='15%'>K".$r->id_kriteria." (".number_format($prts[$r->id_kriteria],2).")</th>";}echo "<th></th></tr><tr>";
						foreach ($alt as $r) {
							echo "<th>".$r->nama."</th>";
							foreach ($krta as $r2) {
								echo "<td>".number_format($mpa[$r->id][$r2->id_kriteria],2)."</td>";
								$hsl[$r->id][$r2->id_kriteria]=$mpa[$r->id][$r2->id_kriteria]*$prts[$r2->id_kriteria];
							}echo "</tr>";
						}?>
						</table>
					</div><br>
					<div class='col-sm-12'>
						<table class='table table-bordered table-striped' border="1" width='100%'><tr><th width='15%'></th>
						<?php
						foreach ($krta as $r){echo "<th width='15%'>K".$r->id_kriteria."</th>";}
						echo "<th>Nilai</th></tr><tr>";
						foreach ($alt as $r) {$tot=0;
							echo "<th>".$r->nama."</th>";
							foreach ($krta as $r2) {
								echo "<td>".number_format($hsl[$r->id][$r2->id_kriteria],2)."</td>";
								$tot=$tot+$hsl[$r->id][$r2->id_kriteria];
							}echo "<th class='text-blue'>".number_format($tot,2)."</th></tr>";
							$smpl[$r->nama]=$tot;
						}arsort($smpl);?>
						</table>
					</div><br>
					<div class='col-md-5 mt-3'>
						<h3>Perangkingan :</h3>
						<table class='table table-bordered table-striped' border="1" width='100%'><tr><th>Nama</th><th>Nilai</th><th>Rangking</th></tr>
						<?php $ra=0;
						foreach ($smpl as $k => $v) {$ra++;
							if($ra==1){$bg="bg-gold";}else if($ra==2){$bg="bg-silver";}else if($ra==3){$bg="bg-brown";}else{$bg="";}
							echo "<tr class='$bg'><td>".$k."</td><td>".number_format($v,2)."</td></td><td align='center'>".$ra."</td></tr>";
						}?>
						</table>
					</div>
					<div class="col-md-7 mt-3">
						<p class="text-center"><strong>Grafik Hasil Perhitungan AHP</strong></p>
						<div class="card">
							<div id="grafahp" class="card-body">
								<?php $n=1; $bg=['','primary','green','warning','danger'];
								foreach($smpl as $k=>$v){
									if($n<=4){$abg=$bg[$n];}else{$abg='secondary';}$n++;?>
									<div class='progress-group'>
										<?=$k?>
										<span class='float-right'>
											<b><?=number_format($v*100,2,',','.')?>%</b>
										</span>
										<div class='progress progress-sm'>
											<div class='progress-bar bg-<?=$abg?>' style='width: <?=number_format($v*100,2)?>%'></div>
										</div>
									</div>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button type='button' onclick='cetak()' class='btn bg-gradient-blue'><i class='fa fa-print'></i> Cetak Hasil Perhitungan</button>
			</div>
		</div>
	</div>

<script>
	$("#appbd").addClass("sidebar-collapse");
	function cetak(){
      var printContents = document.getElementById('ctkhsl').innerHTML;
		var width = window.innerWidth * 0.75 ;
		var height = width * window.innerHeight / window.innerWidth ;
		var ctkWin = window.open('<?php echo base_url('hal/cetak')?>', 'newwindow', 'width=' + width + ', height=' + height + ', top=' + ((window.innerHeight - height) / 2) + ', left=' + ((window.innerWidth - width) / 2))
      printContents=printContents.replace(/table table-bordered table-striped/g,"");
		ctkWin.onload = function(){
			ctkWin.document.getElementById('tctk').innerHTML = printContents;
			ctkWin.window.print();
		}
	}
</script>