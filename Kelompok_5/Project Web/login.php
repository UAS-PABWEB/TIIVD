<?php
session_start();
include "config.php";
if ((isset($_SESSION['anggota']))||(isset($_SESSION['ketua']))||(isset($_SESSION['admin']))){
    header('location: index.php');
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
    <title>Login User</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-form">
                    <form method="POST">
                        <div class="login-logo">
                            <a href="index.php">
                                <img class="align-content" src="images/1.png" alt="">
                            </a>
                        </div>
                        <?php 
                        if(isset($_POST['login'])){
                            $user = mysqli_real_escape_string($conn, $_POST['user']);
                            $pass = mysqli_real_escape_string($conn, $_POST['pass']);
                            $level = mysqli_real_escape_string($conn, $_POST['level']);

                            $login = mysqli_query($conn,"SELECT * FROM user WHERE username='$user' AND password='$pass'");
                            $cek = mysqli_num_rows($login);
                            if($cek > 0){
                                $data = mysqli_fetch_array($login);
                                $_SESSION['id_user'] = $data['id_user'];
                                $_SESSION['level'] = $data['level'];
                                header('location: index.php');
                            }else{
                             echo'
                             <div class="alert alert-danger" role="alert">Username / Password Salah
                             </div>'; 
                         }
                     }
                     ?>
                     <div class="form-group">
                        <label>Username</label>
                        <input type="username" class="form-control" name="user" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="pass" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select name="level" class="form-control">
                            <option value="anggota">Anggota</option>
                            <option value="ketua">Ketua</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div><input type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" value="Sign In" name="login">

                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>


<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>


</body>
</html>
