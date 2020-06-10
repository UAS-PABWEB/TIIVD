<div class="container">
  <div class="col-md-6 offset-md-3" style="margin-top: 60px;">
  <div class="card">
    <div class="card-header">
      Daftar | NginapMurah.com
    </div>
    <div class="card-body">
        <?=form_open('account/registerProccess')?>
        <?=$this->session->flashdata('message')?>
        <div class="form-group">
          <label for="exampleInputEmail1">Nama Lengkap</label>
          <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Nama Lengkap">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Alamat</label>
          <textarea name="alamat" class="form-control" placeholder="Masukan Alamat"></textarea>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Nomor HP</label>
          <input type="text" name="no_hp" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Nomor HP">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Username</label>
          <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Username">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Masukan Password">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Konfirmasi Password</label>
          <input type="password" name="c_password" class="form-control" id="exampleInputPassword1" placeholder="Masukan Konfirmasi Password">
        </div>
        <div class="form-group">
        Sudah mempunyai akun? <a href="<?=base_url('account/login')?>">Masuk</a>
      </div>
        <button type="submit" class="btn btn-primary">Daftar</button>
      </form>
    </div>
  </div>
</div>
</div>