<main>
	<div class="page-content">
   <div class="container">
    <div class="row">
      <div class="col m4">
        <?php $this->load->view('user/nav') ?>
      </div>
      <div class="col m8">
        <div class="card grey lighten-4">
          <div class="title-card grey lighten-4">Pembelian</div>
          <div class="card-content white"> 
            <div class="row">
              <table class="bordered responsive-table striped">
                <thead>
                  <tr>
                    <th>No Order</th>
                    <th>Waktu</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(empty($list)){
                    ?>
                    <tr>
                      <td colspan="4">
                        <center>
                          <i style="font-size: 50px" class="material-icons">shoppinh_cart</i><br>
                          <h5 class="light">Anda belum melakukan pembelian</h5>
                        </center>
                      </td>
                    </tr>
                    <?php
                  }else{ ?>
                  <?php foreach($list as $l){
                    if($l->status=='Terbayar'){
                      $color = "green";
                    }elseif($l->status=='Tertunda'){
                      $color = "orange";
                    }elseif($l->status=='Batal'){
                      $color = "red";
                    }
                    ?>
                    <tr>
                      <td><?=$l->id_order?></td>
                      <td><?=tgl_indo($l->order_date)?> , <?=stime($l->order_time)?></td>
                      <td><span class="label-flat <?=$color?>"><?=$l->status?></span></td>
                      <td><a href="<?=site_url('user/order_detail/'.$l->id_order.'')?>" class="btn waves-effect waves-light">Detail</a></td>
                    </tr>
                    <?php } 
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</main>
