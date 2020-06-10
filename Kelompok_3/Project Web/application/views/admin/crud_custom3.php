<main>
  <div class="container">
    <div class="admin-title">
      <div class="row">
        <div class="col m6 s12">
          <h4 class="light"><?=$title?></h4>
        </div>
        <div class="col m6 s12">
         <div class="nav-breadcrumb blue">
          <a href="#!" class="breadcrumb">Admin</a>
          <a href="#!" class="breadcrumb"><?=$title?></a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col m7 s12">
      <div class="card grey lighten-4">
        <div class="title-card grey lighten-4"><?=$title?></div>
        <div class="card-content white">
          <div class="container">
            <div class="row">
              <?php
              if($this->session->flashdata('pesan')){
                echo $this->session->flashdata('pesan');
              }else{
                if(isset($info)){
                  echo '<div class="alert blue lighten-1">'.$info.'</div>';
                }else{
                  echo '<div class="alert blue">Kelola Data '.$title.'</div>';
                }
              }
              ?>   
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col m5 s12">
      <div class="card grey lighten-4">
        <div class="title-card grey lighten-4">Menu <?=$title?></div>
        <div class="card-content white">
          <div class="container">
            <div class="btn-group">
              <a href="<?=site_url('admin/'.$page.'/backup')?>" class="btn waves-effect waves-light block"><i class="material-icons inline-text">backup</i> Backup Database</a>
              <a href="<?=site_url('admin/'.$page.'/export')?>" class="btn waves-effect waves-light block"><i class="material-icons inline-text">keyboard_backspace</i> Export CSV</a>
              <a href="#truncate" class="btn waves-effect modal-trigger waves-light block"><i class="material-icons inline-text">delete_forever</i> Hapus Semua Data</a>
              <div id="truncate" class="modal deletemodal">
                <div class="modal-content blue white-text">
                  <p>Apakah anda yakin ingin mengosongkan semua data?</p>
                </div>
                <div class="modal-footer">
                  <a class="waves-effect waves-red btn white blue-text modal-action modal-close">TIDAK</a>
                  <a href="<?=site_url('admin/'.$page.'/truncate')?>" class="waves-effect waves-green btn blue modal-action modal-close">YA</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col m12 s12">
      <div class="card grey lighten-4">
        <div class="title-card grey lighten-4">Data <?=$title?></div>
        <div class="card-content white">
          <table class="datatables responsive-table striped bordered">
            <thead class="blue">
              <tr class="white-text">
                <th class="light">No</th>
                <?php 
                foreach($tableTitle as $tt){
                  echo '<th class="light">'.$tt.'</th>';
                }
                ?>
                <th width="15%" class="light">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach($data as $d){?>
              <tr>
                <td><?=$no?></td>
                <?php 
                foreach($tableField as $tf){
                  echo '<td>'.$d->$tf.'</td>';
                }
                ?>
                <td style="text-align: center">
                  <a href="<?=site_url('admin/'.$page.'/p/accept/'.$d->$primary_key.'')?>" class="btn waves-effect waves-light action green tooltipped" data-position="top" data-delay="50" data-tooltip="Terima Pembatalan"><i class="material-icons">done</i></a>
                  <a href="#deleteDialog<?=$d->$primary_key?>" class="btn waves-effect modal-trigger waves-light action modal-trigger red  tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Data"><i class="material-icons">delete</i></a>
                </td>
                <div id="deleteDialog<?=$d->$primary_key?>" class="modal deletemodal">
                  <div class="modal-content blue white-text">
                    <p>Apakah anda yakin ingin menghapus data ini?</p>
                  </div>
                  <div class="modal-footer">
                    <a class="waves-effect waves-blue btn white blue-text modal-action modal-close">TIDAK</a>
                    <a href="<?=site_url('admin/'.$page.'/p/delete/'.$d->$primary_key.'')?>" class="waves-effect waves-light btn blue modal-action modal-close">YA</a>
                  </div>
                </div>
                <?php $no++; } ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<!--                     <div class="row">
                      <div class="alert blue">Tes </div>
                      <div class="alert green">Tes </div>
                      <div class="alert red">Tes </div>
                      <div class="alert orange">Tes </div>
                      <div class="alert blue strip-blue">Tes</div>
                      <div class="alert blue strip-green">Tes</div>
                      <div class="alert blue strip-red">Tes</div>
                      <div class="alert blue strip-orange">Tes</div>
                    </div> -->
                  </div>
                </main>  