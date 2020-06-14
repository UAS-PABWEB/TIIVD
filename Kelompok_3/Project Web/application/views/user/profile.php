<main>
	<div class="page-content">
   <div class="container">
    <div class="row">
      <div class="col m4">
        <?php $this->load->view('user/nav') ?>
      </div>
      <div class="col m8">
        <div class="card grey lighten-4">
          <div class="title-card grey lighten-4">Ubah Profil</div>
          <div class="card-content white"> <div class="row">
            <?=$this->session->flashdata('pesan')?>
            <div class="card grey lighten-4">
              <div class="card-tabs">
                <ul class="tabs tabs-fixed-width tabs-transparent">
                  <li class="tab"><a class="blue-text" href="#profile">Profil</a></li>
                  <li class="tab"><a class="blue-text" href="#password">Kata Sandi</a></li>
                </ul>
              </div>
            </div>
            <div class="container">
              <div id="profile" class="col s12">
                <?=form_open('user/p_profile')?>
                <div class="row">
                  <div class="input-field">
                    <i class="material-icons prefix">person</i>   
                    <input value="<?=$info->full_name?>" name="full_name" id="icon_prefix" type="text">
                    <label>Nama Lengkap</label>
                  </div>
                  <div class="input-field">
                    <i class="material-icons prefix">email</i>   
                    <input name="email" id="icon_prefix" value="<?=$info->email?>" type="text">
                    <label>Alamat Email</label>
                  </div>
                  <div class="input-field">
                    <i class="material-icons prefix">phone</i>   
                    <input name="phone" id="icon_prefix" value="<?=$info->phone?>" type="text">
                    <label>No. Handphone</label>
                  </div>
                  <div class="input-field">
                    <i class="material-icons prefix">home</i>   
                    <textarea name="address" class="materialize-textarea"><?=$info->address?></textarea>
                    <label>Alamat</label>
                  </div>
                  <button type="submit" class="btn blue"><i class="material-icons inline-text">save</i> Simpan</button>
                  <?=form_close()?>
                </div>
              </div>
              <div id="password" class="col s12">
                <?=form_open('user/p_password')?>
                <div class="row">
                  <div class="input-field">
                    <i class="material-icons prefix">lock_outline</i>
                    <input type="password" name="o_password">
                    <label>Kata Sandi Lama</label>
                  </div>
                  <div class="input-field">
                    <i class="material-icons prefix">lock</i>
                    <input type="password" name="password">
                    <label>Kata Sandi Baru</label>
                  </div>
                  <div class="input-field">
                    <i class="material-icons prefix">lock</i>
                    <input type="password" name="c_password">
                    <label>Ulangi Kata Sandi Baru</label>
                  </div>
                  <button type="submit" class="btn blue"><i class="material-icons inline-text">save</i> Simpan</button>
                  <?=form_close()?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</main>
