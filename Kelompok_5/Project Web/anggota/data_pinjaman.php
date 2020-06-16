<?php 
$id_anggota = idAnggota($_SESSION['id_user']);
?>              
        <div class="content mt-3">  <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data Pinjaman</strong>
                        </div>
                        <div class="card-body">
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
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                       $query  = mysqli_query($conn,"SELECT * FROM pinjaman INNER JOIN anggota ON anggota.id_anggota  = pinjaman.id_anggota WHERE pinjaman.id_anggota='$id_anggota'");
                       $no=1;
                       while($r=mysqli_fetch_array($query)){
                      ?>
                      <tr>
                        <td><?php echo $no?></td>
                        <td><?php echo $r['kd_pinjaman'] ?></td>
                        <td><?php echo $r['nama'] ?></td>
                        <td><?php echo rupiah($r['jumlah']) ?></td>
                        <td><?php echo $r['tgl_pinjam'] ?></td>
                        <td><?php echo $r['jangka_waktu'] ?> Bulan</td>
                        <td><?php echo rupiah($r['angsuran']) ?></td>
                      </tr>
                      <?php $no++; } ?>
                    </tbody>
                  </table>
                </div></div></div></div>