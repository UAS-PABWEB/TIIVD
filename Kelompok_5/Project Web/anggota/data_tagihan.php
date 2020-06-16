<?php 
$id_anggota = idAnggota($_SESSION['id_user']);
?>              
        <div class="content mt-3">  <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data tagihan</strong>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
<table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Kode Pinjaman</th>
                        <th>Nama</th>
                        <th>Tanggal Bayar</th>
                        <th>Angsuran Ke</th>
                        <th>Jumlah Pinjam</th>
                        <th>Sisa Pinjam</th>
                        <th>Bayar</th>
                        <th>Bunga</th>
                        <th>Total Bayar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                       $query  = mysqli_query($conn,"SELECT * FROM bayar INNER JOIN anggota ON anggota.id_anggota  = bayar.id_anggota WHERE bayar.id_anggota='$id_anggota'");
                       $no=1;
                       while($r=mysqli_fetch_array($query)){
                      ?>
                      <tr>
                        <td><?php echo $no?></td>
                        <td><?php echo $r['kd_bayar'] ?></td>
                        <td><?php echo $r['kd_pinjaman'] ?></td>
                        <td><?php echo $r['nama'] ?></td>
                        <td><?php echo $r['tgl_bayar'] ?></td>
                        <td><?php echo $r['angsuran_ke'] ?></td>
                        <td><?php echo $r['jml_pinjam'] ?></td>
                        <td><?php echo $r['sisa'] ?></td>
                        <td><?php echo $r['bayar'] ?></td>
                        <td><?php echo $r['bunga'] ?></td>
                        <td><?php echo $r['total'] ?></td>
                      </tr>
                      <?php $no++; } ?>
                    </tbody>
                  </table>
                </div>
                </div></div></div></div>