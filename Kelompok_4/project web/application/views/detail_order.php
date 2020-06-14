<div class="container">
  <div class="row">
    <div class="col-md-12" style="margin-top: 60px;">
      <div class="card">
        <div class="card-header">
          Detail Pesanan 
          <span class="float-right"><?=status_pembayaran($detail->status_pembayaran)?></span>
        </div>
        <div class="card-body">
          <?php 
          if($detail->status_pembayaran=='belum_dibayar'){
            if($detail->jenis_pembayaran=='cash'){
              ?>
              <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Silahkan lakukan pembayaran</h4>
                <p class="mb-0">Untuk menyelesaikan pembayaran ini, silakan menuju ke resepsionis dan tunjukan halaman ini.</p>
              </div>
              <hr>
              <?php
            }elseif($detail->jenis_pembayaran=='transfer'){
              ?>
              <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Silahkan lakukan pembayaran</h4>
                <p class="mb-0">Untuk menyelesaikan pembayaran ini, transfer sejumlah <b><?=rupiah($detail->total_bayar)?></b> ke Rekening 142820103 (BCA) / 1201390124444 (MANDIRI).<br>
                Apabila sudah, silahkan upload bukti transfer pada form dibawah ini</p>
              </div>
              <?=form_open_multipart()?>
              <div class="card">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Bukti Transfer</label>
                    <small class="text-bold">*File yang diizinkan : jpg,png,jpeg</small><br>
                    <input type="file" name="bukti_transfer" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Upload</button>
                </form>
              </div>
            </div>
            <hr>
            <?php
          }
        }elseif($detail->status_pembayaran=='proses_verifikasi'){
          ?>
              <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Pembayaran dalam proses verifikasi</h4>
                <p class="mb-0">Bukti transfer anda sudah kami terima dan sedang dalam tahap verifikasi, silahkan cek halaman ini secara bekala.</p>
              </div>
            <hr>
          <?php
        }elseif($detail->status_pembayaran=='sudah_dibayar'){
          ?>
              <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Pembayaran berhasil</h4>
                <p class="mb-0">Silahkan tunjukan halaman ini kepada resepsionis apartemen untuk mendapatkan kunci kamar apartemen anda.</p>
              </div>
              <b>Nomor Kamar Anda</b> : <span class="badge badge-primary"><?=$detail->nomor_kamar?></span>
            <hr>
          <?php
        }
        ?>
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
        <a href="<?=base_url('order/my')?>" class="btn btn-light float-right">Kembali</a>
      </div>
    </div>
  </div>
</div>
</div>