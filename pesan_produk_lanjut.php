<?php
	session_start();
	if(($_SESSION['membersudahlogin']==true)&&($_SESSION['id_member']!="")) {
?>
<html>
<head>
<?php 
  include("library/lib_func_member.php");
?>
<title>Pesan Produk Lanjut - e-Order</title>
<link rel="SHORTCUT ICON" href="favicon.ico"> 
<?php require('head/style_member.php') ?>

</head>
<body>
<table width="100%" align="center">
<tr><td colspan=2 align="center"><?php header_web();?></td></tr>
<tr>
<tr>
<td colspan="2"><hr></td>
</tr>
	<td width="200px" valign="top"><?php menu();?></td>
	<td valign="top">
  <div class="col-md-12 col-md-offset-0">
  <p class="judul">Pesan Produk e-Order</p>
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
     <center>
        <img src='gambar/<?php echo $filegambar; ?>' width='255px' height='255px'>
        <p>                               <?php
                                            $res=mysql_query("SELECT id_kategori,nama FROM kategori 
                                                              WHERE dihapus='T'
                                                              ORDER BY nama",$link);
                                            while($data=mysql_fetch_array($res)){
                                                if($id_kategori == $data['id_kategori']){
                                                    echo "<sub>".$data['nama']."</sub>";
                                                }
                                            }
                                           ?>
                                           <?php
                                            $res=mysql_query("SELECT id_merk,nama FROM merk 
                                                              WHERE dihapus='T'
                                                              ORDER BY nama",$link);
                                            while($data=mysql_fetch_array($res)) {
                                                if($id_merk == $data['id_merk']) {
                                                    echo "<sub>".$data['nama']."</sub>";
                                                }
                                                
                                            }
                                           ?>
            <b><?php echo $nama_produk; ?></b>
        <br>
        Detail :<br>
        <?php echo "$deskripsi"; ?>
        </p>
        <p>Harga Rp. <?php echo $harga; ?> | Diskon <?php echo $diskon; ?> %<br>
        Tersedia : <?php echo $stok; ?> lagi
        </p>
     </center>

                          <form id="lanjut" class="form-horizontal" enctype="multipart/form-data" method="post" action="" name="lanjut">
                                     <center>
                                     <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">Jumlah Pesan</label>                         
                                            <input style="width:10em;" type="number" class="form-control" name="jumlah_beli" id="jumlah_beli" required placeholder="Jumlah" value="<?php echo $nama_produk; ?>">
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="submit" name="lanjut" class="btn btn-success" value="Pesan">
                                            <input type="reset" name="reset" class="btn btn-warning" value="Reset">
                                        </div>
                                    </div> 
                                    </center>
	                         </form>
      <?php
  if(isset($_POST['lanjut'])) {
    $id_member = $_SESSION['id_member'];
    $qty=$_POST['jumlah_beli'];
    if($qty > $stok) {
    ?>
        <script type='text/javascript'>
                              window.alert('Jumlah beli barang yang dimasukkan tidak sesuai dengan jumlah stok yang tersedia.\n Silahkan coba lagi !')
            </script>
  <?php
    } else {

      $hitdiskon = ($diskon/100) * $harga;
      $hargabayar = ($harga - $hitdiskon) * $qty;
      $link=koneksi_db();
      $sql="insert into pesanan values('','$id_member',NOW(),'T','T')";
      $res=mysql_query($sql,$link); 
      if($res) {
          $selectpesanan=mysql_query("SELECT id_pesanan FROM pesanan ORDER BY id_pesanan desc LIMIT 1",$link);
          $datapesanan = mysql_fetch_array($selectpesanan);
          $id_pesananbaru = $datapesanan['id_pesanan'];

          $sql2="insert into pesanan_items values('$id_pesananbaru','$id_produk','$qty','$hargabayar','$hitdiskon')";
          $res2 = mysql_query($sql2,$link);
          if($res2){
            ?>
            <script type='text/javascript'>
                window.alert('Pesanan telah dimasukkan ke keranjang !')
            </script>
          <?php
          }
      ?> 
        <script type='text/javascript'>
                window.alert('Silahkan checkout pesanan untuk melanjutkan pemesanan !')
        </script>
        <script>document.location='pesan_produk.php'</script>
      <?php
      } 
      else{
      ?> 
        
        <script type='text/javascript'>
                window.alert('Terjadi kesalahan dalam proses pemesanan. Silahkan diulang lagi!')
              </script>
              <script>document.location='pesan_produk.php'</script>
        
      <?php
      }
    } 
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


</body>
</html>
<?php
	}
	else{
		header("Location: belumlogin.php");
	}
?>