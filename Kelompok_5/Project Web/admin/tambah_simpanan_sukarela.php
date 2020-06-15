              
<div class="content mt-3">  
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Tambah Simpanan Manasuka</strong>
      </div>
      <div class="card-body">
<?php 
if(!empty($_POST)){
  $id_anggota = $_POST['id_anggota'];
  $jml_simpan = $_POST['jml_simpan'];
  $jumlah = $_POST['jumlah'];
  $tgl_simpan = $_POST['tgl_simpan'];
  $jenis_simpan = 'sukarela';
  $jumlah = $_POST['jumlah'];
  $jml_total = $_POST['jml_total'];
  $insert_simpanan = mysqli_query($conn,"INSERT INTO simpanan VALUES(NULL,'$id_anggota','$jml_simpan','$tgl_simpan','$jenis_simpan','$jumlah','$jml_total')");
            echo '<meta http-equiv="refresh" content="0; url=index.php?p=kelola_simpanan_sukarela&sukses=1">';
}
?>
        <form method="post" enctype="multipart/form-data" class="form-horizontal"> 

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Nama Anggota</label>
            </div>
            <div class="col-12 col-md-9">
              <select id="id_anggota" onchange="getJumlah()" name="id_anggota" class="form-control">
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
              <label for="disabled-input" class=" form-control-label">Jumlah Manasuka</label>
            </div>
            <div class="col-12 col-md-9">
              <input id="jumlah" type="number" name="jumlah" placeholder="Masukkan Jumlah Manasuka" class="form-control" readonly>
            </div>
          </div>


          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Jumlah Simpan</label>
            </div>
            <div class="col-12 col-md-9">
              <input id="jml_simpan" onkeyup="getTotal()" type="number" name="jml_simpan" placeholder="Masukkan Jumlah Simpan" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Tanggal Simpan</label>
            </div>
            <div class="col-12 col-md-9">
              <input id="tgl_simpan" type="text" id="nama" name="tgl_simpan" placeholder="Masukkan Tanggal Simpan" class="form-control datepicker">
            </div>
          </div>


          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Total Manasuka</label>
            </div>
            <div class="col-12 col-md-9">
              <input id="jml_total" type="number" id="nama" name="jml_total" placeholder="Masukkan Total Manasuka" class="form-control" readonly="">
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
  function getJumlah(){
      var id_anggota = $('#id_anggota').val();
      var jenis = 'sukarela';
      $.post('get_jumlah.php', {id_anggota:id_anggota,jenis:jenis}, function(data){ 
        $('#jumlah').val(data);
      });

  }
  function getTotal(){
    var jumlah = $('#jumlah').val();
    var jml_simpan = $('#jml_simpan').val();
    var total = parseInt(jumlah)+parseInt(jml_simpan);
    $('#jml_total').val(total);
  }
</script>