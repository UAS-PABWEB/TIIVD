<main>
	<div class="page-content">
   <div class="container">
    <div class="row">
      <div class="col m4">
        <?php $this->load->view('user/nav') ?>
      </div>
      <div class="col m8">
        <div class="card grey lighten-4">
          <?php 
          if($o->status=='Terbayar'){
            $color = "green";
          }elseif($o->status=='Tertunda'){
            $color = "orange";
          }elseif($o->status=='Batal'){
            $color = "red";
          }
          ?>
          <div class="title-card grey lighten-4">Detail Pembelian <span class="right label-flat <?=$color?>"><?=$o->status?></span></div>
          <div class="card-content white">  
            <div class="row">
              <?=$this->session->flashdata('pesan')?>
            </div>
            <div class="row">    
              <?php if($o->status=='Terbayar'){ ?>             
              <a target="blank" href="<?=site_url('user/e_ticket/'.$o->id_order.'')?>" class="btn blue"><i class="material-icons inline-text">print</i> CETAK E-TIKET</a> 
              <?php }else{
                ?>         
                <a class="btn blue disabled"><i class="material-icons inline-text">print</i> CETAK E-TIKET</a> 
                <?php
              } ?>

              <?php 

              $tgl = '';
              $v=0;
              foreach($res as $r){
                $i = $this->m_general->gRuteW($r->id_rute);
                if($v==0){
                  $tgl = $i[0]->depart_at.' '.$i[0]->depart_time;
                }
                $v++;
              }
              ?>

              <?php if($tgl<=date('Y-m-d H:i:s'&&$o->status=='Terbayar')){ ?>  
                <a href="<?=site_url('user/order_cancel/'.$o->id_order.'')?>" class="btn red"><i class="material-icons inline-text">not_interested</i> PEMBATALAN</a>
                <?php }else{
                  ?>    
                  <a class="btn red disabled"><i class="material-icons inline-text">not_interested</i> PEMBATALAN</a>
                  <?php
                } ?>
              </div>
              <div>
                <h5 class="light">Detail Pesanan</h5>
                <table>
                  <thead>
                    <tr>
                      <th>No Pesanan</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>No.HP</th>
                      <th>Metode Pembayaran</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>#<?=$o->id_order?></td>
                      <td><?=$o->buyer_name?></td>
                      <td><?=$o->buyer_email?></td>
                      <td><?=$o->buyer_phone?></td>
                      <td><?=$o->payment_type_name?></td>
                      <td><?=rupiah($o->final_price)?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div style="margin-top: 40px">
                <h5 class="light">Detail Perjalanan</h5>
                <?php foreach($res as $r){
                  $i = $this->m_general->gRuteW($r->id_rute);
                  ?>
                  <b><?=hari_tgl($i[0]->depart_at)?></b><br>
                  <table class="detail">
                    <tbody>
                      <tr>
                        <td width="80px">
                          <img style="width: 60px" src="<?=site_url()."assets/images/company_logo/".$i[0]->company_logo?>"></td>
                          <td><?=$i[0]->company_name?><br><span class="light"><?=$i[0]->class_name?></span>
                          </td>
                          <td style="text-align:center">
                            <span class="t"><?=stime($i[0]->depart_time)?></span>
                            <p style="text-align:center"><?=$i[0]->place_name_from?>-<?=$i[0]->p_name_from?></p>
                          </td>
                          <td style="text-align:center">
                            <i class="material-icons inline-text blue-text">arrow_forward</i>
                          </td>
                          <td style="text-align:center">
                            <span class="t"><?=stime($i[0]->arrive_time)?></span>
                            <p style="text-align:center"><?=$i[0]->place_name_to?>-<?=$i[0]->p_name_to?></p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
