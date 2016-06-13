<?php
	session_start();
	if(($_SESSION['membersudahlogin']==true)&&($_SESSION['id_member']!="")) {
?>
<html>
<head>
<?php 
	include("library/lib_func_member.php");
?>
<title>Pesan Produk - e-Order</title>
<link rel="SHORTCUT ICON" href="favicon.ico"> 
<?php require('head/style_member.php') ?>

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
	<td valign="top"><div class="col-md-12 col-md-offset-0"><p class="judul">Pesan Produk e-Order</p>
	 	
	<?php
		$link=koneksi_db();
		$sql="SELECT p.id_produk,p.nama NamaProduk,
          m.nama NamaMerk,k.nama NamaKategori,
          p.berat,p.harga,p.diskon,p.stok,p.filegambar,p.dijual
          FROM produk p JOIN merk m ON p.id_merk=m.id_merk
          JOIN kategori k ON p.id_kategori=k.id_kategori
          WHERE p.dihapus='T' AND p.stok>0 AND p.dijual='Y'
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
                                          <th>Foto</th>
                                          <th>Nama Produk</th>
                                          <th>Merk</th>
                                          <th>Kategori</th>
                                          <th>Harga</th>
                                          <th>Diskon</th>
                                          <th>Stok</th>
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
                                                              WHERE p.dihapus='T' AND p.stok>0 AND p.dijual='Y'
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
                                                    <td style='vertical-align:middle;'><img src='gambar/$filegambar' width='180px' height='180px'></td></td>
                                                    <td style='vertical-align:middle;'>$nama_produk</td>
                                                    <td style='vertical-align:middle;'>$nama_merk</td>
                                                    <td style='vertical-align:middle;'>$nama_kategori</td>
                                                    <td style='vertical-align:middle;'>Rp. $harga</td>
                                                    <td style='vertical-align:middle;'>$diskon</td>
                                                    <td style='vertical-align:middle;'>$stok</td>
                                                    <td style='vertical-align:middle;' align='center'>
                                                      <a class='btn btn-success' type='submit' href='pesan_produk_lanjut.php?id_produk=$id_produk'>
                                                        Pesan
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
          <div class="warning">Maaf saat ini belum ada produk yang dijual di e-Order!</div>
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