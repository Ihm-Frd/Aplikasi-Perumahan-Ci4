<div class="row">
  <div class="col-md-6">
    <form class="card" action="<?=base_url('proses/prosetapp')?>" method="POST">
      <div class="card-header">
        <h4 class="card-title">SETTING APLIKASI</h4>
      </div>
      <div class="card-body">
        <small>Nama Aplikasi</small>
        <input type="text" name="app_name" id="app_name" class="form-control mb-3" value="<?=$set->app_name?>" required>
        <small>Judul Aplikasi</small>
        <input type="text" name="app_title" id="app_title" class="form-control mb-3" value="<?=$set->app_title?>" required>
        <small>Deskripsi Aplikasi</small>
        <textarea name="dashboard_desc" id="dashboard_desc" cols="4" placeholder="Deskripsi Aplikasi" class="form-control mb-3"><?=$set->dashboard_desc?></textarea>
        <div class="row">
          <div class="col-md-4">
            <small>Jenis Perhitungan (*)</small>
            <select name="jenis_perhitungan" id="jenis_perhitungan" class="form-control mb-3">
              <option value="hitung" <?=($set->jenis_perhitungan=='hitung')?'selected':''?>>Perthitungan 1</option>
              <option value="hitung2" <?=($set->jenis_perhitungan=='hitung2')?'selected':''?>>Perthitungan 2</option>
            </select>
          </div>
          <div class="col-md-3">
            <small>Batas Diterima (**)</small>
            <div class="input-group">
              <input type="text" name="persentase_diterima" id="persentase_diterima" class="form-control" value="<?=$set->persentase_diterima?>" required>
              <div class="input-group-append">
                <span class="input-group-text">%</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn bg-gradient-blue"><i class="fa fa-save"></i> Simpan</button>
      </div>
    </form>
  </div>
  <div class="col-md-6">
    <div class="callout callout-warning">
      <h5>Penting.!!</h5><hr>
      <p>*) Jenis Perthitungan akan mempengaruhi cara sistem dalam melakukan perhitungan dan proses menampilkan hasil.</p>
      <p>**) Persentase Batas Diterima digunakan hanya pada jenis perhitungan tertentu (Perhitungan 2)</p>
      </ul>
    </div>
  </div>
</div>