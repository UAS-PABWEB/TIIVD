<?php 

  include 'functions.php';

  if (isset($_POST['register'])) {
    if(registrasi($_POST) > 0) {
      echo "<script>
          alert('Registrasi berhasil!!');
          document.location.href = 'login.php';
          </script>";
    }else {
      echo mysqli_error($conn);
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

  <title>Register Page</title>

  <!-- Custom fonts for this template-->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

  <style type="text/css">
    .background {
      background-image: url("https://images.unsplash.com/photo-1556103255-4443dbae8e5a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60");
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

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block background"></div>
          <div class="col-lg-7 form">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Register Page</h1>
              </div>
              <form action="" method="post" class="user">
                    <div class="form-group">
                      <input type="email" name="email" id="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukkan Email..." required>
                    </div>
                    <div class="form-group">
                      <input type="text" name="namaL" id="namaL" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukkan Nama Lengkap..." required>
                    </div>
                    <div class="form-group">
                      <input type="texr" name="username" id="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukkan Username..." required>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-6">
                          <input type="password" name="password" id="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                        </div>
                        <div class="col-lg-6">
                          <input type="password" name="confirmP" id="confirmP" class="form-control form-control-user" id="exampleInputPassword" placeholder="Repeat Password" required>
                        </div>
                      </div>                 
                    </div>

                    <button type="submit" name="register" class="btn btn-primary btn-user btn-block">
                      Register
                    </button>
                  </form>
              <hr>
              <div class="text-center">
                <a class="small" href="login.php">Sudah punya akun? Login!</a>
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
