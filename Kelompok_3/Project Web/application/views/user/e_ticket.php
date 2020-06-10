                     
<link rel="stylesheet" href="<?="assets/"?>css/materialize.css">
<link rel="stylesheet" href="<?="assets/"?>css/style.css">
<style type="text/css">
body{
  background-color: #fff;
  color: black !important;
}
.head-ticket{
  border-bottom: solid 2px black;
  padding-bottom: 10px;
}
.light{
  font-weight: 300;
}
</style>
<div>
  <div class="head-ticket">
   <center>
     <img style="width: 300px" src="assets/images/logo.png">
   </center>
 </div>
 <center><b style="font-size: 20px">E - TIKET</b></center>
 <div>
  <table style="margin-top: -40px">
    <tbody>
      <tr>
       <td width="30%"></td>
       <td></td>
     </tr>
     <tr>
       <td width="30%"><b>No Pesanan</b></td>
       <td>#<?=$o->id_order?></td>
     </tr>
     <tr>
       <td><b>Nama Pembeli</b></td>
       <td><?=$o->buyer_name?></td>
     </tr>
     <tr>
       <td><b>Email</b></td>
       <td><?=$o->buyer_email?></td>
     </tr>
     <tr>
       <td><b>No HP</b></td>
       <td><?=$o->buyer_phone?></td>
     </tr>
   </tbody>
 </table>
</div>
<div style="margin-top: 40px">
  <h5 class="light">Detail Perjalanan</h5>
  <?php foreach($res as $r){
    $i = $this->m_general->gRuteW($r->id_rute);
    ?>
    <b><?=hari_tgl($i[0]->depart_at)?></b><br>
    <table class="detail">
      <tr>
        <td>
          <img style="width: 60px" src="<?="assets/images/company_logo/".$i[0]->company_logo?>"></td>
          <td><?=$i[0]->company_name?><br><span class="light"><?=$i[0]->class_name?></span>
          </td>
          <td style="text-align:center">
            <span class="t"><?=stime($i[0]->depart_time)?></span>
            <p style="text-align:center"><?=$i[0]->place_name_from?>-<?=$i[0]->p_name_from?></p>
          </td>
          <td style="text-align:center">
            ke
          </td>
          <td style="text-align:center">
            <span class="t"><?=stime($i[0]->arrive_time)?></span>
            <p style="text-align:center"><?=$i[0]->place_name_to?>-<?=$i[0]->p_name_to?></p>
          </td>
        </tr>
      </table>
      <?php } ?>
    </div>
    <div style="margin-top: 40px">
      <h5 class="light">Detail Penumpang</h5>
      <table>
        <thead>
          <tr>
            <th></th>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kode Tiket</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <?php $no=1; foreach($ps as $r){
            ?>
            <tr>
              <td><?=$no?></td>
              <td><?=$r->p_title?> <?=$r->p_full_name?></td>
              <td><?=$r->ticket_code?></td>
            </tr>
          </table>
          <?php $no++; } ?>
        </tbody>
      </div>

    </div>