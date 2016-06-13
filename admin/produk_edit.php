<?php
	session_start();
	if(($_SESSION['sudahlogin']==true)&&($_SESSION['username']!="")) {
?>
<html>
<head>
<?php 
	include("../library/lib_func.php");
?>
<title>Edit Data Admin - e-Order</title>
<link rel="SHORTCUT ICON" href="../favicon.ico"> 
<?php require('../head/style_admin.php') ?>

</head>
<body>
<table width="100%" align="center">
<tr><td colspan=2 align="center"><?php header_web();?></td></tr>
<tr>
<tr>
<td colspan="2"><hr></td>
</tr>
	<td width="200px" valign="top"><?php menu();?></td>
	<td valign="top"><div class="col-md-12 col-md-offset-0">
  <p class="judul">Edit Data Produk e-Order</p>
	 <?php 
      $id_produk = $_REQUEST['id_produk'];
      $link=koneksi_db();
      $q = mysql_query("SELECT * FROM produk WHERE id_produk = '".$_REQUEST['id_produk']."' ") or die(mysql_error());
      $hasil = mysql_fetch_array($q);
        $id_produk = $hasil['id_produk'];
        $nama_produk = $hasil['nama'];
        $id_merk = $hasil['id_merk'];
        $id_kategori = $hasil['id_kategori'];
        $berat = $hasil['berat'];
        $harga = $hasil['harga'];
        $diskon = $hasil['diskon'];
        $stok = $hasil['stok'];
        $deskripsi = $hasil['deskripsi'];
        $dijual = $hasil['dijual'];
        $filegambar = $hasil['filegambar'];
        $dijual = $hasil['dijual'];   
   ?>

                          <form id="ubah" class="form-horizontal" enctype="multipart/form-data" method="post" action="produk_update.php?id_produk=<?php echo $id_produk; ?>" name="input">
                                     <div class="form-group">
                                        <div class="col-md-2">
                                            <label class="control-label">Nama Produk</label>                         
                                            <input style="width:25em;" type="text" class="form-control" name="nama_produk" id="nama_produk" required placeholder="Nama Produk" value="<?php echo $nama_produk; ?>">
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
                                                if($id_kategori == $data['id_kategori']){
                                                    echo "<option value=\"".$data['id_kategori']."\" selected>".$data['nama']." </option>";
                                                }
                                                else 
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
                                                if($id_merk == $data['id_merk']) {
                                                    echo "<option value=\"".$data['id_merk']."\" selected>".$data['nama']." </option>";
                                                }
                                                else {
                                                    echo "<option value=\"".$data['id_merk']."\">".$data['nama']." </option>";
                                                }
                                                
                                            }
                                           ?>
                                           </select>
                                        </div>
                                        <div class="col-md-2" style="margin-left: 15%;">
                                            <label class="control-label">Berat Produk (kg)</label>                  
                                            <input style="width:9em;" type="text" class="form-control" name="berat_produk" id="berat_produk" required placeholder="Berat Produk" value="<?php echo $berat; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <label class="control-label">Harga (Rp.)</label>                         
                                            <input style="width:12em;" type="number" class="form-control" name="harga_produk" id="harga_produk" required placeholder="Harga Produk" value="<?php echo $harga; ?>">
                                        </div>
                                        <div class="col-md-2" style="margin-left: 15%;">
                                            <label class="control-label">Diskon (%)</label>                         
                                            <input style="width:7em;" type="number" class="form-control" name="diskon_produk" id="diskon_produk" required placeholder="Diskon" value="<?php echo $diskon; ?>">
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <label class="control-label">Stok</label>                         
                                            <input style="width:10em;" type="number" class="form-control" name="stok_produk" id="stok_produk" required placeholder="Stok" value="<?php echo $stok; ?>">
                                        </div>
                                        <div class="col-md-2" style="margin-left: 15%;">
                                            <label class="control-label">Deskripsi</label>                         
                                            <textarea style="width:30em;" type="text" class="form-control" name="deskripsi_produk" id="deskripsi_produk" placeholder="Deskripsi Produk"><?php echo htmlspecialchars($deskripsi); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-2">
                                          <label class="control-label">DiJual (Y/T)</label>   
                                          <input style="width:10em;" type="text" class="form-control" name="dijual" id="dijual" required placeholder="Y / T" value="<?php echo $dijual; ?>" maxlength="1">
                                        </div>
                                        <div class="col-md-2" style="margin-left: 15%;">
                                            <img src='../gambar/<?php echo $filegambar; ?>' width='100px' height='100px'>
                                            <label class="control-label">Ubah Foto Produk</label>   
                                            <input type="hidden" name="MAX_FILE_SIZE" value="1000000"></input>                      
                                            <input style="width:30em;" type="file" class="form-control" name="foto_produk" id="foto_produk" placeholder="Foto Produk">
                                        </div>
                                    </div>            
                                    <div class="form-group">
                                        <div class="col-md-12 col-md-offset-1">
                                            <input onclick='myFunction()' name='input' value='Update' class='btn btn-primary' style="width:6em;">
                                            <input type="button" onClick="javascript:history.back()" name="reset" class="btn btn-warning" value="Batal">
                                        </div>
                                    </div> 
	</form>
  </div>
	</td>
</tr>
<tr>
<td colspan="2"><hr></td>
</tr>
<tr><td colspan="2"><?php footer_web();?></td></tr>
</table>

 <script>
        function myFunction() {         
            if(confirm("Anda yakin ingin mengubah data produk ini ?"))
              document.getElementById('ubah').submit();
            else
              return false;
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