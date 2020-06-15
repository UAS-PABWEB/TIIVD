<?php 
$id_anggota = $_GET['id'];
$query = mysqli_query($conn,"SELECT * FROM user INNER JOIN anggota ON anggota.id_user = user.id_user WHERE anggota.id_anggota='$id_anggota'");
$data = mysqli_fetch_array($query);
?>              
<div class="content mt-3">  
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Ubah Anggota</strong>
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
          if((mysqli_num_rows($cek_username)>0)&&($username!==$data['username'])){
            echo'
            <div class="alert alert-danger" role="alert">
            Username sudah digunakan
            </div>
            ';
          }else{
            $update_anggota = mysqli_query($conn,"UPDATE anggota SET nama='$nama',tempat_lahir='$tempat_lahir',tgl_lahir='$tgl_lahir',jenis_kelamin='$jenis_kelamin',alamat='$alamat' WHERE id_anggota='$id_anggota' ");

            $q = mysqli_query($conn,"SELECT * FROM anggota WHERE id_anggota='$id_anggota'");
            $dataa = mysqli_fetch_array($q);
            $id_user = $dataa['id_user'];

            if(!empty($_POST['password'])){
              $update_anggota = mysqli_query($conn,"UPDATE user SET username='$username','password'=>'password' WHERE id_user = '$id_user'");
            }else{
              $update_anggota = mysqli_query($conn,"UPDATE user SET username='$username' WHERE id_user = '$id_user'");
            }
            echo '<meta http-equiv="refresh" content="0; url=index.php?p=kelola_anggota&sukses=2">';
          }

        }
        ?>
        <form method="post" enctype="multipart/form-data" class="form-horizontal"> 

          <div class="row form-group">
            <div class="col col-md-3">
              <label class=" form-control-label">Nama</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="nama" name="nama" value="<?php echo $data['nama'] ?>" placeholder="Masukkan Nama" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Tempat Lahir</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="nama" name="tempat_lahir" value="<?php echo $data['tempat_lahir'] ?>" placeholder="Masukkan Tempat Lahir" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Tanggal Lahir</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="nama" name="tgl_lahir" value="<?php echo $data['tgl_lahir'] ?>" placeholder="Masukkan Tanggal Lahir" class="form-control datepicker">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Jenis Kelamin</label>
            </div>
            <div class="col-12 col-md-9">
              <select name="jenis_kelamin" class="form-control"> 
                <?php 
                $jk = $data['jenis_kelamin'];
                ?>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" <?php echo $jk=='Laki-laki' ? 'selected' : '' ?> >Laki-laki</option>
                <option value="Perempuan" <?php echo $jk=='Perempuan' ? 'selected' : '' ?>>Perempuan</option>
              </select>
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Alamat</label>
            </div>
            <div class="col-12 col-md-9">
              <textarea class="form-control" placeholder="Masukkan Alamat" name="alamat"><?php echo $data['alamat'] ?></textarea>
            </div>
          </div>
          <hr>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Username</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="nama" name="username" placeholder="Masukkan Username" value="<?php echo $data['username'] ?>" class="form-control ">
            </div>
          </div>

          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class=" form-control-label">Ganti Password</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="password" id="nama" name="password" placeholder="Masukkan Password" class="form-control">
              <small>*Kosongkan jika tidak ingin mengganti password</small>
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