<?php
namespace App\Controllers;

class Hal extends BaseController {

	public function index(){
		if (session(encme('UserID'))==''){return redirect()->to(base_url('hal/masuk'));}
		$dt=[
			"jdlapp"=>"SPK Metode AHP",
			"jdlhal"=>"Halaman Utama",
			'uslvl' => desme(session(encme("UserLvl"))),
			'usid' => desme(session(encme("UserID"))),
			'usname' => desme(session(encme("UserName"))),
			'usnama' => desme(session(encme("Nama"))),
			'set'=>$this->set,
			"bcb"=>array(array("url"=>"","jdl"=>"Home"))
		];
		$dt['contents']=view('beranda',$dt);
		return view('template',$dt);
	}

	function mt($nm=null,$flt=null){
		if ($nm!=null){
			$jdlhal="Data ".ucwords((substr(desme($nm), 4)));
			if(desme($nm)=="tbl_submas" and $flt!=null){
				$dtbl=$this->db->table(desme($nm))->where("id",desme($flt))->get()->getResult();
			}else if(desme($nm)=="tbl_subk" and $flt!=null){
				$dtbl=$this->db->table(desme($nm))->where("kriteria",desme($flt))->get()->getResult();
			}else{$dtbl=$this->db->table(desme($nm))->get()->getResult();}
			$dt=[
				"jdlapp"=>"SPK Metode AHP",
				"jdlhal"=>$jdlhal,
				'uslvl' => desme(session(encme("UserLvl"))),
				'usid' => desme(session(encme("UserID"))),
				'usname' => desme(session(encme("UserName"))),
				'usnama' => desme(session(encme("Nama"))),
				'set'=>$this->set,
				"bcb"=>[["url"=>base_url(),"jdl"=>"Home"],["url"=>"","jdl"=>$jdlhal]],
				"tabel" => $this->db->table("master_tbl")->where("nama_tbl",desme($nm))->get()->getRow(),
				"dtbl" => $dtbl
			];
			
			$dt['contents']=view('tabel',$dt);
			return view('template',$dt);
		}else{return redirect()->to(base_url());}
	}
	
	function kelola($nm=null,$kd=null){
		if ($nm!=null){
			if(desme($kd)=='baru'){$jdlhal="Tambah";}else{$jdlhal="Ubah";}
			$jdlhal=$jdlhal." Data ".ucwords((substr(desme($nm), 4)));
			$dt=array(
				"jdlapp"=>"SPK Metode AHP",
				"jdlhal"=>$jdlhal,
				'uslvl' => desme(session(encme("UserLvl"))),
				'usid' => desme(session(encme("UserID"))),
				'usname' => desme(session(encme("UserName"))),
				'usnama' => desme(session(encme("Nama"))),
				'set'=>$this->set,
				"bcb"=>array(array("url"=>base_url(),"jdl"=>"Home"),array("url"=>base_url('hal/mt/'.$nm),"jdl"=>"Data ".ucwords((substr(desme($nm), 4)))),array("url"=>"","jdl"=>$jdlhal))
			);
			$dt['dtltbl']=$this->db->table("master_tbl")->where("nama_tbl",desme($nm))->get()->getRow();
			$dt["nmtbl"] = desme($nm);
			$dt["kdrjk"] = desme($kd);
			
			$dt['contents']=view('form_tbl',$dt);
			return view('template',$dt);
		}else{return redirect()->to(base_url());}
	}

	function submas($flt=null){
		$dt=array(
			"jdlapp"=>"SPK Metode AHP",
			"jdlhal"=>"Rincian Data Alternatif",
			'uslvl' => desme(session(encme("UserLvl"))),
			'usid' => desme(session(encme("UserID"))),
			'usname' => desme(session(encme("UserName"))),
			'usnama' => desme(session(encme("Nama"))),
			'set'=>$this->set,
			'tblk'=> $this->db->table("tbl_kriteria")->where('aktif',1)->get()->getResult(),
			'dmas'=> $this->db->table('tbl_alternatif')->where("id",desme($flt))->get()->getRow(),
			"bcb"=>array(array("url"=>base_url(),"jdl"=>"Home"),array("url"=>base_url('hal/mt/'.encme('tbl_alternatif')),"jdl"=>"Data Alternatif"),array("url"=>"","jdl"=>"Rincian Data Alternatif"))
		);
		
		$dt['contents']=view('submas',$dt);
		return view('template',$dt);
	}

	function sub(){
		$dt=array(
			"jdlapp"=>"SPK Metode AHP",
			"jdlhal"=>"Pembobotan Kriteria & Alternatif",
			'uslvl' => desme(session(encme("UserLvl"))),
			'usid' => desme(session(encme("UserID"))),
			'usname' => desme(session(encme("UserName"))),
			'usnama' => desme(session(encme("Nama"))),
			'set'=>$this->set,
			"bcb"=>array(array("url"=>base_url(),"jdl"=>"Home"),array("url"=>"","jdl"=>"Pembobotan Kriteria & Alternatif")),
			"krta"=>$this->db->table("tbl_kriteria")->where('aktif','1')->get()->getResult()
		);
		
		$dt['contents']=view('sub',$dt);
		return view('template',$dt);
	}

	function setapp(){
		$dt=array(
			"jdlapp"=>"SPK Metode AHP",
			"jdlhal"=>"Setting Aplikasi",
			'uslvl' => desme(session(encme("UserLvl"))),
			'usid' => desme(session(encme("UserID"))),
			'usname' => desme(session(encme("UserName"))),
			'usnama' => desme(session(encme("Nama"))),
			"bcb"=>array(array("url"=>base_url(),"jdl"=>"Home"),array("url"=>"","jdl"=>"Setting Aplikasi")),
			'set'=>$this->set,
		);
		
		$dt['contents']=view('setapp',$dt);
		return view('template',$dt);
	}

	function hitung(){
		$dt=array(
			"jdlapp"=>"SPK Metode AHP",
			"jdlhal"=>"Perhitungan Metode AHP",
			'uslvl' => desme(session(encme("UserLvl"))),
			'usid' => desme(session(encme("UserID"))),
			'usname' => desme(session(encme("UserName"))),
			'usnama' => desme(session(encme("Nama"))),
			"bcb"=>array(array("url"=>base_url(),"jdl"=>"Home"),array("url"=>"","jdl"=>"Perhitungan Metode AHP")),
			"krta"=>$this->db->table("tbl_kriteria")->where('aktif','1')->get()->getResult(),
			'alt'=>$this->db->table('tbl_alternatif')->get()->getResult(),
			'set'=>$this->set,
			'dhsl'=>$this->db->table('tbl_hasil')->orderBy('nomor desc')->get()->getRow(),
			'htg'=>$this->db->table('tbl_hasil')->orderBy('nomor desc')->get()->getResult()
		);
		
		$dt['contents']=view($this->set->jenis_perhitungan,$dt);
		return view('template',$dt);
	}

	function cetak(){
		return view('cetak');
	}

	function masuk(){
		if (session(encme('UserID'))!=''){return redirect()->to(base_url());}
		$dt=array(
			"jdlapp"=>"SPK Metode AHP",
			"jdlhal"=>"Halaman Login",
			"bcb"=>array(array("url"=>"","jdl"=>"Login"))
		);

		return view('masuk',$dt);
	}

}
