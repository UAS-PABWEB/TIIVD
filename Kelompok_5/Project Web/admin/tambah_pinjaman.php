              
<div class="content mt-3">  
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Tambah pinjaman</strong>
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
  $insert_pinjaman = mysqli_query($conn,"INSERT INTO pinjaman VALUES(NULL,'$kd_pinjaman','$id_anggota','$jumlah','$tgl_pinjam','$jangka_waktu','$angsuran')");
            echo '<meta http-equiv="refresh" content="0; url=index.php?p=kelola_pinjaman&sukses=1">';
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
                    echo'<option value="'.$r['id_anggota'].'">'.$r['nama'].'</option>';
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
              <?php

    $q = mysqli_query($conn,"SELECT max(id_pinjaman) FROM pinjaman");
    $get = mysqli_fetch_array($q);
    $id_pinjaman = $get[0];
    $nomor=$id_pinjaman++;
    $kd_pinjaman="P".sprintf("%03s",$id_pinjaman);
              ?>
              <input type="text" id="nama" value="<?php echo $kd_pinjaman ?>" name="kd_pinjaman" value="P001" placeholder="" class="form-control" readonly="">
            </div>
          </div>


          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Jumlah</label>
            </div>
            <div class="col-12 col-md-9">
              <input onchange="getAngsuran()" type="text" id="jumlah" name="jumlah" placeholder="Masukkan Jumlah Pinjam" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Tanggal Pinjam</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="nama" name="tgl_pinjam" placeholder="Masukkan Tanggal Pinjam" class="form-control datepicker">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Jangka Waktu</label>
            </div>
            <div class="col-12 col-md-9">
              <select onchange="getAngsuran()" id="waktu" name="jangka_waktu" class="form-control">
                <?php 
                  for ($i=1; $i <= 24 ; $i++) { 
                    echo '<option value="'.$i.'">'.$i.' Bulan</option>';
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
              <input type="text" id="angsuran" name="angsuran" placeholder="Masukkan Angsuran" class="form-control" readonly="">
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

<script type="text/javascript">
  function getAngsuran(){
    var jumlah = $('#jumlah').val();
    var waktu = $('#waktu').val();
    var angsuran = jumlah/waktu;
    $('#angsuran').val(angsuran);
  }
</script>