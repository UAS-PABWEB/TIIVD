<div class="row">
<div class="col-md-12">
<!-- Advanced Tables -->
<div class="panel panel-default">
    <div class="panel-heading">
         Data Pengguna
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <div>
                <a href="?page=pengguna&aksi=tambah" class="btn btn-success" style="margin-top: 8px;"><i class="fa fa-plus"></i> Tambah Data</a>
            </div><br>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Foto</th>
                        <th width="19%">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                        $no = 1;

                        $sql = $koneksi->query("select * from tb_user ");

                        while ($data= $sql->fetch_assoc()) {       
                       
                    ?>

                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['username'];?></td>
                        <td><?php echo $data['nama'];?></td>
                        <td><?php echo $data['level'];?></td>
                        <td> <img src="images/<?php echo  $data['foto'];?>" width="75" height="50"> </td>

                         <td>
                            <a href="?page=pengguna&aksi=ubah&id=<?php echo $data['id']; ?>" class="btn btn-warning" ><i class="fa fa-edit"></i> Ubah</a>
                            <a onclick="return confirm('Anda yakin ingin menghapus?')" href="?page=pengguna&aksi=hapus&id=<?php echo $data['id']; ?>" class="btn btn-danger" ><i class="fa fa-trash"></i> Hapus</a>

                        </td>
                    </tr>


                    <?php  } ?>
                </tbody>

                </table>
              </div>
    </div>
 </div>
</div>
</div>                          