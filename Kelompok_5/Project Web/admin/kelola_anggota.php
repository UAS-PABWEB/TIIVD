              
        <div class="content mt-3">  <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data Anggota</strong>
                        </div>
                        <div class="card-body">
                          <a href="?p=tambah_anggota" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah Anggota</a>
                          <hr>
                          <?php 
                            if(isset($_GET['sukses'])){
                              if($_GET['sukses']==1){
                                ?>

                          <div class="alert alert-success" role="alert">Data berhasil disimpan</div>
                                <?php
                              }elseif($_GET['sukses']==2){
                                ?>

                          <div class="alert alert-success" role="alert">Data berhasil diubah</div>
                                <?php
                              }
                            }
                          ?>
<table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal Daftar</th>
                        <th>Tempat, Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                       $query  = mysqli_query($conn,"SELECT * FROM anggota");
                       $no=1;
                       while($r=mysqli_fetch_array($query)){
                      ?>
                      <tr>
                        <td><?php echo $no?></td>
                        <td><?php echo $r['nama'] ?></td>
                        <td><?php echo tgl($r['tgl_daftar']) ?></td>
                        <td><?php echo $r['tempat_lahir'] ?>, <?php echo tgl($r['tgl_lahir']) ?></td>
                        <td><?php echo $r['jenis_kelamin'] ?></td>
                        <td><?php echo $r['alamat'] ?></td>
                        <td><a href="?p=ubah_anggota&id=<?php echo $r['id_anggota'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Ubah</a></td>
                      </tr>
                      <?php $no++; } ?>
                    </tbody>
                  </table>
                </div></div></div></div>