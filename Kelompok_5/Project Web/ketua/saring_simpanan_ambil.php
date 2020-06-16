              
        <div class="content mt-3">  <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data Simpanan ambil</strong>
                        </div>
                        <div class="card-body">
                          <?php 
                            if(isset($_GET['sukses'])){
                              if($_GET['sukses']==1){
                                ?>

                          <div class="alert alert-success" role="alert">Data berhasil dihapus</div>
                                <?php
                              }                            }
                          ?>
<table id="table-export" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah Sukarela</th>
                        <th>Jumlah Ambil</th>
                        <th>Tanggal Ambil</th>
                        <th>Sisa Sukarela</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                       $query  = mysqli_query($conn,"SELECT * FROM simpanan INNER JOIN anggota ON anggota.id_anggota  = simpanan.id_anggota WHERE jenis_simpan='ambil'");
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
                        <td><a onclick="return confirm('Apakah anda yakin?')" href="?p=hapus_simpanan_ambil&id=<?php echo $r['id_simpanan'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a></td>
                      </tr>
                      <?php $no++; } ?>
                    </tbody>
                  </table>
                </div></div></div></div>