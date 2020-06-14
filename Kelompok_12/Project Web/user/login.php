<?php 

  session_start();

  if(isset($_SESSION['login'])) {
    echo "<script>
        document.location.href = 'index.php';
        </script>";
    exit;
  }

include 'functions.php';

  if(isset($_POST['login'])) {

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$_POST[email]' AND password = '$_POST[password]'");
    $yangcocok = mysqli_num_rows($result);

    if($_POST['email'] == '' || $_POST['password'] == '') {
      $error1 = true;
    }elseif ($yangcocok == 1) {
        $_SESSION['login'] = true;
        $_SESSION['user'] = mysqli_fetch_assoc($result);
        echo "<script>
            alert('Login berhasil !!');
            document.location.href = 'index.php';
            </script>";
        exit;     
    }else {
      $error3 = true;
    }
  }

 ?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login Page</title>

  <!-- Custom fonts for this template-->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

  <style type="text/css">
    .background {
      background-image: url("https://images.unsplash.com/photo-1499417267106-45cebb7187c9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60");
    }

    .form {
      height: 500px;
    }

    .footer {
      top: 700px;
    }
  </style>

</head>

<body class="bg-gradient-light">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block background"></div>
              <div class="col-lg-6 form">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login Page</h1>
                  </div>
                  <form action="" method="post" class="user">
                    <div class="form-group">
                      <input type="email" name="email" id="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukkan Email...">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" id="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                
                    <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>

                  <br>

                  <div class="col-sm-12 text-center">
                    <?php if(isset($error1)): ?>
                      <div class ='alert alert-warning'>Form harus diisi semuanya!!</div>
                    <?php endif; ?>
                    <?php if(isset($error3)): ?>
                      <div class ='alert alert-danger'>Akun belum terdaftar Atau Password salah</div>
                    <?php endif; ?>
                  </div>

                  <div class="footer">
                    <hr>
                    <div class="text-center">
                      <a class="small" href="register.php">Belum punya akun?</a>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>
