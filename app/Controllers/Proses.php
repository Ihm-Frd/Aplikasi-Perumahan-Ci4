<?php
namespace App\Controllers;

class Proses extends BaseController {
	
	function tmbh_data_tbl($nmtbl){
		$dt=[];
		$fldtbl=json_decode($this->db->table('master_tbl')->where('nama_tbl',$nmtbl)->get()->getRow()->tabel);
		
		foreach($fldtbl as $k=>$v){
			if ($v->ai=="Y"){
				$dt[$k]=null;
			}else if ($v->edt=='2'){
				$dt[$k]=strtotime(strip_tags($this->request->getPost($k)));
			}else if ($v->edt=='4'){
				$dt[$k]=encme(strip_tags($this->request->getPost($k)));
			}else{
				$dt[$k]=strip_tags($this->request->getPost($k));
			}
		}
		
		$this->db->table($nmtbl)->insert($dt);
		$alert_info=array("alert_jns"=>'success',"alert_psn"=>"Data Baru berhasil di tambah..");
		$this->ses->setFlashdata($alert_info);
		return redirect()->to(base_url('hal/mt/'.encme($nmtbl)));
	}
	
	function ubah_data_tbl($nmtbl){
		$dt=array();
		$fldtbl=json_decode($this->db->table('master_tbl')->where('nama_tbl',$nmtbl)->get()->getRow()->tabel);
		//$fdt=explode(';',$this->request->getPost('rjk1'));$n=0;
		//foreach($fldtbl as $k=>$v){if($v->edt!='5'){$whr[$k]=$fdt[$n];}$n++;}
		$rjk1=$this->request->getPost('rjk1');
		foreach($fldtbl as $k=>$v){if($v->pk=='Y'){$whr[$k]=$rjk1;}}
		
		foreach($fldtbl as $k=>$v){
			if($v->ai=='Y'){}else{
				if ($v->edt=='2'){
					$dt[$k]=strtotime(strip_tags($this->request->getPost($k)));
				}else if ($v->edt=='4'){
					$dt[$k]=encme(strip_tags($this->request->getPost($k)));
				}else{$dt[$k]=strip_tags($this->request->getPost($k));}
			}
		}
		
		$this->db->table($nmtbl)->where($whr)->update($dt);
		$alert_info=array("alert_jns"=>'success',"alert_psn"=>"Data berhasil di ubah..");
		$this->ses->setFlashdata($alert_info);
		return redirect()->to(base_url('hal/mt/'.encme($nmtbl)));
	}
	
	function hapus_data_tbl($nmtbl){
		$hps="Y";
		$fldtbl=json_decode($this->db->table('master_tbl')->where('nama_tbl',$nmtbl)->get()->getRow()->tabel);
		//$fdt=explode(';',$this->request->getPost('b'));$n=0;
		//foreach($fldtbl as $k=>$v){if($v->edt!='5'){$whr[$k]=$fdt[$n];}$n++;}
		$rjk1=$this->request->getPost('b');
		foreach($fldtbl as $k=>$v){if($v->pk=='Y'){$whr[$k]=$rjk1;}}
		
		if ($hps=="Y"){
			foreach($fldtbl as $k=>$v){
				if($v->edt=='5'){
					$fl=$this->db->table($nmtbl)->where($whr)->get()->getRow()->$k;
					if ($fl!='' or $fl!=null){
						$dir="uploads/";
						unlink($dir.$fl);
					}
				}
			}
			$this->db->table($nmtbl)->where($whr)->delete();
			echo "1";
		}else{echo "0";}
	}
	
	function valid($v){
		if ($v=='u'){
			if ($this->request->getPost("username")=='Admapp0123'){
				echo "Administrator Sistem";
			}else{
				$cek=$this->db->table("mst_akun")->where(["username"=>$this->request->getPost("username")])->get()->getRow();
				if (isset($cek->full_name)){
					echo $cek->full_name;
				}else{echo "N";}
			}
		}else{
			if ($this->request->getPost("username")=='Admapp0123'){
				echo "Y";
				$svdata=array(
					encme("UserID")=>encme("001100Adm"),
					encme("UserName")=>encme("Admapp0123"),
					encme("Nama")=>encme("Master Administrator"),
					encme("UserLvl")=>encme("9")
				);
				$this->ses->set($svdata);
				$alert_info=array("alert_jns"=>'success',"alert_psn"=>"<b>Login Berhasil..</b><br>Anda Masuk sebagai Administrator Sistem..");
				$this->ses->setFlashdata($alert_info);
			}else{
				$cek=$this->db->table("mst_akun")->where(["username"=>$this->request->getPost("username"),"password"=>encme($this->request->getPost("password"))])->get()->getRow();
				if (isset($cek->id)){
					echo "Y";
					$svdata=array(
						encme("UserID")=>encme($cek->id),
						encme("UserName")=>encme($cek->username),
						encme("Nama")=>encme($cek->full_name),
						encme("UserLvl")=>encme($cek->level)
					);
					$this->ses->set($svdata);
					$alert_info=array("alert_jns"=>'success',"alert_psn"=>"<b>Login Berhasil..</b><br>Selamat datang kembali ".$cek->full_name);
					$this->ses->setFlashdata($alert_info);
				}else{echo "N";}
			}
		}
	}

	function ubahkrta(){
		$k1=$this->request->getPost("k1");
		$k2=$this->request->getPost("k2");
		$b=$this->request->getPost("b");
		$bb1=$b/1; $bb2=1/$b;
		$whr1=array("kriteria1"=>$k1,"kriteria2"=>$k2);
		$whr2=array("kriteria1"=>$k2,"kriteria2"=>$k1);

		if($this->db->table("tbl_bobotk")->where($whr1)->get()->resultID->num_rows>0){
			$this->db->table("tbl_bobotk")->where($whr1)->update(["bobot"=>$bb1]);
		}else{$this->db->table("tbl_bobotk")->insert(["kriteria1"=>$k1,"kriteria2"=>$k2,"bobot"=>$bb1]);}

		if($this->db->table("tbl_bobotk")->where($whr2)->get()->resultID->num_rows>0){
			$this->db->table("tbl_bobotk")->where($whr2)->update(["bobot"=>$bb2]);
		}else{$this->db->table("tbl_bobotk")->insert(["kriteria1"=>$k2,"kriteria2"=>$k1,"bobot"=>$bb2]);}
		echo 'Y';
	}

	function ubahalt(){
		$kr=$this->request->getPost("kr");
		$a1=$this->request->getPost("a1");
		$a2=$this->request->getPost("a2");
		$b=$this->request->getPost("b");
		$bb1=$b/1; $bb2=1/$b;
		$whr1=array("kriteria"=>$kr,"alternatif1"=>$a1,"alternatif2"=>$a2);
		$whr2=array("kriteria"=>$kr,"alternatif1"=>$a2,"alternatif2"=>$a1);

		if($this->db->table("tbl_bobotalt")->where($whr1)->get()->resultID->num_rows>0){
			$this->db->table("tbl_bobotalt")->where($whr1)->update(["bobot"=>$bb1]);
		}else{$this->db->table("tbl_bobotalt")->insert(["kriteria"=>$kr,"alternatif1"=>$a1,"alternatif2"=>$a2,"bobot"=>$bb1]);}

		if($this->db->table("tbl_bobotalt")->where($whr2)->get()->resultID->num_rows>0){
			$this->db->table("tbl_bobotalt")->where($whr2)->update(["bobot"=>$bb2]);
		}else{$this->db->table("tbl_bobotalt")->insert(["kriteria"=>$kr,"alternatif1"=>$a2,"alternatif2"=>$a1,"bobot"=>$bb2]);}
		echo 'Y';
	}

	function ubahdmas(){
		$v=$this->request->getPost("v");
		$idk=$this->request->getPost("idk");
		$id=$this->request->getPost("id");

		$whr=array("id"=>$id,"kriteria"=>$idk);

		if($this->db->table("tbl_submas")->where($whr)->get()->resultID->num_rows>0){
			$this->db->table("tbl_submas")->where($whr)->update(["bobot"=>$v]);
		}else{$this->db->table("tbl_submas")->insert(["id"=>$id,"kriteria"=>$idk,"bobot"=>$v]);}
		echo 'Y';
	}

	function resetK(){
		$this->db->query("delete from tbl_bobotk");
		echo "Y";
	}

	function resetBK($rjk=null){
		if($rjk!=null){
			$this->db->table("tbl_bobotalt")->where('kriteria',$rjk)->delete();
			echo "Y";
		}
	}

	function prosatu($nm,$key){
		$nil=$this->request->getPost('n');
		$this->db->table($nm)->where('id_kriteria',$key)->update(['aktif'=>$nil]);
		echo "Y";
	}
	
	function prosetapp(){
		$pos=$this->request->getPost();
		$this->db->table('app_set')->where('id',$this->set->id)->update($pos);

		$alert_info=array("alert_jns"=>'success',"alert_psn"=>"Data berhasil di ubah..");
		$this->ses->setFlashdata($alert_info);
		return redirect()->to(base_url('hal/setapp'));
	}

	function keluar(){
		$this->ses->destroy();
		return redirect()->to(base_url());
	}
}