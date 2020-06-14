<!DOCTYPE html>
<html>

<head>
  <title><?= $title ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?= base_url() . "assets/" ?>css/materialize.css">
  <link rel="stylesheet" href="<?= base_url() . "assets/" ?>css/style.css">
  <link rel="stylesheet" href="<?= base_url() . "assets/" ?>css/admin.css">
  <link rel="stylesheet" href="<?= base_url() . "assets/" ?>css/dataTables.material.min.css">
</head>

<body>
  <header>
    <nav class="nav-material grey lighten-5">
      <div class="nav-wrapper">
        <a style="padding-left: 20px;padding-top: 3px" href="#!" class="hide-lg brand-logo">
          <img class="img-brand" src="<?= base_url() . "assets/" ?>images/logo.png">
        </a>
        <a href="#" data-activates="mobile-demo" class="button-collapse blue-text"><i class="material-icons">menu</i></a>

        <ul class="right hide-on-med-and-down">
          <li> <a class='light dropdown-button btn blue' href='#' data-activates='dropdown1'>
              <i class="material-icons inline-text">account_circle</i> Administrator</a>
            <ul id='dropdown1' class='dropdown-content'>
              <li><a href="#!">Pengaturan Akun</a></li>
              <li><a href="<?= base_url('admin/logout') ?>">Keluar</a></li>
            </ul>
          </li>
        </ul>
        <ul class="side-nav fixed grey lighten-4" id="mobile-demo">
          <div class="side-logo hide-sm">
            <img src="<?= base_url() . "assets/" ?>images/logo.png">
          </div>
          <li>
            <div class="user-view">
              <div class="background blue">
              </div>
              <a href="#!user"><img class="circle" src="<?= base_url() . "assets/" ?>images/user-white.png"></a>
              <a href="#!name" style="padding-bottom: 20px;"><span class="white-text name">Administrator</span></a>
            </div>
          </li>
          <li><a href="<?= site_url('admin/dashboard') ?>"><i class="material-icons">dashboard</i>Dasbor</a></li>
          <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
              <li>
                <a class="collapsible-header">
                  <i class="material-icons">train</i>Transportasi<i class="material-icons dropdown">arrow_drop_down</i></a>
                <div class="collapsible-body">
                  <ul>
                    <li><a href="<?= site_url('admin/transportation') ?>">Daftar Transportasi</a></li>
                    <li><a href="<?= site_url('admin/transportation_class') ?>">Kelas Transportasi</a></li>
                    <li><a href="<?= site_url('admin/transportation_company') ?>">Perusahaan Transportasi</a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </li>
          <li><a href="<?= site_url('admin/place') ?>"><i class="material-icons">location_on</i>Bandara / Stasiun</a></li>
          <li><a href="<?= site_url('admin/rute') ?>"><i class="material-icons">directions</i>Rute Perjalanan</a></li>
          <li><a href="<?= site_url('admin/promo_code') ?>"><i class="material-icons">label</i>Kode Promo</a></li>
          <li><a href="<?= site_url('admin/costumer') ?>"><i class="material-icons">group</i>Pengguna</a></li>
          <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
              <li>
                <a class="collapsible-header">
                  <i class="material-icons">shopping_cart</i>Pesanan<i class="material-icons dropdown">arrow_drop_down</i></a>
                <div class="collapsible-body">
                  <ul>
                    <li><a href="<?= site_url('admin/order') ?>">Daftar Pesanan</a></li>
                    <li><a href="<?= site_url('admin/order_cancel') ?>">Permintaan Pembatalan</a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </li>
          <li class="no-padding hide-lg">
            <ul class="collapsible collapsible-accordion">
              <li>
                <a class="collapsible-header"><i class="material-icons">account_circle</i> Administrator <i class="material-icons dropdown">arrow_drop_down</i></a>
                <div class="collapsible-body">
                  <ul>
                    <li><a href="#!">Pengaturan Akun</a></li>
                    <li><a href="<?= base_url('admin/logout') ?>">Keluar</a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <?php $this->load->view($content) ?>


  <footer class="page-footer">
    <div class="footer-copyright blue">
      <div class="container">
        <span>Copyright &copy; 2020 <a class="grey-text text-lighten-4" href="<?= base_url() ?>" target="_blank">Travelgo</a> All rights reserved.</span>
        <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="<?=base_url()?>">Kelompok 3 PABWEB</a></span>
      </div>
    </div>
  </footer>
  <script src="<?= base_url() . "assets/" ?>js/jquery.js"></script>
  <script src="<?= base_url() . "assets/" ?>js/materialize.min.js"></script>
  <script src="<?= base_url() . "assets/" ?>js/chart.min.js"></script>
  <script src="<?= base_url() . "assets/" ?>js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() . "assets/" ?>js/dataTables.material.min.js"></script>
  <script type="text/javascript">
    $(".button-collapse").sideNav();
    $('.deletemodal').modal();
  </script>
  <script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'line',
      data: {
        cutoutPercentage: 0,
        <?php
        $cek = $this->m_general->gDataA('order')->result();
        $bulan = array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        ?>
        labels: [<?php foreach ($bulan as $b) {
                    $total = 0;
                    foreach ($cek as $c) {
                      if (date("M", strtotime($c->order_date)) == $b) {
                        $total = $total + $c->final_price;
                      }
                    }
                    echo '"' . $b . '",';
                  } ?>],
        datasets: [{
          label: "Pendapatan",
          borderColor: '#2196f3',
          backgroundColor: '#82b1ff',
          data: [<?php foreach ($bulan as $b) {
                    $total = 0;
                    foreach ($cek as $c) {
                      if (date("M", strtotime($c->order_date)) == $b) {
                        $total = $total + $c->final_price;
                      }
                    }
                    echo '' . $total . ',';
                  } ?>],
        }]
      },
      options: {}
    });
    var ctx = document.getElementById('myChartt').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ["Pesawat", "Kereta Api"],
        datasets: [{
          label: "My First dataset",
          backgroundColor: ['#283593', '#64b5f6'],
          <?php
          $get_p = $this->m_general->gReservationW(array('id_transportation_type' => 1))->num_rows();
          $get_k = $this->m_general->gReservationW(array('id_transportation_type' => 2))->num_rows();
          ?>
          data: [<?= $get_p ?>, <?= $get_k ?>],
        }]
      },
      options: {}
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.datatables').DataTable({
        "order": [
          [0, "asc"]
        ]
      });
      $('select').material_select();

      $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: false, // Close upon selecting a date,
        format: 'yyyy-mm-dd'
      });
      $('.datepicker').on('mousedown', function(event) {
        event.preventDefault();
      })
    });
  </script>

  <script type="text/javascript">
    $('.timepicker').pickatime({
      default: 'now',
      twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
      donetext: 'OK',
      autoclose: false,
      vibrate: true // vibrate the device when dragging clock hand
    });
    // Materialize.toast('Selamat datang, Administrator!', 4000);
    
    $('.timepicker').on('mousedown', function(event) {
      event.preventDefault();
    })
  </script>
  <script type="text/javascript">
    function pTrans() {
      var id_type = $('#id_transportation_type').val();
      $.post('<?= base_url('admin/transportation/gClass') ?>', {
        id_type: id_type
      }, function(data) {
        $('#id_transportation_class').html(data);
        $('#id_transportation_class').material_select();
      });
      $.post('<?= base_url('admin/transportation/gCompany') ?>', {
        id_type: id_type
      }, function(data) {
        $('#id_transportation_company').html(data);
        $('#id_transportation_company').material_select();
      });
    };

    function pRute() {
      var id_type = $('#id_transportation_type').val();
      $.post('<?= base_url('admin/rute/gPlace') ?>', {
        id_type: id_type
      }, function(data) {
        $('#id_place_from').html(data);
        $('#id_place_from').material_select();
        $('#id_place_to').html(data);
        $('#id_place_to').material_select();
      });
      $.post('<?= base_url('admin/rute/gTrans') ?>', {
        id_type: id_type
      }, function(data) {
        $('#id_transportation').html(data);
        $('#id_transportation').material_select();
      });
    };
  </script>
</body>

</html>