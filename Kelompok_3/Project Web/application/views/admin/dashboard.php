<main>
  <div class="container">
    <div class="admin-title">
      <div class="row">
        <div class="col m6 s12">
          <h4 class="light"><?=$title?></h4>
        </div>
        <div class="col m6 s12">
         <div class="nav-breadcrumb blue">
          <a href="#!" class="breadcrumb">Admin</a>
          <a href="#!" class="breadcrumb"><?=$title?></a>
        </div>
      </div>
    </div>
  </div>
  <!--card stats start-->
  <div class="card-stats">
    <div class="row">
      <div class="col s12 m6 l3">
        <div class="card stats">
          <div class="card-content  teal white-text">
            <p><i class="material-icons inline-text">group_add</i> Pengguna Baru</p>
            <h4 ><?=$b_user?></h4>
            <p>Total <?=$a_user?> Pengguna</p>
          </div>
          <div class="card-action teal darken-2 white-text">
            <a href="<?=site_url('admin/costumer')?>"><i class="material-icons inline-text">chevron_right</i>Selengkapnya</a>
          </div>
        </div>
      </div>
      <div class="col s12 m6 l3">
        <div class="card stats">
          <div class="card-content  cyan white-text">
            <p><i class="material-icons inline-text">shopping_cart</i> Pesanan Baru</p>
            <h4><?=$b_order?></h4>
            <p>Total <?=$a_order?> Pesanan</p>
          </div>
          <div class="card-action cyan darken-2 white-text">
            <a href="<?=site_url('admin/order')?>"><i class="material-icons inline-text">chevron_right</i>Selengkapnya</a>
          </div>
        </div>
      </div>
      <div class="col s12 m12 l6">
        <div class="card stats">
          <div class="card-content  indigo white-text">
            <p><i class="material-icons inline-text">attach_money</i> Pemasukan Pada Hari Ini</p>
            <h4 ><?=rupiah($b_in)?></h4>
            <p> Total Kelesuruhan <span class="indigo-text text-lighten-5"><?=rupiah($a_in)?></span>
            </p>
          </div>
          <div class="card-action indigo darken-2 white-text">
            <a href="<?=site_url('admin/order')?>"><i class="material-icons inline-text">chevron_right</i>Selengkapnya</a>
          </div>
        </div>
      </div>
<!--                             <div class="col s12 m6 l3">
                                <div class="card stats">
                                    <div class="card-content  light-blue white-text">
                                        <p><i class="material-icons inline-text">group_add</i> New Clients</p>
                                        <h4 >566</h4>
                                        <p>15% <span class="light-blue-text text-lighten-5">from yesterday</span>
                                        </p>
                                    </div>
                                    <div class="card-action light-blue darken-2 white-text">
                                      <a href=""><i class="material-icons inline-text">chevron_right</i>Selengkapnya</a>
                                    </div>
                                </div>
                              </div> -->
                            </div>
                          </div>
                          <div class="row">
                            <div class="col m8 s12">      
                              <div class="card grey lighten-4">
                                <div class="title-card grey lighten-4">Statistik Pendapatan Tahun Ini</div>
                                <div class="card-content white">
                                  <div class="container">
                                    <canvas id="myChart"></canvas>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col m4 s12">      
                              <div class="card grey lighten-4">
                                <div class="title-card grey lighten-4">Statistik Penjualan Per Transportasi</div>
                                <div class="card-content white">
                                  <div class="container">
                                    <canvas id="myChartt"></canvas>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
<!--                     <div class="row">
                      <div class="alert blue">Tes </div>
                      <div class="alert green">Tes </div>
                      <div class="alert red">Tes </div>
                      <div class="alert orange">Tes </div>
                      <div class="alert blue strip-blue">Tes</div>
                      <div class="alert blue strip-green">Tes</div>
                      <div class="alert blue strip-red">Tes</div>
                      <div class="alert blue strip-orange">Tes</div>
                    </div> -->
                  </div>
                </main>  