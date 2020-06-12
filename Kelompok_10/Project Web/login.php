<?php
error_reporting(0);
ob_start();

session_start();


$koneksi = new mysqli("localhost", "root", "", "db_perpustakaan");

if ($_SESSION['admin'] || $_SESSION['user']) {
    header("location:index.php");
} else {

?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>PERPUSTAKAAN</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="assets/css/custom.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>

    <body>
        <div class="container">
            <div class="row text-center ">
                <div class="col-md-12">
                    <br /><br />
                    <h2> LOGIN</h2>


                    <br />
                </div>
            </div>
            <div class="row ">

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong> Masukan Username dan Password</strong>
                        </div>
                        <div class="panel-body">
                            <form role="form" method="POST">
                                <br />
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                    <input type="text" class="form-control" placeholder="Your Username " name="nama" />
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="form-control" placeholder="Your Password" name="pass" />
                                </div>

                                <div class="form-group input-group">

                                    <input type="submit" class="btn btn-primary" name="login" value="Login" />
                                </div>


                            </form>
                        </div>

                    </div>
                </div>


            </div>
        </div>


        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
        <script src="assets/js/jquery.metisMenu.js"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="assets/js/custom.js"></script>

    </body>

    </html>


    <?php

    if (isset($_POST['login'])) {

        $nama = $_POST['nama'];
        $pass = $_POST['pass'];

        $ambil = $koneksi->query("select * from tb_user where username='$nama' and password='$pass'");
        $data = $ambil->fetch_assoc();
        $ketemu = $ambil->num_rows;

        if ($ketemu >= 1) {

            session_start();

            $_SESSION[username] = $data[username];
            $_SESSION[pass] = $data[password];
            $_SESSION[level] = $data[level];


            if ($data['level'] == "admin") {
                $_SESSION['admin'] = $data[id];
                header("location:index.php");
            } else if ($data['level'] == "user") {
                $_SESSION['user'] = $data[id];
                header("location:index.php");
            }
        } else {
    ?>
            <script type="text/javascript">
                alert("Username dan Password Anda Salah");
            </script>
<?php
        }
    }
}
?>