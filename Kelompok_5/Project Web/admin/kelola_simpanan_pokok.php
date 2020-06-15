              
        <div class="content mt-3">  <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data Simpanan Pokok</strong>
                        </div>
                        <div class="card-body">
                          <a href="?p=tambah_simpanan_pokok" class="btn btn-danger"><i class="fa fa-plus"></i> Tambah Simpanan Pokok</a>
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
                        <th>Jumlah Pokok</th>
                        <th>Jumlah Simpan</th>
                        <th>Tanggal Simpan</th>
                        <th>Total Pokok</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                       $query  = mysqli_query($conn,"SELECT * FROM simpanan INNER JOIN anggota ON anggota.id_anggota  = simpanan.id_anggota WHERE jenis_simpan='pokok'");
                       $no=1;
                       while($r=mysqli_fetch_array($query)){
                      ?>
                      <tr>
                        <td><?php echo $no?></td>
                        <td><?php echo $r['nama'] ?></td>
                        <td><?php echo rupiah($r['jumlah']) ?></td>
                        <td><?php echo rupiah($r['jml_simpan']) ?></td>
                        <td><?php echo tgl($r['tgl_simpan']) ?></td>
                        <td><?php echo rupiah($r['jml_total']) ?></td>
                        <td><a href="?p=ubah_simpanan_pokok&id=<?php echo $r['id_simpanan'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Ubah</a></td>
                      </tr>
                      <?php $no++; } ?>
                    </tbody>
                  </table>
                </div></div></div></div>