<?php 


 ?>


<html>
<head>
  <title>User - My Profile</title>

  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Catamaran:wght@400;800&family=Open+Sans+Condensed:wght@300&family=Teko:wght@600&display=swap" rel="stylesheet">

  <style type="text/css">
    .card {
      padding: 25px;
      font-family: 'Catamaran', sans-serif;
      max-width: 500px;
    }

    .card img {
      max-width: 300px;
    }


  </style>
</head>
<body>
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
  </div>


  <!-- <pre><?php print_r($_SESSION['user']); ?></pre> -->

  <div class="card mb-3">
      <div class="row no-gutters">
        <div class="col-lg-4">
          <img src="Foto Profile/<?= $_SESSION['user']['image']; ?>" class="card-img" alt="...">
        </div>
        <div class="col-lg-8">
          <div class="card-body">
            <h4 style="font-weight: bold;">Nama Lengkap :</h4>
            <p class="card-text"><?= $_SESSION['user']['nama_lengkap']; ?></p>
            <h4 style="font-weight: bold;">Username :</h4>
            <p class="card-text"><?= $_SESSION['user']['username']; ?></p>
            <h4 style="font-weight: bold;">Email :</h4>
            <p class="card-text"><?= $_SESSION['user']['email']; ?></p>
            <p class="card-text"><small class="text-muted">Bergabung sejak <?= date('d F Y', $_SESSION['user']['date_created']); ?></small></p>      
          </div>
        </div>
      </div>
    </div>
</body>
</html>
