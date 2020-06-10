<div class="container">
  <div class="row">
    <div class="col-md-12" style="margin-top: 60px;">
      <div class="card">
        <div class="card-header">
          Detail Pesanan 
          <span class="float-right"><?=status_pembayaran($detail->status_pembayaran)?></span>
        </div>
        <div class="card-body">
          <?=$this->session->flashdata('message')?>
          <?php if($detail->status_pembayaran=='proses_verifikasi'){
            ?>
            <div class="alert alert-warning" role="alert">
              <h4 class="alert-heading">Pembayaran memerlukan verifikasi</h4>
              <p class="mb-0">Klik <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" class="alert-link">disini</a> untuk melihat bukti transfer</p>
            </div>
            <hr>
            <?php
          }
          ?>
          <div class="form-group">
            <label class="text-purple text-bold">Nama Lengkap</label>
            <p><?=$detail->nama?></p>
          </div>
          <div class="form-group">
            <label class="text-purple text-bold">Nomor HP</label>
            <p><?=$detail->no_hp?></p>
          </div>
          <div class="form-group">
            <label class="text-purple text-bold">Alamat</label>
            <p><?=$detail->alamat?></p>
          </div>  
          <?php if($detail->status_pembayaran=='sudah_dibayar'){
            ?>
          <div class="form-group">
            <label class="text-purple text-bold">Nomor Kamar</label>
            <p><span class="badge badge-primary"><?=$detail->nomor_kamar?></span></p>
          </div>
            <?php
          }
          ?>
          <hr>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="text-purple text-bold">Kode Booking</label>
                <p>#<?=$detail->kode_booking?></p>
              </div>
              <div class="form-group">
                <label class="text-purple text-bold">Tanggal Pesan</label>
                <p><?=tanggal($detail->tgl_pesan)?></p>
              </div>
              <div class="form-group">
                <label class="text-purple text-bold">Total Bayar</label>
                <p><?=rupiah($detail->total_bayar)?></p>
              </div>
              <div class="form-group">
                <label class="text-purple text-bold">Jenis Pembayaran</label>
                <p><?=ucwords($detail->jenis_pembayaran)?></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="text-purple text-bold">Apartemen</label>
                <p><?=$detail->nama_apartemen?> - <?=$detail->nama_kota?></p>
              </div>
              <div class="form-group">
                <label class="text-purple text-bold">Paket</label>
                <p><?=$detail->jumlah_paket?> <?=$paket?></p>
              </div>
              <div class="form-group">
                <label class="text-purple text-bold">Check In</label>
                <p><?=tanggal($detail->checkin)?></p>
              </div>
              <div class="form-group">
                <label class="text-purple text-bold">Check Out</label>
                <p><?=tanggal($checkout)?></p>
              </div>
            </div>
          </div>
          <hr>
          <?php 
            if(($detail->jenis_pembayaran=='transfer'&&$detail->status_pembayaran=='proses_verifikasi')||($detail->jenis_pembayaran=='cash'&&$detail->status_pembayaran=='belum_dibayar')){
              ?>
          <a href="javascript:void(0)" data-toggle="modal" data-target="#terimaModal" class="btn btn-success">Terima</a>
          <a href="<?=base_url('order/verification_detail/'.$detail->id_pesanan.'/reject')?>" class="btn btn-danger">Tolak</a>
              <?php
            }else{
              ?>
          <a href="javascript:void(0)" class="btn btn-success disabled">Terima</a>
          <a href="javascript:void(0)" class="btn btn-danger disabled">Tolak</a>
              <?php
            }
          ?>
          <a href="<?=base_url('order/verification')?>" class="btn btn-light float-right">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bukti Transfer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img class="img-thumbnail img-fluid" src="<?=base_url('assets/images/bukti_transfer/'.$detail->bukti_transfer)?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="terimaModal" tabindex="-1" role="dialog" aria-labelledby="terimaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="terimaModalLabel">Input Nomor Kamar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?=base_url('order/verification_detail/'.$detail->id_pesanan.'/accept')?>">
          <div class="form-group">
            <label>Nomor Kamar</label>
            <input type="text" class="form-control" name="nomor_kamar">
          </div>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Terima</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </form>
      </div>
    </div>
  </div>
</div>