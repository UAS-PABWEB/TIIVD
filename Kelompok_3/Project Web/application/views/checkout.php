<main>
  <div class="page-header blue white-text">
    <h4 class="light">Isi Data</h4>
  </div>
  <div class="page-content">
   <div class="container">
    <div class="row">
      <div class="col s12 no-padding">

        <div class="card grey lighten-4">
          <div class="card-tabs">
            <ul class="tabs tabs-fixed-width tabs-transparent">
              <li class="tab"><a class="blue-text" href="#data"><span class="label blue">1</span> Isi Data</a></li>
              <li class="tab"><a class="blue-text" href="#payment"><span class="label blue">2</span> Pembayaran</a></li>
              <li class="tab disabled"><a class="blue-text" href="#test2"><span class="label blue">3</span> Selesai</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div id="data">
      <form id="orderForm">
        <div class="row">
          <div class="col m8">
            <div class="card grey lighten-4">
              <div class="title-card grey lighten-4">Data Pemesan</div>
              <div class="card-content white">
                <div class="row">
                  <div class="input-field col m12">
                    <i class="material-icons prefix">persons</i>
                    <input type="text" name="buyer_name">
                    <label for="icon_prefix">Nama Lengkap</label>
                  </div>
                  <div class="input-field col m6">
                    <i class="material-icons prefix">local_phone</i>
                    <input type="text" name="buyer_phone">
                    <label for="icon_prefix">No. Handphone</label>
                  </div>
                  <div class="input-field col m6">
                    <i class="material-icons prefix">email</i>
                    <input type="text" name="buyer_email">
                    <label for="icon_prefix">Email</label>
                  </div>
                </div>
              </div>
            </div>
            <ul class="collapsible" data-collapsible="accordion">
              <?php
              $jml = 0;
              foreach($cart as $c){
                $jml = $c['jumlah'];
              }
              for ($i=1; $i <= $jml ; $i++) {
               ?>
               <li>
                <div class="collapsible-header grey lighten-4 <?php if($i==1) echo"active"; ?>">Data Penumpang <?=$i?></div>
                <div class="collapsible-body white">
                  <div class="row">

                    <div class="input-field col m4">
                      <i class="material-icons prefix">title</i>       
                      <select name="p_title<?=$i?>">
                        <option value=""></option>
                        <option value="Tn">Tuan</option>
                        <option value="Ny">Nyonya</option>
                      </select>
                      <label for="icon_prefix">Titel</label>
                    </div>
                    <div class="input-field col m8">
                      <i class="material-icons prefix">persons</i>
                      <input type="text" name="p_full_name<?=$i?>">
                      <label for="icon_prefix">Nama Lengkap</label>
                    </div>
                  </div>
                </div>
              </li>
              <?php } ?>
            </ul>
          </div>
          <div class="col m4">
            <div class="card grey lighten-4">
              <div class="title-card grey lighten-4"><i class="material-icons inline-text blue-text">shopping_cart</i> Pesanan Anda</div>
              <div class="card-content white">
                <?php foreach($cart as $c){
                  $i = $this->m_general->gRuteW($c['id_rute']);
                  ?>
                  <div class="row">
                    <b><?=hari_tgl($i[0]->depart_at)?></b><br>
                    <table>
                      <tr>
                        <td width="80px">
                          <img style="width: 60px" src="<?=site_url()."assets/images/company_logo/".$i[0]->company_logo?>"></td>
                          <td><?=$i[0]->company_name?><br><span class="light"><?=$i[0]->class_name?></span>
                          </td>
                        </tr>
                      </table>
                      <table class="detail">
                        
                        <tbody>
                          <tr>
                            <td style="text-align:center">
                              <span class="t"><?=stime($i[0]->depart_time)?></span>
                              <p style="text-align:center"><?=$i[0]->place_name_from?></p>
                            </td>
                            <td style="text-align:center">
                              <i class="material-icons inline-text blue-text">arrow_forward</i>
                            </td>
                            <td style="text-align:center">
                              <span class="t"><?=stime($i[0]->arrive_time)?></span>
                              <p style="text-align:center"><?=$i[0]->place_name_to?></p>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <a id="goPayment" class="btn blue btn-large" style="width: 100%">
                  <i class="material-icons inline-text">chevron_right</i> Lanjutkan ke Pembayaran</a>
                </div>
              </div>
            </div>
            <div id="payment">    
              <div class="row">
                <div style="display: none" id="progress">
                  <div class="col m12">
                    <center><h5 class="light"><i class="material-icons inline-text">payment</i> Memproses Pembayaran</h5>
                      <p>Pesanan anda sedang dalam proses, silahkan tunggu beberapa saat</p></center>
                      <div class="progress blue lighten-4">
                        <div class="indeterminate blue"></div>
                      </div>
                    </div> 
                  </div>
                  <div id="menu">
                    <div class="col m8">
                      <div class="card grey lighten-4">
                        <div class="title-card grey lighten-4">Metode Pembayaran</div>
                        <div class="card-content white">
                          <div class="row">
                            <div class="col m6">
                              <input type="radio" name="method" value="1" id="test1">
                              <label for="test1">Transfer Bank</label>
                            </div>
                            <div class="col m6">
                              <input type="radio" name="method" value="2" id="test2">
                              <label for="test2">Kartu Kredit</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="kartu" class="card grey lighten-4">
                        <div class="title-card grey lighten-4"><i class="material-icons inline-text blue-text">credit_card</i> Informasi Kartu Kredit</div>
                        <div class="card-content white">
                          <div class="row">
                            <div class="input-field col m6">
                              <input type="text" name="optionsRadios">
                              <label for="icon_prefix">Nama Pemegang Kartu</label>
                            </div>
                            <div class="input-field col m6">
                              <input type="text" name="optionsRadios">
                              <label for="icon_prefix">Nomor Kartu</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="input-field col m3">    
                              <select name="kelas">
                                <option value="">Bulan</option>
                                <option value="1">VIP</option>
                                <option value="2">Bisnis</option>
                                <option value="3">Ekonomi</option>
                              </select>
                              <label for="icon_prefix">Kadaluarsa</label>
                            </div>
                            <div class="input-field col m3">
                              <select name="kelas">
                                <option value="">Tahun</option>
                                <option value="1">VIP</option>
                                <option value="2">Bisnis</option>
                                <option value="3">Ekonomi</option>
                              </select>
                            </div>
                            <div class="input-field col m6">
                              <input type="text" name="optionsRadios">
                              <label for="icon_prefix">CVV</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="transfer" class="card grey lighten-4">
                        <div class="title-card grey lighten-4"><i class="material-icons inline-text blue-text">attach_money</i> Informasi Bank</div>
                        <div class="card-content white">
                          <div class="row">
                            <div class="input-field col m6">
                              <input type="text" name="optionsRadios">
                              <label for="icon_prefix">Nama Akun</label>
                            </div>
                            <div class="input-field col m6">
                              <select name="kelas">
                                <option value="">Pilih Bank</option>
                                <option value="1">BCA</option>
                                <option value="2">BNI</option>
                                <option value="3">BRI</option>
                              </select>
                              <label for="icon_prefix">Bank</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="input-field col m12">
                              <input type="text" name="optionsRadios">
                              <label for="icon_prefix">Nomor Rekening</label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="card grey lighten-4">
                        <div class="title-card grey lighten-4">Rincian Harga</div>
                        <div class="card-content white">
                          <table class="light">
                            <?php 
                            $total = 0 ;
                            foreach($cart as $c){
                              $i = $this->m_general->gRuteW($c['id_rute']);
                              $harga = $i[0]->price*$c['jumlah'];
                              $total = $total+$harga;
                              ?>
                              <tr>
                                <td  style="width:60%"><?=$i[0]->company_name?></td>
                                <td style="text-align: right;"><b><?=rupiah($i[0]->price)?> </b> x <?=$c['jumlah']?> Penumpang</td>
                              </tr>
                              <?php } ?>
                              <tr id="promo-t" style="display: none">
                                <td id="code" style="width:60%">2</td>
                                <td id="min" style="text-align: right;"><b>2</b></td>
                              </tr>
                              <tr>
                                <td>Total</td>
                                <td style="text-align: right;"><b class="total blue-text"><?=rupiah($total)?></b></td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="col m4 s12">
                       <div class="card grey lighten-4">
                        <div class="title-card grey lighten-4">Kode Promo</div>
                        <div class="card-content white">
                          <div class="row">
                            <div id="msg"></div>
                          </div>
                          <div class="row">
                            <div class="input-field col m8 s8">
                              <input type="text" name="promo_code" id="kode" placeholder="Masukkan Kode Promo">
                              <label for="icon_prefix">Kode Promo</label>
                            </div>
                            <div class="input-field col m4 s4">
                              <a onclick="cekCode(<?=$total?>)" class="btn blue">Cek</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card grey lighten-4">
                        <div class="title-card grey lighten-4"><i class="material-icons inline-text blue-text">attach_money</i> Total</div>
                        <div class="card-content white">
                          <span>Total Harga</span>
                          <h4 class="light total blue-text"><?=rupiah($total)?></h4>
                        </div>
                      </div>
                      <button type="submit" id="pay" class="btn blue btn-large" style="width: 100%">
                        <i class="material-icons inline-text">check</i> Lakukan Proses Pembayaran</button>
                      </form>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </main>
