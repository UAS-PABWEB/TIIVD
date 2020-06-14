<?php

	$id_lokasi = $_GET['id_lokasi'];

	$sql = $koneksi->query("select * from tb_lokasi where id_lokasi='$id_lokasi'");

	$tampil = $sql->fetch_assoc();
?>

<div class="panel panel-default">
<div class="panel-heading">
		Ubah Data
 </div> 
<div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <form method="POST" >
                                        <div class="form-group">
                                            <label>Lokasi Buku</label>
                                            <input class="form-control" name="lokasi" value="<?php echo $tampil['lokasi'];?>" />
                                            
                                        </div>

                                        <div>
                                        	
                                        	<input type="submit" name="simpan" value="Ubah" class="btn btn-primary">
                                        </div>
                                 </div>

                                 </form>
                              </div>
 </div>  
 </div>  
 </div>


 <?php

 	$lokasi = $_POST ['lokasi'];

 	$simpan = $_POST ['simpan'];


 	if ($simpan) {
 		
 		$sql = $koneksi->query("update tb_lokasi set lokasi='$lokasi' where id_lokasi='$id_lokasi' ");

 		if ($sql) {
 			?>
 				<script type="text/javascript">
 					
 					alert ("Ubah Berhasil Disimpan");
 					window.location.href="?page=lokasi";

 				</script>
 			<?php
 		}
 	}

 ?>
                             
                             

