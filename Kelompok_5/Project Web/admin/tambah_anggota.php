              
<div class="content mt-3">  
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Tambah Anggota</strong>
      </div>
      <div class="card-body">
<?php 
if(!empty($_POST)){
  $nama = $_POST['nama'];
  $tempat_lahir = $_POST['tempat_lahir'];
  $tgl_lahir = $_POST['tgl_lahir'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $alamat = $_POST['alamat'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $tgl_daftar = date('Y-m-d');
  
  $cek_username = mysqli_query($conn,"SELECT * FROM user WHERE username = '$username'");
  if(mysqli_num_rows($cek_username)>0){
    echo'
      <div class="alert alert-danger" role="alert">
          Username sudah digunakan
      </div>
    ';
  }else{
    $insert_user = mysqli_query($conn,"INSERT INTO user VALUES(NULL,'$username','$password','anggota')");
    $q = mysqli_query($conn,"SELECT max(id_user) FROM user");
    $get = mysqli_fetch_array($q);
    $id_user = $get[0];
    $insert_anggota = mysqli_query($conn,"INSERT INTO anggota VALUES(NULL,'$nama','$tgl_daftar','$tempat_lahir','$tgl_lahir','$jenis_kelamin','$alamat','$id_user')");
            echo '<meta http-equiv="refresh" content="0; url=index.php?p=kelola_anggota&sukses=1">';
  }

}
?>
        <form method="post" enctype="multipart/form-data" class="form-horizontal"> 

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Nama</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Tempat Lahir</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="nama" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Tanggal Lahir</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="nama" name="tgl_lahir" placeholder="Masukkan Tanggal Lahir" class="form-control datepicker">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Jenis Kelamin</label>
            </div>
            <div class="col-12 col-md-9">
              <select name="jenis_kelamin" class="form-control"> 
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Alamat</label>
            </div>
            <div class="col-12 col-md-9">
              <textarea class="form-control" placeholder="Masukkan Alamat" name="alamat"></textarea>
            </div>
          </div>
          <hr>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Username</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="nama" name="username" placeholder="Masukkan Username" class="form-control ">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Password</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="password" id="nama" name="password" placeholder="Masukkan Password" class="form-control ">
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