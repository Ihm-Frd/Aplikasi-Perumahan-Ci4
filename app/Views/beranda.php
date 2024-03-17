
<div class="card card-blue card-outline">
    <div class="card-header text-center">
        <h4 class="text-blue text-lg mb-0">
            <i class="fa fa-2x fa-th-large"></i><br>
            <span class="text-xl">QUICK ACCESS MENU</span>
        </h4>
    </div>
</div>
<div class="row">
    <?php if($uslvl>=7){?>
    <div class="col-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
                <a href="<?php echo base_url('hal/mt/'.encme('tbl_alternatif'))?>">
                    <span class="info-box-text">Data</span>
                    <span class="info-box-number">Alternatif</span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fa fa-clipboard-check"></i></span>
            <div class="info-box-content">
                <a href="<?php echo base_url('hal/mt/'.encme('tbl_kriteria'))?>">
                    <span class="info-box-text">Data</span>
                    <span class="info-box-number">Kriteria</span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-clipboard-list"></i></span>
            <div class="info-box-content">
                <a href="<?php echo base_url('hal/sub/')?>">
                    <span class="info-box-text">Proses</span>
                    <span class="info-box-number">Pembobotan</span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-hourglass-half"></i></span>
            <div class="info-box-content">
                <a href="<?php echo base_url('hal/hitung/')?>">
                    <span class="info-box-text">Proses</span>
                    <span class="info-box-number">Perhitungan</span>
                </a>
            </div>
        </div>
    </div>
    <?php }?>
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-header"><h2><i class="fa fa-info-circle"></i> HALLO <?=strtoupper($usnama)?></h2></div>
            <div class="card-body">
                <center><h4><b>SELAMAT DATANG</b><br><br><?=$set->dashboard_desc?></h4></center>
            </div>
        </div>
    </div>
</div>