<?php 
$id_simpanan = $_GET['id'];
$query = mysqli_query($conn,"SELECT * FROM simpanan WHERE id_simpanan = '$id_simpanan'");
$data = mysqli_fetch_array($query);
?>  
<div class="content mt-3">  
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Ubah Simpanan ambil</strong>
      </div>
      <div class="card-body">
<?php 
if(!empty($_POST)){
  $id_anggota = $_POST['id_anggota'];
  $jml_simpan = $_POST['jml_simpan'];
  $jumlah = $_POST['jumlah'];
  $tgl_simpan = $_POST['tgl_simpan'];
  $jenis_simpan = 'ambil';
  $jumlah = $_POST['jumlah'];
  $jml_total = $_POST['jml_total'];
  $insert_simpanan = mysqli_query($conn,"UPDATE simpanan SET id_anggota='$id_anggota',jml_simpan='$jml_simpan',jumlah='$jumlah',tgl_simpan='$tgl_simpan',jenis_simpan='$jenis_simpan',jumlah='$jumlah',jml_total='$jml_total'WHERE id_simpanan='$id_simpanan' ");
            echo '<meta http-equiv="refresh" content="0; url=index.php?p=kelola_simpanan_ambil&sukses=2">';
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
              <label for="disabled-input" class=" form-control-label">Jumlah ambil</label>
            </div>
            <div class="col-12 col-md-9">
              <input id="jumlah" type="number" value="<?php echo $data['jumlah'] ?>" name="jumlah" placeholder="Masukkan Jumlah ambil" class="form-control" readonly>
            </div>
          </div>


          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Jumlah Simpan</label>
            </div>
            <div class="col-12 col-md-9">
              <input id="jml_simpan" onkeyup="getTotal()" value="<?php echo $data['jml_simpan'] ?>" type="number" name="jml_simpan" placeholder="Masukkan Jumlah Simpan" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Tanggal Simpan</label>
            </div>
            <div class="col-12 col-md-9">
              <input id="tgl_simpan" type="text" id="nama" value="<?php echo $data['tgl_simpan'] ?>" name="tgl_simpan" placeholder="Masukkan Tanggal Simpan" class="form-control datepicker">
            </div>
          </div>


          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Total ambil</label>
            </div>
            <div class="col-12 col-md-9">
              <input id="jml_total" type="number" id="nama" name="jml_total" value="<?php echo $data['jml_total'] ?>" placeholder="Masukkan Total ambil" class="form-control" readonly="">
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
      var jenis = 'ambil';
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