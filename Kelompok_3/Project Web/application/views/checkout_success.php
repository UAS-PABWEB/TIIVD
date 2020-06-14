<main>
  <div class="page-header blue white-text">
    <h4 class="light">Selesai</h4>
  </div>
  <div class="page-content">
   <div class="container">
    <div class="row">
      <div class="col s12 no-padding">

        <div class="card grey lighten-4">
          <div class="card-tabs">
            <ul class="tabs tabs-fixed-width tabs-transparent">
              <li class="tab disabled"><a class="blue-text" href="#test1"><span class="label blue">1</span> Isi Data</a></li>
              <li class="tab disabled"><a class="blue-text" href="#test2"><span class="label blue">2</span> Pembayaran</a></li>
              <li class="tab"><a class="blue-text active" href="#test2"><span class="label blue">3</span> Selesai</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col m12 no-padding">
       <div class="card">
        <div class="card-content white">
          <center>
            <h4 class="light"><i style="font-size: 100px" class="material-icons inline-text green-text">check_circle</i>
              <br>Terimakasih, pesanan anda telah kami terima</h4></center>
              <div style="padding-top: 40px" class="row">
                <h5 class="light">Detail Pesanan</h5>
                <table>
                  <thead>
                    <tr>
                      <th>No Pesanan</th>
                      <th>Nama Pemesan</th>
                      <th>Email</th>
                      <th>No.HP</th>
                      <th>Metode Pembayaran</th>
                      <th>Total</th>
                      <th>Status</th>
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
                      <td><?=$o->status?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="row" style="margin-top: 40px">
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
          <div class="row"><!-- 
            <a class="btn blue">Button</a>
            <a class="btn blue">Button</a> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</main>
