<main>
	<div class="page-content">
   <div class="container">
    <div class="row">
      <div class="col m4">
        <?php $this->load->view('user/nav') ?>
      </div>
      <div class="col m8">
        <div class="card grey lighten-4">
          <div class="title-card grey lighten-4">Permintaan Pembatalan Pembelian </div>
          <div class="card-content white"> 
            <div class="row">
              <?=form_open('user/p_cancel')?>
              <div class="input-field">
                <i class="material-icons prefix">shopping_cart</i>   
                <input value="<?=$id_order?>" name="id_order" id="icon_prefix" type="text">
                <label>ID Pesanan</label>
              </div>
              <div class="input-field">
                <i class="material-icons prefix">offline_pin</i>   
                <textarea name="reason" class="materialize-textarea" required=""></textarea>
                <label>Alasan</label>
              </div>
              <input type="hidden" name="id_costumer" value="<?=$this->session->userdata('auth_user')?>">
              <button type="submit" class="btn blue"><i class="material-icons inline-text">done</i> KIRIM</button>
              <?=form_close()?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
