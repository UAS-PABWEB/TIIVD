              
<div class="content mt-3">  
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Tambah Tagihan</strong>
      </div>
      <div class="card-body">
<?php 
if(!empty($_POST)){
  $insert_pinjaman = insertDB('bayar',$_POST); 
            echo '<meta http-equiv="refresh" content="0; url=index.php?p=kelola_tagihan&sukses=1">';
}
?>
        <form method="post" enctype="multipart/form-data" class="form-horizontal"> 

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Kode Transaksi</label>
            </div>
            <div class="col-12 col-md-9">
              <?php

    $q = mysqli_query($conn,"SELECT max(id_bayar) FROM bayar");
    $get = mysqli_fetch_array($q);
    $id_bayar = $get[0];
    $nomor=$id_bayar++;
    $kd_bayar="T".sprintf("%03s",$id_bayar);
              ?>
              <input type="text" id="kd_bayar" value="<?php echo $kd_bayar ?>" name="kd_bayar" value="P001" placeholder="" class="form-control" readonly="">
            </div>
          </div>




          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Nama Anggota</label>
            </div>
            <div class="col-12 col-md-9">
              <select onchange="getKode()" id="id_anggota" name="id_anggota" class="form-control">
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
              <select onchange="getTagihan()" name="kd_pinjaman" id="kd_pinjaman" class="form-control">
                <option value=""> Pilih Kode Pinjam</option>
              </select>
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class="form-control-label">Tanggal Bayar</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="tgl_bayar" name="tgl_bayar" placeholder="Masukkan Tanggal Bayar" class="form-control datepicker">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Angsuran Ke</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="angsuran_ke" name="angsuran_ke" placeholder="Angsuran Ke" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Jumlah Pinjaman</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="jml_pinjam" name="jml_pinjam" placeholder="" class="form-control" readonly>
            </div>
          </div>


          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Sisa Pinjaman</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="sisa" name="sisa" placeholder="" class="form-control" readonly> 
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Bayar</label>
            </div>
            <div class="col-12 col-md-9">
              <input onkeyup="getTotal()" type="text" id="bayar" name="bayar" placeholder="Masukkan Jumlah Bayar" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Bunga</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="bunga" name="bunga" class="form-control" readonly>
            </div>
          </div>


          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Total Bayar</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="total" name="total" class="form-control" readonly>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
            <button type="submit" class="btn btn-danger">Simpan</button>
            <button type="reset" class="btn btn-default">Reset</button>
          </div>
          </div>


                    </form>
                  </div>
                </div>
              </div>
            </div>
<script type="text/javascript">
  function getKode(){
      var id_anggota = $('#id_anggota').val();
      $.post('get_tagihan.php', {id_anggota:id_anggota}, function(data){ 
        $('#kd_pinjaman').html(data);
      });

  }
  function getTagihan(){
    var bayar = $('#bayar').val();
    var kd_pinjaman = $('#kd_pinjaman').val();
    $.ajax({
        url : "get_tagihan.php",
        data : {kd_pinjaman:kd_pinjaman} ,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            $('#jml_pinjam').val(data.jml_pinjam); 
            $('#sisa').val(data.sisa); 
            $('#bunga').val(data.bunga);
            if(bayar!==''){
              getTotal();
            }
        }
    });
  }
  function getTotal(){
    var bayar = $('#bayar').val();
    var bunga = $('#bunga').val();
    var total = parseInt(bayar)+parseInt(bunga);
    $('#total').val(total);
  }
</script>