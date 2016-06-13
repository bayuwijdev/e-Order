<?php
	session_start();
	if(($_SESSION['sudahlogin']==true)&&($_SESSION['username']!="")) {
?>
<html>
<head>
<?php 
	include("../library/lib_func.php");
?>
<title>Data Produk - e-Order</title>
<link rel="SHORTCUT ICON" href="../favicon.ico"> 
<?php require('../head/style_admin.php') ?>

</head>
<body>
<?php $link=koneksi_db(); ?>
<table width="100%" align="center">
<tr><td colspan=2 align="center"><?php header_web();?></td></tr>
<tr>
<tr>
<td colspan="2"><hr></td>
</tr>
	<td width="200px" valign="top"><?php menu();?></td>
	<td valign="top"><div class="col-md-12 col-md-offset-0"><p class="judul">Data Produk e-Order</p>
	 	<form class="form-horizontal" enctype="multipart/form-data" method="post" action="" name="input">
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <label class="control-label">Nama Produk</label>                         
                                            <input style="width:25em;" type="text" class="form-control" name="nama_produk" id="nama_produk" required placeholder="Nama Produk">
                                        </div>
                                        <div class="col-md-2" style="margin-left: 15%">
                                          <label class="control-label">Kategori</label>   
                                          <select name="id_kategori_produk" class="form-control" required>
                                             <option value="">Pilih Kategori</option>
                                           <?php
                                            $res=mysql_query("SELECT id_kategori,nama FROM kategori 
                                                              WHERE dihapus='T'
                                                              ORDER BY nama",$link);
                                            while($data=mysql_fetch_array($res)){
                                                echo "<option value=\"".$data['id_kategori']."\">".$data['nama']." </option>";
                                            }
                                           ?>
                                           </select>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="col-md-2">
                                          <label class="control-label">Merk</label>   
                                          <select name="id_merk_produk" class="form-control" required>
                                             <option value="">Pilih Merk</option>
                                           <?php
                                            $res=mysql_query("SELECT id_merk,nama FROM merk 
                                                              WHERE dihapus='T'
                                                              ORDER BY nama",$link);
                                            while($data=mysql_fetch_array($res)) {
                                                echo "<option value=\"".$data['id_merk']."\">".$data['nama']." </option>";
                                            }
                                           ?>
                                           </select>
                                        </div>
                                        <div class="col-md-2" style="margin-left: 15%;">
                                            <label class="control-label">Berat Produk (kg)</label>                  
                                            <input style="width:9em;" type="text" class="form-control" name="berat_produk" id="berat_produk" required placeholder="Berat Produk">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <label class="control-label">Harga (Rp.)</label>                         
                                            <input style="width:12em;" type="number" class="form-control" name="harga_produk" id="harga_produk" required placeholder="Harga Produk">
                                        </div>
                                        <div class="col-md-2" style="margin-left: 15%;">
                                            <label class="control-label">Diskon (%)</label>                         
                                            <input style="width:7em;" type="number" class="form-control" name="diskon_produk" id="diskon_produk" required placeholder="Diskon">
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <label class="control-label">Stok</label>                         
                                            <input style="width:10em;" type="number" class="form-control" name="stok_produk" id="stok_produk" required placeholder="Stok">
                                        </div>
                                        <div class="col-md-2" style="margin-left: 15%;">
                                            <label class="control-label">Deskripsi</label>                         
                                            <textarea style="width:30em;" type="text" class="form-control" name="deskripsi_produk" id="deskripsi_produk" placeholder="Deskripsi Produk"></textarea>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="col-md-2">
                                          <label class="control-label">DiJual (Y/T)</label>   
                                          <input style="width:10em;" type="text" class="form-control" name="dijual" id="dijual" required placeholder="Y / T" maxlength="1">
                                        </div>
                                        <div class="col-md-2" style="margin-left: 15%;">
                                            <label class="control-label">Foto Produk</label>   
                                            <input type="hidden" name="MAX_FILE_SIZE" value="1000000"></input>                      
                                            <input style="width:30em;" type="file" class="form-control" name="foto_produk" id="foto_produk" placeholder="Foto Produk">
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="col-md-2 ">
                                            <input type="submit" name="input" class="btn btn-success" value="Tambah">
                                            <input type="reset" name="reset" class="btn btn-warning" value="Reset">
                                        </div>
                                    </div> 
	</form>
	<?php
		$link=koneksi_db();
		$sql="SELECT p.id_produk,p.nama NamaProduk,
          m.nama NamaMerk,k.nama NamaKategori,
          p.berat,p.harga,p.diskon,p.stok,p.filegambar,p.dijual
          FROM produk p JOIN merk m ON p.id_merk=m.id_merk
          JOIN kategori k ON p.id_kategori=k.id_kategori
          WHERE p.dihapus='T'
          ORDER BY p.id_produk"; 
		$res=mysql_query($sql,$link); 
		$banyakrecord=mysql_num_rows($res); 
		if($banyakrecord>0) { 
	?>				
					<hr>
					<form class="form-inline "name="cari" method="post" action="">
                        <div class="input-group custom-search-form">
                          <input style="width:15em;margin-top:1em; margin-right: 0.5em;" type="text" class="form-control" id="data_cari" name="data_cari" placeholder="Cari Produk"> <button style="margin-top: 1em;" class="btn btn-info" type="submit" name="cari">Cari</button>
                        </div>
                    </form>  
                    <hr> 
								<table class="table table-hover table-striped">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Foto</th>
                                          <th>ID Produk</th>
                                          <th>Nama Produk</th>
                                          <th>Merk</th>
                                          <th>Kategori</th>
                                          <th>Harga</th>
                                          <th>Diskon</th>
                                          <th>Stok</th>
                                          <th>Dijual</th>
                                          <th colspan="2" class="text-center">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                      if(isset($_POST['cari']))
                                      {
                                        $datacari=$_POST['data_cari'];
                                        $select = "SELECT p.id_produk,p.nama NamaProduk,
                                                          m.nama NamaMerk,k.nama NamaKategori,
                                                          p.berat,p.harga,p.diskon,p.stok,p.berat,p.filegambar,p.dijual
                                                    FROM produk p JOIN merk m ON p.id_merk=m.id_merk
                                                                          JOIN kategori k ON p.id_kategori=k.id_kategori
                                                    WHERE p.nama like '%$datacari%' OR m.nama like '%$datacari%' OR k.nama like '%$datacari%' OR harga like '%$datacari%' OR diskon like '%$datacari%' OR stok like '%$datacari%' OR dijual like '%$datacari%'
                                                    ORDER BY p.id_produk";
                                      }//endif post cari
                                      else if(!isset($_POST['data_cari']))
                                          {
                                            $select  = "SELECT p.id_produk,p.nama NamaProduk,
                                                               m.nama NamaMerk,k.nama NamaKategori,
                                                               p.harga,p.diskon,p.stok,p.berat,p.filegambar,p.dijual
                                                              FROM produk p JOIN merk m ON p.id_merk=m.id_merk
                                                                          JOIN kategori k ON p.id_kategori=k.id_kategori
                                                              WHERE p.dihapus='T'
                                                              ORDER BY p.id_produk";
                                          }

                                      $no=1;//penomoran              
                                      $sql = mysql_query($select,$link);
                                      while($hasil = mysql_fetch_array($sql))
                                      {
                                        $id_produk = $hasil['id_produk'];
                                        $nama_produk = $hasil['NamaProduk'];
                                        $nama_merk = $hasil['NamaMerk'];
                                        $nama_kategori = $hasil['NamaKategori'];
                                        $berat = $hasil['berat'];
                                        $harga = $hasil['harga'];
                                        $diskon = $hasil['diskon'];
                                        $stok = $hasil['stok'];
                                        $filegambar = $hasil['filegambar'];
                                        $dijual = $hasil['dijual'];
                                        echo "
                                                <tr>
                                                    <td style='vertical-align:middle; text-align:center; '>$no</td>
                                                    <td style='vertical-align:middle;'><img src='../gambar/$filegambar' width='70px' height='70px'></td></td>
                                                    <td style='vertical-align:middle; text-align:center; '>$id_produk</td>
                                                    <td style='vertical-align:middle; text-align:center; '>$nama_produk</td>
                                                    <td style='vertical-align:middle; text-align:center; '>$nama_merk</td>
                                                    <td style='vertical-align:middle; text-align:center; '>$nama_kategori</td>
                                                    <td style='vertical-align:middle; text-align:center; '>$harga</td>
                                                    <td style='vertical-align:middle; text-align:center; '>$diskon</td>
                                                    <td style='vertical-align:middle; text-align:center; '>$stok</td>
                                                    <td style='vertical-align:middle; text-align:center; '>$dijual</td>
                                                    <td style='vertical-align:middle; text-align:center;' align='center'>
                                                      <a class='btn btn-primary' type='submit' href='produk_edit.php?id_produk=$id_produk'>
                                                        Ubah
                                                      </a>
                                                    </td>
                                                    <td style='vertical-align:middle;' align='center'>
                                                      <a id='hapus' class='btn btn-danger' href='produk_delete.php?id_produk=$id_produk' onclick='return myFunction()'>
                                                        Hapus
                                                      </a>
                                                    </td>
                                                </tr>
                                            ";
                                        $no++;
                                      }//endwhile
                                    ?>
                                  </tbody>
                                </table>
    <?php 
    	}
    	else {
    ?>
          <div class="warning">Data produk masih kosong!</div>
    <?php		
    	}

    ?>
    </div>
    </td>
</tr>
<tr>
<td colspan="2"><hr></td>
</tr>
<tr><td colspan="2"><?php footer_web();?></td></tr>
</table>
<?php
	if(isset($_POST['input'])) {
		$nama_produk=$_POST['nama_produk'];
    $id_kategori=$_POST['id_kategori_produk'];
    $id_merk=$_POST['id_merk_produk'];
    $berat_produk = $_POST['berat_produk'];
    $harga_produk = $_POST['harga_produk'];
    $diskon_produk = $_POST['diskon_produk'];
    $stok_produk = $_POST['stok_produk'];
    $dijual = $_POST['dijual'];
    $deskripsi_produk = $_POST['deskripsi_produk'];

    $namafilefotobaru = "";
    if($_FILES['foto_produk']['error']==0) {
      $namafilefotobaru = "../gambar/".$_FILES['foto_produk']['name'];
      if(move_uploaded_file($_FILES['foto_produk']['tmp_name'], $namafilefotobaru)==true){
          $namafilefoto=$_FILES['foto_produk']['name'];

          $link=koneksi_db();
          $sql="insert into produk values('','$id_kategori','$id_merk','$nama_produk','$harga_produk','$berat_produk','$diskon_produk','$stok_produk','$dijual','$deskripsi_produk','$namafilefoto','T')"; 
          $res=mysql_query($sql,$link); 
          if($res) {
          ?> 
            <script type='text/javascript'>
                    window.alert('Data Produk <?php echo $nama_produk;?> berhasil disimpan!')
            </script>
                  <script>document.location='produk_add_view.php'</script>
          <?php
          } 
          else{
            
          ?> 
            <script type='text/javascript'>
                    window.alert('Terjadi kesalahan dalam penyimpanan data produk baru dengan kesalahan <?php echo mysql_error($link);?>. Silahkan diulang lagi!<br>')
                  </script>
                  <script>document.location='produk_add_view.php'</script>
          <?php
          }
      } else {
        echo "Gagal menyimpan file upload. Silahkan ulangi";
      }
    } else {
      echo "Gagal Upload. Silahkan ulangi";
    }

		 
	}		
?>
<script>
    function myFunction() {         
        return confirm("Anda yakin ingin menghapus data produk ini ?");
    }
</script>
</body>
</html>
<?php
	}
	else{
		header("Location: belumlogin.php");
	}
?>