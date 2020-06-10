<div class="container">
  <div class="row">
    <div class="col-md-12" style="margin-top: 60px;">
      <div class="card">
        <div class="card-header">
         Data User | Admin
        </div>
        <div class="card-body">
          <?=$this->session->flashdata('message')?>
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Nomor HP</th>
                <th scope="col">Username</th>
                <th scope="col">Level</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>

              <?php 
              $i=1;
              foreach($list as $l){
                if($l->level==1){
                  $level = "Admin";
                }else{
                  $level = "User";
                }
                ?>
                <tr>
                  <th scope="row"><?=$i?></th>
                  <td><?=$l->nama?></td>
                  <td><?=$l->alamat?></td>
                  <td><?=$l->no_hp?></td>
                  <td><?=$l->username?></td>
                  <td><?=$level?></td>
                  <td><a href="<?=base_url('user/edit/'.$l->id_user)?>" class="btn btn-info btn-sm">Edit</a>
                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');" href="<?=base_url('user/delete/'.$l->id_user)?>" class="btn btn-danger btn-sm">Hapus</a></td>
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