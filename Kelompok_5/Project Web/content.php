<?php
    $p=isset($_GET['p'])?$_GET['p']:null;
    switch($p){
        default:
            echo'
    <center>
  
           <img src="images/KOPIND.png" style="width:300px; height:200px;">
    <p>&nbsp;</p>
        <h3>Koperasi Kesejahteraan Keluarga</h3> <p>&nbsp;</p>
           <h3>VISI & MISI</h3>  <p>&nbsp;</p><p>&nbsp;</p>
      
        <p>Visi</p>
      <p>Meningkatkan kesejahteraan anggota dan masyarakat pada umumnya, serta ikut membangun tatanan perekonomian nasional.</p>

        <p>Misi</p>
        <p>1.   Membangun dan mengembangkan potensi dan kemampuan ekonomi anggota pada khususnya dan masyarakat pada umumnya untuk meningkatkan kesejahteraan ekonomi dan sosialnya.</p>
        <p>2.   Berpartisipasi aktif dalam upaya mempertinggi kualitas kehidupan manusia dan masyarakat.</p>
        <p>3.   Memperkokoh perekonomian rakyat sebagai dasar kekuatan dan ketahanan perekonomian Nasional.</p>

            </center>';
        break;
        case "data_anggota":   
            include 'anggota/data_anggota.php';
        break;  
        case "kelola_anggota":   
            include 'admin/kelola_anggota.php';
        break;    
        case "tambah_anggota":   
            include 'admin/tambah_anggota.php';
        break;       
        case "ubah_anggota":   
            include 'admin/ubah_anggota.php';
        break;            
        case "data_pinjaman":   
            include 'anggota/data_pinjaman.php';
        break;         
        case "kelola_pinjaman":   
            include 'admin/kelola_pinjaman.php';
        break;    
        case "tambah_pinjaman":   
            include 'admin/tambah_pinjaman.php';
        break;       
        case "ubah_pinjaman":   
            include 'admin/ubah_pinjaman.php';
        break;      
        case "detail_pinjaman":   
            include 'admin/detail_pinjaman.php';
        break;             
        case "data_tagihan":   
            include 'anggota/data_tagihan.php';
        break;            
        case "kelola_tagihan":   
            include 'admin/kelola_tagihan.php';
        break;    
        case "tambah_tagihan":   
            include 'admin/tambah_tagihan.php';
        break;       
        case "ubah_tagihan":   
            include 'admin/ubah_tagihan.php';
        break;                      
        case "data_simpanan_pokok":   
            include 'anggota/data_simpanan_pokok.php';
        break;                        
        case "kelola_simpanan_pokok":   
            include 'admin/kelola_simpanan_pokok.php';
        break;    
        case "tambah_simpanan_pokok":   
            include 'admin/tambah_simpanan_pokok.php';
        break;       
        case "ubah_simpanan_pokok":   
            include 'admin/ubah_simpanan_pokok.php';
        break;                     
        case "data_simpanan_wajib":   
            include 'anggota/data_simpanan_wajib.php';
        break;                     
        case "kelola_simpanan_wajib":   
            include 'admin/kelola_simpanan_wajib.php';
        break;    
        case "tambah_simpanan_wajib":   
            include 'admin/tambah_simpanan_wajib.php';
        break;       
        case "ubah_simpanan_wajib":   
            include 'admin/ubah_simpanan_wajib.php';
        break;                    
        case "data_simpanan_ambil":   
            include 'anggota/data_simpanan_ambil.php';
        break;                     
        case "kelola_simpanan_ambil":   
            include 'admin/kelola_simpanan_ambil.php';
        break;    
        case "tambah_simpanan_ambil":   
            include 'admin/tambah_simpanan_ambil.php';
        break;       
        case "ubah_simpanan_ambil":   
            include 'admin/ubah_simpanan_ambil.php';
        break;                 
        case "data_simpanan_sukarela":   
            include 'anggota/data_simpanan_sukarela.php';
        break;                  
        case "kelola_simpanan_sukarela":   
            include 'admin/kelola_simpanan_sukarela.php';
        break;    
        case "tambah_simpanan_sukarela":   
            include 'admin/tambah_simpanan_sukarela.php';
        break;       
        case "ubah_simpanan_sukarela":   
            include 'admin/ubah_simpanan_sukarela.php';
        break;      
        case "kelola_dokumen":   
            include 'admin/kelola_dokumen.php';
        break;    
        case "saring_anggota":   
            include 'ketua/saring_anggota.php';
        break;     
        case "saring_simpanan_wajib":   
            include 'ketua/saring_simpanan_wajib.php';
        break;     
        case "saring_pinjaman":   
            include 'ketua/saring_pinjaman.php';
        break;     
        case "saring_tagihan":   
            include 'ketua/saring_tagihan.php';
        break;     
        case "saring_simpanan_pokok":   
            include 'ketua/saring_simpanan_pokok.php';
        break;     
        case "saring_simpanan_sukarela":   
            include 'ketua/saring_simpanan_sukarela.php';
        break;    
        case "hapus_anggota":   
            $id = $_GET['id'];
            mysqli_query($conn,"DELETE FROM anggota WHERE id_anggota='$id'");
            echo '<meta http-equiv="refresh" content="0; url=index.php?p=saring_anggota&sukses=1">';
        break;    
        case "hapus_pinjaman":   
            $id = $_GET['id'];
            mysqli_query($conn,"DELETE FROM pinjaman WHERE id_pinjaman='$id'");
            echo '<meta http-equiv="refresh" content="0; url=index.php?p=saring_pinjaman&sukses=1">';
        break;  
        case "hapus_tagihan":   
            $id = $_GET['id'];
            mysqli_query($conn,"DELETE FROM bayar WHERE id_bayar='$id'");
            echo '<meta http-equiv="refresh" content="0; url=index.php?p=saring_tagihan&sukses=1">';
        break;  
        case "hapus_simpanan_wajib":   
            $id = $_GET['id'];
            mysqli_query($conn,"DELETE FROM simpanan WHERE id_simpanan='$id'");
            echo '<meta http-equiv="refresh" content="0; url=index.php?p=saring_simpanan_wajib&sukses=1">';
        break;  
        case "hapus_simpanan_pokok":   
            $id = $_GET['id'];
            mysqli_query($conn,"DELETE FROM simpanan WHERE id_simpanan='$id'");
            echo '<meta http-equiv="refresh" content="0; url=index.php?p=saring_simpanan_pokok&sukses=1">';
        break;  
        case "hapus_simpanan_sukarela":   
            $id = $_GET['id'];
            mysqli_query($conn,"DELETE FROM simpanan WHERE id_simpanan='$id'");
            echo '<meta http-equiv="refresh" content="0; url=index.php?p=saring_simpanan_sukarela&sukses=1">';
        break;  
    }
                    
    ?>
</body>
</html>