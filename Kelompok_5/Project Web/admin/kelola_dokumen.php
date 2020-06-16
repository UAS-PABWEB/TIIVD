              
<div class="content mt-3">  
  <div class="col-md-8 offset-md-2">
    <div class="card">
      <div class="card-header">
        <strong class="card-title">Kelola Dokumen</strong>
      </div>
      <div class="card-body">
        <?php 
        if(!empty($_POST)){

          $ekstensi_diperbolehkan = array('docx','doc','pdf','xls','xlsx','ppt','pptx');
          $nama = $_FILES['file']['name'];
          $dir = 'admin/dokumen/';
          $x = explode('.', $nama);
          $ekstensi = strtolower(end($x));
          $ukuran = $_FILES['file']['size'];
          $file_tmp = $_FILES['file']['tmp_name'];  
          if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if (file_exists($dir.$nama)) {
              $a = explode('.', $nama);
              $n = $a[0].time();
              $e = $a[1];
              $nama = $n.'.'.$e;
            }
            move_uploaded_file($file_tmp, $dir.$nama);
            
    $q = mysqli_query($conn,"SELECT max(id_dokumen) FROM dokumen");
    $get = mysqli_fetch_array($q);
    $id_dokumen = $get[0];
    $nomor=$id_dokumen++;
    $kd_dokumen="T".sprintf("%03s",$id_dokumen);
            $data=array('kd_dokumen'=>$kd_dokumen,'nama_dokumen'=>$_POST['nama_dokumen'],'file'=>$nama);
            insertDB('dokumen',$data);
          }else{
            echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
          }
        }
        ?>
        <form method="POST" enctype="multipart/form-data">
          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class="form-control-label">Nama Dokumen</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" id="nama_dokumen" name="nama_dokumen" placeholder="Masukkan Nama Dokumen" class="form-control">
            </div>
          </div>
          <div class="row form-group">
            <div class="col col-md-3">
              <label for="disabled-input" class="form-control-label">Dokumen</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="file" id="file" name="file" class="form-control">
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-danger">Upload</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-12">
                          <?php 
                            if(isset($_GET['sukses'])){
                              if($_GET['sukses']==1){
                                ?>

                          <div class="alert alert-success" role="alert">Data berhasil disimpan</div>
                                <?php
                              }
                            }
                          ?>
    <table id="bootstrap-data-table" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Dokumen</th>
          <th>Nama Dokumen</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query  = mysqli_query($conn,"SELECT * FROM dokumen");
        $no=1;
        while($r=mysqli_fetch_array($query)){
          ?>
          <tr>
            <td><?php echo $no?></td>
            <td><?php echo $r['kd_dokumen'] ?></td>
            <td><?php echo $r['nama_dokumen'] ?></td>
            <td><a target="blank" class="btn btn-success" href="admin/dokumen/<?php echo $r['file'] ?>"><i class="fa fa-download"></i> Download</a></td>
          </tr>
          <?php $no++; } ?>
        </tbody>
      </table>
    </div>
  </div>