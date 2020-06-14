<?php 

	include 'functions.php';

	$data = mysqli_query($conn, "SELECT * FROM postingan WHERE id_user = '$id'");

	$jumlah = mysqli_num_rows($data);

 ?>


 <html>
 <head>
 	<title></title>

 	<style type="text/css">
 		.card {
 			margin-top: 50px;
 		}
 	</style>
 </head>
 <body>

 	<div class="container">
		<div class="row">
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800">Home</h1>
			</div>
		</div>
		
		<div class="row">
			<h1>Selamat datang <?php print_r($_SESSION['user']['username']); ?></h1>
		</div>

		<div class="row">
			<div class="col-xl-3 col-md-6 mb-4">
		        <div class="card border-left-dark shadow h-100 py-2">
		            <div class="card-body">
		                <div class="row no-gutters align-items-center">
		                    <div class="col mr-2">
		                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Postingan</div>
		                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah; ?></div>
		                    </div>
		                    <div class="col-auto">
		                      <i class="fab fa-telegram-plane fa-2x text-gray-300"></i>
		                    </div>
		                </div>
		            </div>
		        </div>
			</div>
		</div>
	</div>

 
 </body>
 </html>
	
