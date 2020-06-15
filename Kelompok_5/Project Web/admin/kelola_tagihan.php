              
        <div class="content mt-3">  <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data tagihan</strong>
                        </div>
                        <div class="card-body">
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
                          <div class="table-responsive">
<table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jangka Waktu</th>
                        <th>Angsuran</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                       $query  = mysqli_query($conn,"SELECT * FROM pinjaman INNER JOIN anggota ON anggota.id_anggota  = pinjaman.id_anggota");
                       $no=1;
                       while($r=mysqli_fetch_array($query)){
                      ?>
                      <tr>
                        <td><?php echo $no?></td>
                        <td><?php echo $r['kd_pinjaman'] ?></td>
                        <td><?php echo $r['nama'] ?></td>
                        <td><?php echo rupiah($r['jumlah']) ?></td>
                        <td><?php echo tgl($r['tgl_pinjam']) ?></td>
                        <td><?php echo $r['jangka_waktu'] ?> Bulan</td>
                        <td><?php echo rupiah($r['angsuran']) ?></td>
                        <td><a href="?p=detail_pinjaman&id=<?php echo $r['id_pinjaman'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-list"></i> Detail</a></td>
                      </tr>
                      <?php $no++; } ?>
                    </tbody>
                  </table>
                </div>
                </div></div></div></div>