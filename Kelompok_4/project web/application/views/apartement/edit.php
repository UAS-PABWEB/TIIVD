<div class="container">
  <div class="row">
    <div class="col-md-12" style="margin-top: 60px;">
      <div class="card">
        <div class="card-header">
          Edit Apartemen | Admin
        </div>
        <div class="card-body">

          <?=form_open_multipart()?>
          <?=$this->session->flashdata('message')?>
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Apartemen</label>
            <input type="text" name="nama_apartemen" value="<?=$detail->nama_apartemen?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Nama Apartemen" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Kota</label>
            <select name="id_kota" class="form-control" required>
              <option value="">Pilih Kota</option>
              <?php 
              foreach($kota as $k){
                if($k->id_kota==$detail->id_kota){
                  $selected = ' selected';
                }else{
                  $selected = '';
                }
                echo '<option value="'.$k->id_kota.'"'.$selected.'>'.$k->nama_kota.'</option>';
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Harga per Hari</label>
            <input type="number" name="harga" value="<?=$detail->harga?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Harga per Hari" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Harga per Bulan</label>
            <input type="number" name="harga_bulan" value="<?=$detail->harga_bulan?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Harga per Bulan" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Harga per Tahun</label>
            <input type="number" name="harga_tahun" value="<?=$detail->harga_tahun?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Harga per Tahun" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Foto</label>
            <small class="text-bold">*File yang diizinkan : jpg,png,jpeg</small>
            <br><img class="img-thumbnail" style="width: 200px" src="<?=base_url('assets/images/apartement')."/".$detail->foto?>"><br><br>
            <input type="file" name="foto">
          </div>

          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>