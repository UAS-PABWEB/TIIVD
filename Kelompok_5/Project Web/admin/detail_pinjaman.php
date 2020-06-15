              <?php 
$id_pinjaman = $_GET['id'];
$query = mysqli_query($conn,"SELECT * FROM pinjaman WHERE id_pinjaman = '$id_pinjaman'");
$data = mysqli_fetch_array($query);
    $kd_pinjaman = $data['kd_pinjaman'];
    $q = mysqli_query($conn,"SELECT * FROM pinjaman WHERE kd_pinjaman='$kd_pinjaman'");
    $d = mysqli_fetch_array($q);
    $qq = mysqli_query($conn,"SELECT SUM(bayar) as jml_bayar FROM bayar WHERE kd_pinjaman='$kd_pinjaman'");
    $dd = mysqli_fetch_array($qq);
    $sudah_bayar = $dd['jml_bayar'];
    $jml_pinjam = $d['jumlah'];
    $sisa = $jml_pinjam-$sudah_bayar;
    $bunga = ($sisa*3)/100;
    $total = $data['angsuran']+$bunga;

    if(isset($_GET['bayar'])){

    $angsuran = $_GET['bayar'];
      $q = mysqli_query($conn,"SELECT max(id_bayar) FROM bayar");
      $get = mysqli_fetch_array($q);
      $id_bayar = $get[0];
      $nomor=$id_bayar++;
      $kd_bayar="T".sprintf("%03s",$id_bayar);
    if($angsuran!=='semua'){
      $sisaa = $sisa-$data['angsuran'];
      $insert_pinjaman = insertDB('bayar',array('kd_bayar'=>$kd_bayar,'kd_pinjaman'=>$kd_pinjaman,'id_anggota'=>$data['id_anggota'],'tgl_bayar'=>date('Y-m-d'),'angsuran_ke'=>$angsuran,'jml_pinjam'=>$jml_pinjam,'sisa'=>$sisaa,'bayar'=>$data['angsuran'],'bunga'=>$bunga,'total'=>$total)); 
              echo '<meta http-equiv="refresh" content="0; url=?p=detail_pinjaman&id='.$_GET['id'].'&sukses=1">';
    }else{
      $q2 = mysqli_query($conn,"SELECT MAX(angsuran_ke) FROM bayar WHERE kd_pinjaman='$kd_pinjaman'");
      $r2 = mysqli_fetch_array($q2);
      $a = $r2[0];
      if(empty($a)){
        $angsuran_kee = 1;
      }else{
        $angsuran_kee = $a+1;
      }
      echo $angsuran_kee;
      $insert_pinjaman = insertDB('bayar',array('kd_bayar'=>$kd_bayar,'kd_pinjaman'=>$kd_pinjaman,'id_anggota'=>$data['id_anggota'],'tgl_bayar'=>date('Y-m-d'),'angsuran_ke'=>$angsuran_kee,'jml_pinjam'=>$jml_pinjam,'sisa'=>0,'bayar'=>$sisa,'bunga'=>$bunga,'total'=>$sisa+$bunga)); 
              echo '<meta http-equiv="refresh" content="0; url=?p=detail_pinjaman&id='.$_GET['id'].'&sukses=1">';
    }
    }

?>     
        <div class="content mt-3">  <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Detail tagihan</strong>
                        </div>
                        <div class="card-body">
                          Kode Pinjaman : <b><?=$data['kd_pinjaman']?></b> <br>
                          Jumlah Pinjaman : <b><?=rupiah($data['jumlah'])?></b> <br>
                          Jangka Waktu : <b><?=$data['jangka_waktu']?></b> Bulan<br>
                          Angsuran : <b><?=rupiah($data['angsuran'])?></b><br>
                          Sisa Pinjaman Saat Ini: <b><?=rupiah($sisa)?></b>
                          <hr>
                          <?php 
                            if(isset($_GET['sukses'])){
                              if($_GET['sukses']==1){
                                ?>

                          <div class="alert alert-success" role="alert">Tagihan berhasil dibayar</div>
                                <?php
                              }
                            }
                          ?>
                          <div class="table-responsive">
<table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Angsuran Ke</th>
                        <th>Bayar</th>
                        <th>Bunga</th>
                        <th>Total Bayar</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                       $query  = mysqli_query($conn,"SELECT * FROM bayar INNER JOIN anggota ON anggota.id_anggota  = bayar.id_anggota");
                       $no=1;
                       for ($i=0; $i < $data['jangka_waktu'] ; $i++) { 

                        $qq = mysqli_query($conn,"SELECT * FROM bayar WHERE kd_pinjaman='$kd_pinjaman' AND angsuran_ke='$no'");
                        $cek = mysqli_num_rows($qq);

                      ?>
                          <?php if($cek>0){

                          $r=mysqli_fetch_array($qq);
                            ?>
                      <tr>
                        <td><?php echo $no?></td>
                        <td><?php echo $r['angsuran_ke']?></td>
                        <td><?php echo rupiah($r['bayar'])?></td>
                        <td><?php echo rupiah($r['bunga'])?></td>
                        <td><?php echo rupiah($r['total'])?></td>
                        <td>
                          <a href="#" class="btn btn-success btn-sm disabled"><i class="fa fa-check"></i> Sudah Dibayar</a>
                        </td>
                      </tr>
                          <?php
                        }else{
                          if($bunga!==0){
                          ?>

                      <tr>
                        <td><?php echo $no?></td>
                        <td><?php echo $no?></td>
                        <td><?php echo rupiah($data['angsuran'])?></td>
                        <td><?php echo rupiah($bunga)?></td>
                        <td><?php echo rupiah($total)?></td>
                        <td>
                          <a onclick="return confirm('Apakah anda yakin?')" href="?p=detail_pinjaman&id=<?php echo $_GET['id'] ?>&bayar=<?php echo $no ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Bayar</a>
                        </td>
                      </tr>
                          <?php
                        }
                        } ?>
                      <?php $no++; } ?>

                      <?php if($sisa!==0){?>
                      <tr style="background-color: #6FC182">
                        <td><?php echo $no?></td>
                        <td><b>Bayar Semua</b></td>
                        <td><?php echo rupiah($sisa)?></td>
                        <td><?php echo rupiah($bunga)?></td>
                        <td><?php echo rupiah($sisa + $bunga)?></td>
                        <td>
                          <a onclick="return confirm('Apakah anda yakin?')" href="?p=detail_pinjaman&id=<?php echo $_GET['id'] ?>&bayar=semua" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Bayar Semua</a>
                        </td>
                      </tr>
                      <?php }else{

                      } ?>
                    </tbody>
                  </table>
                </div>
                </div></div></div></div>