<main>
  <div class="page-header blue white-text">
    <h4 class="light">Hasil Pencarian Kereta Api</h4>
  </div>
  <div class="page-content">
   <div class="container">
    <div class="row"> 
      
      <?php if(!isset($pulang)){ ?>
      <div style="display: <?php if(!empty($_SESSION['cart'])){echo "block";}else{echo "none";} ?>" id="orderBtn">
        <div class="fixed-action-btn">
          <a id="btnPesan" href="#confirm" class="btn btn-large blue darken-2 animated modal-trigger">
            <i class="large material-icons inline-text">shopping_cart</i> Pesan Tiket
          </a>
        </div>
      </div>
      <div class="col s12 m12">
        <div class="card grey lighten-4">
          <div class="card-content">
            <span class="card-title">
              <?php if(!empty($from)&&!empty($to)){?>
              <?=$from->city_name?> (<?=$from->place_code?>)-<?=$from->place_name?> → <?=$to->city_name?> (<?=$to->place_code?>)-<?=$to->place_name?>
              <?php } ?>
            </span>
            <div class="row">
              <div class="col s3">
                <span class="light"><i class="material-icons inline-text">date_range</i> <?=hari_tgl($date_g)?></span>
              </div>
              <div class="col s2">
                <span class="light"><i class="material-icons inline-text">groups</i> <?=$ps?> Penumpang</span>
              </div>
              <div class="col s2">
               <span class="light"><i class="material-icons inline-text">airline_seat_recline_normal</i> <?=$class?></span>
             </div>
           </div>
           <table class="search">
            <thead class="blue darken-5 white-text">
              <tr>
                <th>Nama Kereta</th>
                <th>Berangkat</th>
                <th></th>
                <th>Tiba</th>
                <th>Durasi</th>
                <th width="15%">Harga Per Orang</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              if(empty($berangkat)){
                ?>
                <tr>
                  <td colspan="6">
                    <center>
                      <i style="font-size: 50px" class="material-icons">hourglass_empty</i><br>
                      <h5 class="light">Pencarian tidak ada hasil</h5>
                    </center>
                  </td>
                </tr>
                <?php
              }else{
                foreach($berangkat as $b){?>
                <tr>
                  <td>
                    <img src="<?=site_url().'assets/images/company_logo/'.$b->company_logo.''?>">
                    <span><?=$b->company_name?></span>
                  </td>
                  <td style="text-align:center">
                    <span class="t"><?=stime($b->depart_time)?></span>
                    <p><?=$b->place_name_from?></p>
                  </td>
                  <td style="text-align:center">
                    <i class="material-icons">keyboard_arrow_right</i>
                  </td>
                  <td style="text-align:center">
                    <span class="t"><?=stime($b->arrive_time)?></span>
                    <p><?=$b->place_name_to?></p>
                  </td>
                  <td>
                    <span class="t"><?=sel_jam($b->depart_at.' '.$b->depart_time,$b->arrive_at.' '.$b->arrive_time)?></span>
                    <p>Langsung</p>
                  </td>
                  <td style="text-align:center">
                    <span class="price blue-text darken-text-5"><?=rupiah($b->price)?></span>
                    <?php if(!empty($_SESSION['cart'])){
                      foreach($_SESSION['cart'] as $c){
                        if($c['id_rute']==$b->id_rute){
                          $text='BATAL';
                          $onclick='delCart';
                          $disabled = '';
                        }else{
                          $text='PILIH';
                          $onclick='addCart';
                          $disabled=' disabled';
                        }
                      }
                      ?>
                      <a id="b<?=$b->id_rute?>" onclick="<?=$onclick?>(<?=$b->id_rute?>,<?=$ps?>)" style="width: 100%" class="btn blue pilih<?=$disabled?>"><?=$text?></a>
                      <?php }else{
                        ?>
                        <a id="b<?=$b->id_rute?>" onclick="addCart(<?=$b->id_rute?>,<?=$ps?>)" style="width: 100%" class="btn blue pilih">Pilih</a>
                        <?php
                      } ?>
                    </td>
                  </tr>
                  <?php }
                } ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
      <?php }else{
        ?>
        <div style="display: none" id="orderBtn">
          <div class="fixed-action-btn">
            <a id="btnPesan" href="#confirm" class="btn btn-large blue darken-2 animated modal-trigger">
              <i class="large material-icons inline-text">shopping_cart</i> Pesan Tiket
            </a>
          </div>
        </div>
        <div class="col s12 m12">
          <div class="card grey lighten-4">
            <div class="card-content">
              <span class="card-title">
                <?php if(!empty($from)&&!empty($to)){?>
                <?=$from->city_name?> (<?=$from->place_code?>)-<?=$from->place_name?> <i class="material-icons inline-text">compare_arrows</i> <?=$to->city_name?> (<?=$to->place_code?>)-<?=$to->place_name?>
                <?php } ?>
              </span>
              <div class="row">
                <div class="col s6 m2">
                  <span class="light"><i class="material-icons inline-text">groups</i> <?=$ps?> Penumpang</span>
                </div>
                <div class="col s6 m2">
                 <span class="light"><i class="material-icons inline-text">airline_seat_recline_normal</i> <?=$class?></span>
               </div>
             </div>
           </div>
         </div>
       </div>
       <div class="col s12 m6">
        <div class="card grey lighten-4">
          <div class="card-content">
            <span class="card-title">Berangkat</span>
            <div class="row">
              <div class="col m12 s12">
                <span class="light"><i class="material-icons inline-text">date_range</i> <?=hari_tgl($date_g)?></span>
              </div>
            </div>
            <table class="search">
              <thead class="blue darken-5 white-text">
                <tr>
                  <th>Nama Kereta</th>
                  <th>Berangkat</th>
                  <th></th>
                  <th>Tiba</th>
                  <th>Durasi</th>
                  <th width="15%">Harga Per Orang</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                if(empty($berangkat)){
                  ?>
                  <tr>
                    <td colspan="6">
                      <center>
                        <i style="font-size: 50px" class="material-icons">hourglass_empty</i><br>
                        <h5 class="light">Pencarian tidak ada hasil</h5>
                      </center>
                    </td>
                  </tr>
                  <?php
                }else{
                  foreach($berangkat as $b){?>
                  <tr>
                    <td>
                      <img src="<?=site_url().'assets/images/company_logo/'.$b->company_logo.''?>">
                      <p><?=$b->company_name?></p>
                    </td>
                    <td style="text-align:center">
                      <span class="t"><?=stime($b->depart_time)?></span>
                      <p><?=$b->place_name_from?></p>
                    </td>
                    <td style="text-align:center">
                      <i class="material-icons">keyboard_arrow_right</i>
                    </td>
                    <td style="text-align:center">
                      <span class="t"><?=stime($b->arrive_time)?></span>
                      <p><?=$b->place_name_to?></p>
                    </td>
                    <td>
                      <span class="t"><?=sel_jam($b->depart_at.' '.$b->depart_time,$b->arrive_at.' '.$b->arrive_time)?></span>
                      <p>Langsung</p>
                    </td>
                    <td style="text-align:center">
                      <span class="price blue-text darken-text-5"><?=rupiah($b->price)?></span>
                      <a id="b<?=$b->id_rute?>" onclick="addCartB(<?=$b->id_rute?>,<?=$ps?>)" style="width: 100%" class="btn blue pilih_b">Pilih</a>
                    </td>
                  </tr>
                  <?php }
                } ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>

      <div class="col s12 m6">
        <div class="card grey lighten-4">
          <div class="card-content">
            <span class="card-title">Pulang</span>
            <div class="row">
              <div class="col m12 s12">
                <span class="light"><i class="material-icons inline-text">date_range</i> <?=hari_tgl($date_b)?></span>
              </div>
            </div>
            <table class="search">
              <thead class="blue darken-5 white-text">
                <tr>
                  <th>Nama Kereta</th>
                  <th>Berangkat</th>
                  <th></th>
                  <th>Tiba</th>
                  <th>Durasi</th>
                  <th width="15%">Harga Per Orang</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                if(empty($pulang)){
                  ?>
                  <tr>
                    <td colspan="6">
                      <center>
                        <i style="font-size: 50px" class="material-icons">hourglass_empty</i><br>
                        <h5 class="light">Pencarian tidak ada hasil</h5>
                      </center>
                    </td>
                  </tr>
                  <?php
                }else{
                  foreach($pulang as $b){?>
                  <tr>
                    <td>
                      <img src="<?=site_url().'assets/images/company_logo/'.$b->company_logo.''?>">
                      <p><?=$b->company_name?></p>
                    </td>
                    <td style="text-align:center">
                      <span class="t"><?=stime($b->depart_time)?></span>
                      <p><?=$b->place_name_from?></p>
                    </td>
                    <td style="text-align:center">
                      <i class="material-icons">keyboard_arrow_right</i>
                    </td>
                    <td style="text-align:center">
                      <span class="t"><?=stime($b->arrive_time)?></span>
                      <p><?=$b->place_name_to?></p>
                    </td>
                    <td>
                      <span class="t"><?=sel_jam($b->depart_at.' '.$b->depart_time,$b->arrive_at.' '.$b->arrive_time)?></span>
                      <p>Langsung</p>
                    </td>
                    <td style="text-align:center">
                      <span class="price blue-text darken-text-5"><?=rupiah($b->price)?></span>
                      <a id="p<?=$b->id_rute?>" onclick="addCartP(<?=$b->id_rute?>,<?=$ps?>)" style="width: 100%" class="btn blue pilih_p">Pilih</a>
                    </td>
                  </tr>
                  <?php }
                } ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
      <?php
    } ?>
  </div>
</div>
</div>

<div id="confirm" class="modal modal-show">
  <div class="modal-content grey lighten-4">
    <h5 class="light">Detail Pesanan</h5>
    <div id="tblorder"></div>
  </div>
  <div class="modal-footer">
    <a class="waves-effect waves-blue btn white blue-text modal-action modal-close">BATAL</a>
    <a href="<?=site_url('order')?>" class="waves-effect waves-light btn blue modal-action modal-close">LANJUTKAN</a>
  </div>
</div>
</main>
