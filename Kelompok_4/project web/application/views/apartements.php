<div class="container" style="margin-top: 30px;">
	<label for="validationDefaultUsername"><h4>Dimana anda ingin menginap?</h4></label>
	<form class="form-inline">
		<div class="input-group" style="width: 100%">
			<select name="id_kota" class="form-control form-control-lg">
				<option value="">Pilih Kota ...</option>
				<?php 
				foreach($kota as $k){
					echo '<option value="'.$k->id_kota.'">'.$k->nama_kota.'</option>';
				}
				?>
			</select>
			<div class="input-group-prepend">
				<button type="submit" class="btn btn-primary">Cari</button>
			</div>
		</form>
	</div>
	<hr>
	<div class="row">
		<?php 
		$i=1;
		if(empty($list)){
			echo "<div class='col-md-12'><center><h2>Data tidak ditemukan</h2></center></div>";
		}else{
		foreach($list as $l){
			?>
			<div class="col-md-4" style="margin-bottom: 20px;">
				<div class="card">
					<div class="gambar">
						<img src="<?=base_url('assets/images/apartement')."/".$l->foto?>" class="card-img-top">
					</div>
					<div class="card-body">
						<h5 class="card-title text-purple"><?=$l->nama_apartemen?></h5>
						<p class="card-text"><small>Mulai dari</small><br><?=rupiah($l->harga)?> / Hari <span class="text-bold float-right"><?=$l->nama_kota?></span></p>
						<a href="<?=base_url('order/make/'.$l->id_apartemen)?>" class="btn btn-block btn-primary">Pesan</a>
					</div>
				</div>
			</div>
			<?php $i++; } 
		} ?>
		</div>
	</div>