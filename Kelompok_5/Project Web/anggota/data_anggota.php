<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row justify-content-center">
            <div class="col-lg-6">     
                <div class="card">
                   <div class="card-header">
                    <center><strong>Data Pribadi Anggota Koperasi Kesejahteraan Keluarga</strong></center>
                </div>
                <div class="card-body card-block">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal"> 

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Nama</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="nama" name="nama" placeholder="" disabled="" value="<?php echo $data['nama'] ?>" class="form-control">
                                </div></div>           

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Tanggal Daftar</label></div>
                                    <div class="col-12 col-md-9"><input type="text" id="daftar" name="daftar" placeholder=""  value="<?php echo $data['tgl_daftar'] ?>" disabled="" class="form-control">
                                    </div></div>           

                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Tempat Lahir</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="tl" name="tl" placeholder="" disabled=""  value="<?php echo $data['tempat_lahir'] ?>" class="form-control"></div></div>

                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Tanggal Lahir</label></div>
                                            <div class="col-12 col-md-9"><input type="text" id="tanggal_lahir" name="tanggal_lahir" placeholder="" value="<?php echo $data['tgl_lahir'] ?>" disabled="" class="form-control"></div></div>

                                            <div class="row form-group">
                                                <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Gender</label></div>
                                                <div class="col-12 col-md-9"><input type="text" id="gender" name="gender" placeholder="" disabled=""  value="<?php echo $data['jenis_kelamin'] ?>" class="form-control"></div></div>

                                                <div class="row form-group">
                                                    <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Alamat</label></div>
                                                    <div class="col-12 col-md-9"><input type="text" id="alamat" name="alamat" placeholder="" value="<?php echo $data['alamat'] ?>" disabled="" class="form-control"></div></div>


                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>












                            </div><!-- .animated -->
        </div><!-- .content -->