<?php
	session_start();
	if(($_SESSION['sudahlogin']==true)&&($_SESSION['username']!="")) {
?>
<html>
<head>
<?php 
  include("../library/lib_func.php");
?>
<title>Data Pesanan Member - e-Order</title>
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
	<td valign="top"><div class="col-md-12 col-md-offset-0"><p class="judul">Pesanan Member e-Order</p>
	<?php
		$link=koneksi_db();
		$sql="SELECT p.id_pesanan IdPesanan,p.id_member,p.waktu,p.dicheckout,p.diarsipkan,
          i.id_pesanan IdPesananItem,i.id_produk,b.filegambar,b.nama,b.deskripsi, i.qty,i.harga,i.diskon
          FROM pesanan p JOIN pesanan_items i ON p.id_pesanan=i.id_pesanan
          JOIN produk b ON i.id_produk=b.id_produk
          WHERE p.dicheckout='Y' AND p.diarsipkan='T'
          ORDER BY p.id_pesanan"; 
		$res=mysql_query($sql,$link); 
		$banyakrecord=mysql_num_rows($res); 
		if($banyakrecord>0) { 
	?>				
					<hr>
					<form class="form-inline "name="cari" method="post" action="">
                        <div class="input-group custom-search-form">
                          <input style="width:15em;margin-top:1em; margin-right: 0.5em;" type="text" class="form-control" id="data_cari" name="data_cari" placeholder="Cari Pesanan"> <button style="margin-top: 1em;" class="btn btn-info" type="submit" name="cari">Cari</button>
                        </div>
                    </form>  
                    <hr> 
								<table class="table table-hover table-striped">
                                  <thead>
                                      <tr>
                                          <th>ID Pesanan</th>
                                          <th>Waktu Pesan</th>
                                          <th>Foto</th>
                                          <th>Nama Produk</th>
                                          <th>Deskripsi</th>
                                          <th>QTY</th>
                                          <th>Diskon</th>
                                          <th>Total</th>
                                          <th colspan="2" class="text-center">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                      if(isset($_POST['cari']))
                                      {
                                        $datacari=$_POST['data_cari'];
                                        $select="SELECT p.id_pesanan IdPesanan,p.id_member,p.waktu,p.dicheckout,p.diarsipkan,
                                        i.id_pesanan IdPesananItem,i.id_produk,b.filegambar,b.nama,b.deskripsi, i.qty,i.harga,i.diskon
                                        FROM pesanan p JOIN pesanan_items i ON p.id_pesanan=i.id_pesanan
                                        JOIN produk b ON i.id_produk=b.id_produk
                                        WHERE p.dicheckout='T' and (IdPesanan LIKE '%$datacari%' OR p.waktu LIKE '%$datacari%' OR IdPesananItem LIKE '%$datacari%' OR i.id_produk LIKE '%$datacari%' OR b.nama LIKE '%$datacari%' OR b.deskripsi LIKE '%$datacari%' OR i.qty LIKE '%$datacari%' OR i.harga LIKE '%$datacari%' OR i.diskon LIKE '%$datacari%') 
                                        ORDER BY p.id_pesanan"; 
                                      }//endif post cari
                                      else if(!isset($_POST['data_cari']))
                                          {
                                            $select="SELECT p.id_pesanan IdPesanan,p.id_member,p.waktu,p.dicheckout,p.diarsipkan,
                                            i.id_pesanan IdPesananItem,i.id_produk,b.filegambar,b.nama,b.deskripsi, i.qty,i.harga,i.diskon
                                            FROM pesanan p JOIN pesanan_items i ON p.id_pesanan=i.id_pesanan
                                            JOIN produk b ON i.id_produk=b.id_produk
                                            WHERE p.dicheckout='Y' AND p.diarsipkan='T'
                                            ORDER BY p.id_pesanan"; 
                                          }

                                      $no=1;//penomoran              
                                      $sql = mysql_query($select,$link);
                                      while($hasil = mysql_fetch_array($sql))
                                      {
                                        $id_pesanan = $hasil['IdPesanan'];
                                        $id_pesananitems = $hasil['IdPesananItem'];
                                        $id_member = $hasil['id_member'];
                                        $waktu_pesan = $hasil['waktu'];
                                        $dicheckout = $hasil['dicheckout'];
                                        $diarsipkan = $hasil['diarsipkan'];
                                        $id_produk = $hasil['id_produk'];
                                        $nama_produk = $hasil['nama'];
                                        $filegambar = $hasil['filegambar'];
                                        $qty = $hasil['qty'];
                                        $diskon = $hasil['diskon'];
                                        $harga_total = $hasil['harga'];
                                        $deskripsi_produk = $hasil['deskripsi'];
                                        echo "
                                                <tr>
                                                    
                                                    <td style='vertical-align:middle;'>$id_pesanan</td>
                                                    <td style='vertical-align:middle;'>$waktu_pesan</td>
                                                    <td style='vertical-align:middle;'><img src='../gambar/$filegambar' width='180px' height='180px'></td></td>
                                                    <td style='vertical-align:middle;'>$nama_produk</td>
                                                    <td style='vertical-align:middle;'>$deskripsi_produk</td>
                                                    <td style='vertical-align:middle;'>$qty</td>
                                                    <td style='vertical-align:middle;'>Rp. $diskon</td>
                                                    <td style='vertical-align:middle;'>Rp. $harga_total</td>
                                                    <td style='vertical-align:middle;' align='center'>
                                                      <a class='btn btn-primary' type='submit' href='pesanan_proses.php?id_pesanan=$id_pesanan'>
                                                        Kirim Email
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
          <div class="warning">Maaf saat ini belum ada produk e-Order yang telah di checkout oleh Member!</div>
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
</body>
</html>
<?php
	}
	else{
		header("Location: belumlogin.php");
	}
?>