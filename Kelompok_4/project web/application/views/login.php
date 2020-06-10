<div class="container">
  <div class="col-md-6 offset-md-3" style="margin-top: 60px;">
    <div class="card">
      <div class="card-header">
        Masuk | NginapMurah.com
      </div>
      <div class="card-body">
        <?=form_open('account/auth')?>
        <?=$this->session->flashdata('message')?>
        <div class="form-group">
          <label for="exampleInputEmail1">Username</label>
          <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Username">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Masukan Password">
        </div>
        <div class="form-group">
        Belum mempunyai akun? <a href="<?=base_url('account/register')?>">Daftar</a>
      </div>
        <button type="submit" class="btn btn-primary">Masuk</button>
      </form>
    </div>
  </div>
</div>
</div>