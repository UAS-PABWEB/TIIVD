<?php 
$id_anggota = idAnggota($_SESSION['id_user']);
?>              
        <div class="content mt-3">  <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data Simpanan wajib</strong>
                        </div>
                        <div class="card-body">
<table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah wajib</th>
                        <th>Jumlah Simpan</th>
                        <th>Tanggal Simpan</th>
                        <th>Total wajib</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                       $query  = mysqli_query($conn,"SELECT * FROM simpanan INNER JOIN anggota ON anggota.id_anggota  = simpanan.id_anggota WHERE jenis_simpan='wajib' AND simpanan.id_anggota='$id_anggota'");
                       $no=1;
                       while($r=mysqli_fetch_array($query)){
                      ?>
                      <tr>
                        <td><?php echo $no?></td>
                        <td><?php echo $r['nama'] ?></td>
                        <td><?php echo rupiah($r['jumlah']) ?></td>
                        <td><?php echo rupiah($r['jml_simpan']) ?></td>
                        <td><?php echo ($r['tgl_simpan']) ?></td>
                        <td><?php echo rupiah($r['jml_total']) ?></td>
                      </tr>
                      <?php $no++; } ?>
                    </tbody>
                  </table>
                </div></div></div></div>