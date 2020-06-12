<script type="text/javascript" >
    function validasi(form){
        if (form.lokasi.value=="") {
            alert("Lokasi Tidak Boleh Kosong");
            form.lokasi.focus();
            return (false);
        }

        return(true);
    }
</script>

<div class="panel panel-default">
<div class="panel-heading">
        Tambah Data Lokasi Buku
 </div> 
<div class="panel-body">
    <div class="row">
        <div class="col-md-12">
            
            <form method="POST" onsubmit="return validasi(this)" >
                <div class="form-group">
                    <label>Lokasi Buku</label>
                    <input class="form-control" name="lokasi" id="lokasi" />
                    
                </div>

                <div>
                    
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
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
        
        $sql = $koneksi->query("insert into tb_lokasi (lokasi)values('$lokasi')");

        if ($sql) {
            ?>
                <script type="text/javascript">
                    
                    alert ("Data Berhasil Disimpan");
                    window.location.href="?page=lokasi";

                </script>
            <?php
        }
    }

 ?>
                             
                             

