<div class="container">
  <div class="row">
    <div class="col-md-12" style="margin-top: 60px;">
      <div class="card">
        <div class="card-header">
          Profil
        </div>
        <div class="card-body">

          <?=form_open_multipart()?>
          <?=$this->session->flashdata('message')?>

        <div class="form-group">
          <label for="exampleInputEmail1">Nama Lengkap</label>
          <input type="text" value="<?=$detail->nama?>" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Nama Lengkap">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Alamat</label>
          <textarea name="alamat" class="form-control" placeholder="Masukan Alamat"><?=$detail->alamat?></textarea>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Nomor HP</label>
          <input type="text" name="no_hp" value="<?=$detail->no_hp?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Nomor HP">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Username</label>
          <input type="text" name="username" value="<?=$detail->username?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Username">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Password</label>
          <input type="Password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Kosongkan jika tidak ingin mengganti">
        </div>

          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>