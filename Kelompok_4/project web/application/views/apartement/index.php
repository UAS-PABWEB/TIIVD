<div class="container">
  <div class="row">
    <div class="col-md-12" style="margin-top: 60px;">
      <div class="card">
        <div class="card-header">
          Data Apartemen | Admin
        </div>
        <div class="card-body">
          <a href="<?=base_url('apartement/add')?>" class="btn btn-primary">Tambah Data</a>
          <hr>
          <?=$this->session->flashdata('message')?>
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Apartemen</th>
                <th scope="col">Kota</th>
                <th scope="col">Harga per Hari/Bulan/Tahun</th>
                <th scope="col">Foto</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>


              <?php 
              $i=1;
              foreach($list as $l){
                ?>
                <tr>
                  <th scope="row"><?=$i?></th>
                  <td><?=$l->nama_apartemen?></td>
                  <td><?=$l->nama_kota?></td>
                  <td><?=rupiah($l->harga)?> / <?=rupiah($l->harga_bulan)?> / <?=rupiah($l->harga_tahun)?></td>
                  <td><img class="img-thumbnail" style="width: 100px" src="<?=base_url('assets/images/apartement')."/".$l->foto?>"></td>
                  <td><a href="<?=base_url('apartement/edit/'.$l->id_apartemen)?>" class="btn btn-info btn-sm">Edit</a>
                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" href="<?=base_url('apartement/delete/'.$l->id_apartemen)?>" class="btn btn-danger btn-sm">Hapus</a></td>
                </tr>
                <?php $i++; 
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>