    <?php
session_start();
include "config.php";
if (!isset($_SESSION['id_user'])){
// header('location: login.php');
    $login = false;
}else{
    $level = $_SESSION['level'];
    $id_user = $_SESSION['id_user'];
    if($level=='anggota'){
        $query = mysqli_query($conn,"SELECT * FROM user INNER JOIN anggota ON anggota.id_user = user.id_user WHERE user.id_user='$id_user'");
    }else{
        $query = mysqli_query($conn,"SELECT * FROM user WHERE id_user='$id_user'");
    }
    $data = mysqli_fetch_array($query);
    $login = true;
}
// if(isset($_SESSION['admin'])){
//     $display_name = $data['username'];
// }else{
//     $display_name = $data['nama'];
// }
function rupiah($angka){
    
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
 
}
function url(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'];
}
function tgl($tanggal){
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    
    // variabel pecahkan 0 = tahun
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tanggal
 
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Koperasi Simpan Pinjam</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="image" href="2.png">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/lib/datatable/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/lib/datatable/buttons.dataTables.min.css">
    <link rel="stylesheet" href="assets/js/lib/bootstrap-datepicker/css/datepicker.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>


        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/ico.jpg"alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <?php 
                    if($login==false){
                ?>
                <ul class="nav navbar-nav">
                    <h3 class="menu-title">Login</h3><!-- /.menu-title -->
                    <li class="menu-item">
                        <a href="login.php"> <i class="menu-icon fa fa-sign-in"></i>Login</a>
                    </li>
                </ul>
                <?php }else{
                    ?>

                <ul class="nav navbar-nav">
                                        <li class="active">   
                        <a href="index.php"> <i class="menu-icon fa fa-dashboard"></i>HOME</a>
                    </li>
                            <?php 
                                if($level=='anggota'){
                                    ?>
                            <li><a href="?p=data_anggota"><i class="menu-icon fa fa-user"></i>Data Keanggotaan</a></li>
                                    <?php
                                }elseif($level=='admin'){
                                    ?>
                            <li><a href="?p=kelola_anggota"><i class="menu-icon fa fa-user"></i>Kelola Data Anggota</a></li>
                                    <?php
                                }elseif($level=='ketua'){
                                    ?>
                            <li><a href="?p=saring_anggota"><i class="menu-icon fa fa-user"></i>Saring Data Anggota</a></li>
                                    <?php
                                }
                            ?>
                            <?php 
                                if($level=='anggota'){
                                    ?>
                            <li><a href="?p=data_pinjaman"><i class="menu-icon fa fa-archive"></i>Data pinjaman</a></li>
                                    <?php
                                }elseif($level=='admin'){
                                    ?>
                            <li></i><a href="?p=kelola_pinjaman"><i class="menu-icon fa fa-archive"></i>Kelola Data pinjaman</a></li>
                                    <?php
                                }elseif($level=='ketua'){
                                    ?>
                            <li></i><a href="?p=saring_pinjaman"><i class="menu-icon fa fa-archive"></i>Saring Data pinjaman</a></li>
                                    <?php
                                }
                            ?>

                            <?php 
                                if($level=='anggota'){
                                    ?>
                            <li><a href="?p=data_tagihan"><i class="menu-icon fa fa-archive"></i>Data tagihan</a></li>
                                    <?php
                                }elseif($level=='admin'){
                                    ?>
                            <li></i><a href="?p=kelola_tagihan"><i class="menu-icon fa fa-archive"></i>Kelola Data tagihan</a></li>
                                    <?php
                                }elseif($level=='ketua'){
                                    ?>
                            <li></i><a href="?p=saring_tagihan"><i class="menu-icon fa fa-archive"></i>Saring Data tagihan</a></li>
                                    <?php
                                }
                            ?>
                    
                      <li>
                     <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                  
                            <?php 
                                if($level=='anggota'){
                                    ?>
                        <i class="menu-icon fa ti-wallet"></i>Data Simpanan</a>
                                    <?php
                                }elseif($level=='admin'){
                                    ?>
                        <i class="menu-icon fa ti-wallet"></i>Kelola Simpanan</a>
                                    <?php
                                }elseif($level=='ketua'){
                                    ?>
                        <i class="menu-icon fa ti-wallet"></i>Saring Simpanan</a>
                                    <?php
                                }
                            ?>
                        <ul class="sub-menu children dropdown-menu">

                            <?php 
                                if($level=='anggota'){
                                    ?>
                            <li><i class="fa fa-archive"></i><a href="?p=data_simpanan_pokok">Simpanan pokok</a></li>
                                    <?php
                                }elseif($level=='admin'){
                                    ?>
                            <li><i class="fa fa-archive"></i><a href="?p=kelola_simpanan_pokok">Simpanan pokok</a></li>
                                    <?php
                                }elseif($level=='ketua'){
                                    ?>
                            <li><i class="fa fa-archive"></i><a href="?p=saring_simpanan_pokok">Simpanan pokok</a></li>
                                    <?php
                                }
                            ?>

                            <?php 
                                if($level=='anggota'){
                                    ?>
                            <li><i class="fa fa-archive"></i><a href="?p=data_simpanan_wajib">Simpanan wajib</a></li>
                                    <?php
                                }elseif($level=='admin'){
                                    ?>
                            <li><i class="fa fa-archive"></i><a href="?p=kelola_simpanan_wajib">Simpanan wajib</a></li>
                                    <?php
                                }elseif($level=='ketua'){
                                    ?>
                            <li><i class="fa fa-archive"></i><a href="?p=saring_simpanan_wajib">Simpanan wajib</a></li>
                                    <?php
                                }
                            ?>

                            <?php 
                                if($level=='anggota'){
                                    ?>
                            <li><i class="fa fa-archive"></i><a href="?p=data_simpanan_sukarela">Simpanan Manasuka</a></li>
                                    <?php
                                }elseif($level=='admin'){
                                    ?>
                            <li><i class="fa fa-archive"></i><a href="?p=kelola_simpanan_sukarela">Simpanan Manasuka</a></li>
                                    <?php
                                }elseif($level=='ketua'){
                                    ?>
                            <li><i class="fa fa-archive"></i><a href="?p=saring_simpanan_sukarela">Simpanan Manasuka</a></li>
                                    <?php
                                }
                            ?>

                            <?php
                            if($level=='admin'){
                                    ?>
                            <li><i class="fa fa-archive"></i><a href="?p=kelola_simpanan_ambil">Ambil Simpanan</a></li>
                                    <?php
                                }
                            ?>
                        </ul>
                    </li>
                
          

                            <?php
                            if($level=='admin'){
                                    ?> 
                    <li>
                        <a href="?p=kelola_dokumen" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-file"></i>Kelola Dokumen</a>
                    </li>
                            <?php
                                }
                            ?>
                
                    <h3 class="menu-title"></h3><!-- /.menu-title -->
                    <li>
                        <a onclick="return confirm('Apakah anda yakin?')" href="logout.php"> <i class="menu-icon fa fa-sign-out"></i>Logout</a>
                    </li>
                </ul>
                    <?php
                } ?>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    </div>
                </div>
       
        </header><!-- /header -->
        <!-- Header-->



    <section id="privacy-policy" class="container">

                        <?php include"content.php";?>
    </section>   


        </div> <!-- .content -->
    <!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/lib/data-table/datatables-init.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();

          $('#table-export').DataTable({
        dom: 'Bfrtip',
        buttons: [
        {

                extend: 'excel',
                className: 'btn btn-danger',
                title: $('.card-title').text()+' Anggota Koperasi Kesejahteraan Keluarga',
                exportOptions: {
                columns: ':not(:last-child)',
                }
            }, 
            {
                extend: 'pdf',
                className: 'btn btn-danger',
                title: $('.card-title').text()+' Anggota Koperasi Kesejahteraan Keluarga',
                exportOptions: {
                columns: ':not(:last-child)',
                }
            }, {
                extend: 'print',                
                className: 'btn btn-danger',
                title: $('.card-title').text(),
                exportOptions: {
                columns: ':not(:last-child)',
                }
            }
        ]});
          $('.datepicker').datepicker(
            {
                format: 'yyyy-mm-dd'
            });
        } );
    </script>


</body>
</html>
