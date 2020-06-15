<?php 
$id_pinjaman = $_GET['id'];
$query = mysqli_query($conn,"SELECT * FROM pinjaman WHERE id_pinjaman = '$id_pinjaman'");
$data = mysqli_fetch_array($query);
?>                
<div class="content mt-3">  
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Ubah pinjaman</strong>
      </div>
      <div class="card-body">
<?php 
if(!empty($_POST)){
  $kd_pinjaman = $_POST['kd_pinjaman'];
  $id_anggota = $_POST['id_anggota'];
  $jumlah = $_POST['jumlah'];
  $tgl_pinjam = $_POST['tgl_pinjam'];
  $jangka_waktu = $_POST['jangka_waktu'];
  $angsuran = $_POST['angsuran'];
  $insert_pinjaman = mysqli_query($conn,"UPDATE pinjaman SET id_anggota='$id_anggota',jumlah='$jumlah',tgl_pinjam='$tgl_pinjam',jangka_waktu='$jangka_waktu',angsuran='$angsuran' WHERE id_pinjaman='$id_pinjaman'");
            echo '<meta http-equiv="refresh" content="0; url=index.php?p=kelola_pinjaman&sukses=2">';
}
?>
        <form method="post" enctype="multipart/form-data" class="form-horizontal"> 

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Nama Anggota</label>
            </div>
            <div class="col-12 col-md-9">
              <select name="id_anggota" class="form-control">
                <option value=""> Pilih Anggota</option>
                <?php 
                  $query = mysqli_query($conn,"SELECT * FROM anggota");
                  while($r=mysqli_fetch_array($query)){
                    if($data['id_anggota']==$r['id_anggota']){
                      $selected = ' selected';
                    }else{
                      $selected = '';
                    }
                    echo'<option value="'.$r['id_anggota'].'"'.$selected.'>'.$r['nama'].'</option>';
                  }
                ?>
              </select>
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Kode Pinjam</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="nama" value="<?php echo $data['kd_pinjaman'] ?>" name="kd_pinjaman" value="P001" placeholder="" class="form-control" readonly="">
            </div>
          </div>


          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Jumlah</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="nama" name="jumlah" value="<?php echo $data['jumlah'] ?>" placeholder="Masukkan Jumlah Pinjam" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Tanggal Pinjam</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="nama" name="tgl_pinjam" value="<?php echo $data['tgl_pinjam'] ?>" placeholder="Masukkan Tanggal Pinjam" class="form-control datepicker">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Jangka Waktu</label>
            </div>
            <div class="col-12 col-md-9">
              <select name="jangka_waktu" class="form-control">
                <?php 
                  for ($i=1; $i <= 24 ; $i++) { 
                    if($data['jangka_waktu']==$i){
                      $selected = ' selected';
                    }else{
                      $selected = '';
                    }
                    echo '<option value="'.$i.'"'.$selected.'>'.$i.' Bulan</option>';
                  }
                ?>
              </select>
            </div>
          </div>


          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Angsuran</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="nama" name="angsuran" value="<?php echo $data['angsuran'] ?>" placeholder="Masukkan Angsuran" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
            <input type="submit" class="btn btn-danger" value="Simpan">
            <button type="reset" class="btn btn-default">Reset</button>
          </div>
          </div>


                    </form>
                  </div>
                </div>
              </div>
            </div>