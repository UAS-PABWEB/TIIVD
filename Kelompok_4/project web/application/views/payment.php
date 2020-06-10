<div class="container">
  <div class="row">
    <div class="col-md-12" style="margin-top: 60px;">
      <div class="card">
        <div class="card-header">
          Pembayaran
        </div>
        <div class="card-body">
          <h1 class="display-4">Pemesanan dalam proses</h1>
          <p><span class="text-bold text-purple">Kode Booking</span> : <?=$detail->kode_booking?></p>
          <p>Silahkan lakukan pembayaran sebesar : </p>
          <p class="badge badge-primary" style="font-size: 30px;font-weight: 300"><?=rupiah($detail->total_bayar)?></p><br>
          <?php 
            if($detail->jenis_pembayaran=='cash'){
              ?>
          Tunjukan halaman ini kepada resepsionis dan lakukan pembayaran anda.
              <?php
            }else{
          ?>
          Ke rekening dibawah ini, dan upload bukti transfer ke form yang telah disediakan.<br>
          <div class="card" style="width: 400px;">
            <div class="card-body">
              <span class="text-bold">BCA</span>  : 142820103<br>
              <span class="text-bold">MANDIRI</span> : 1201390124444
            </div>
          </div>
        <?php } ?>
          <br>
          <a href="<?=base_url('order/detail/'.$detail->id_pesanan)?>" class="btn btn-primary float-right">Cek Status Pemesanan</a>
        </div>
      </div>
    </div>
  </div>
</div>