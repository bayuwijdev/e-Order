<?php
	session_start();
	 if(($_SESSION['sudahlogin']==true)&&($_SESSION['username']!="")) {
?>
<html>
<head>
<?php 
	include("../library/lib_func.php");
?>
<title>Proses Pesanan Member - e-Order</title>
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
    <p class="judul">Kirim Email dan Arsipkan Pesanan e-Order</p>
	 <?php 
      $id_pesanan = $_REQUEST['id_pesanan'];
      $link=koneksi_db();
      $q=mysql_query("SELECT p.id_pesanan IdPesanan,p.id_member IdMemberPesanan,m.nama NamaMember,m.id_member IdMember, p.waktu,p.dicheckout,p.diarsipkan,
          i.id_pesanan IdPesananItem,i.id_produk,b.filegambar,b.nama NamaProduk,b.deskripsi, i.qty,i.harga,i.diskon
          FROM pesanan p JOIN pesanan_items i ON p.id_pesanan=i.id_pesanan JOIN member m ON p.id_member=m.id_member
          JOIN produk b ON i.id_produk=b.id_produk
          WHERE p.dicheckout='Y' AND p.diarsipkan='T' AND p.id_pesanan='$id_pesanan'
          ORDER BY p.id_pesanan",$link);

      $hasil = mysql_fetch_array($q);
                                        $id_pesanan = $hasil['IdPesanan'];
                                        $id_pesananitems = $hasil['IdPesananItem'];
                                        $id_member = $hasil['IdMember'];
                                        $id_memberpesanan = $hasil['IdMemberPesanan'];
                                        $nama_member = $hasil['NamaMember'];
                                        $waktu_pesan = $hasil['waktu'];
                                        $dicheckout = $hasil['dicheckout'];
                                        $diarsipkan = $hasil['diarsipkan'];
                                        $id_produk = $hasil['id_produk'];
                                        $nama_produk = $hasil['NamaProduk'];
                                        $filegambar = $hasil['filegambar'];
                                        $qty = $hasil['qty'];
                                        $diskon = $hasil['diskon'];
                                        $harga_total = $hasil['harga'];
                                        $deskripsi_produk = $hasil['deskripsi'];
   ?>

                          <form id="ubah" class="form-horizontal" method="post" action="pesanan_kirimemail_arsipkan.php?id_pesanan=<?php echo $id_pesanan; ?>" name="input">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label class="control-label">Email Member yang Memesan</label>                                        
                                            <input style="width:25em;" type="text" class="form-control" name="id_member" id="id_member" required readonly placeholder="Id Member" value="<?php echo $id_memberpesanan; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <label class="control-label">Pesan Pembayaran</label>                         
                                            <textarea style="width:40em;height: 35em; text-align: justify; white-space: normal;" type="text" class="form-control" name="isi_pesan" id="isi_pesan" placeholder="Pesan Proses Pembayaran">
                                              <?php 
                                                echo "e-Order\n";
                                                echo "Terimakasih $nama_member telah melakukan pemesanan di e-Order dengan detail pemesanan sebagai berikut :\n\n";
                                                echo "ID Pesanan : ";
                                                echo htmlspecialchars($id_pesanan); echo "\n";
                                                echo "Waktu pemesanan : ";
                                                echo htmlspecialchars($waktu_pesan); echo "\n";
                                                echo "Nama Produk : ";
                                                echo htmlspecialchars($nama_produk); echo "\n";
                                                echo "Deskripsi Produk : ";
                                                echo htmlspecialchars($deskripsi_produk); echo "\n";
                                                
                                                echo "Jumlah Produk yg di pesan : ";
                                                echo htmlspecialchars($qty); echo "\n";
                                                echo "Diskon : Rp. ";
                                                echo htmlspecialchars($diskon); echo "\n";
                                                echo "Harga Total : Rp. ";
                                                echo htmlspecialchars($harga_total); echo "\n\n";
                                                
                                                echo "Silahkan lakukan proses pembayaran berikut ini : \n";

                                                echo "Kamu dapat melakukan pembayaran dengan Transfer sejumlah $harga_total ke Nomor Rekening 0307429851 A/N Bayu Wijaya Permana Putra\n";
                                                echo "Perhatian :\n";
                                                echo "Jika dalam waktu 2 x 24 jam kamu belum transfer, maka kami akan membatalkan pemesanan yang telah kamu lakukan.\n";
                                                echo "Jika kamu telah berhasil melakukan pembayaran transfer sebelum 2 x 24 setelah kami konfirmasi, produk yang kamu pesan akan kami kirim via JNE ke alamat kamu.\n";
                                                echo "\n\n";
                                                echo "Salam,\n";
                                                echo "Bayu Wijaya Permana Putra\n";
                                                echo "Copyright © 2016 e-Order by Bayu Wijaya Permana Putra. All Rights Reserved\n";
                                                echo"Kp. Sekejulang RT 01 RW 02 Jl. Bukit Raya No. 271 Ciumbuleuit.\n";
                                                echo"Bandung. Indonesia. 40142";

                                              ?>
                                            </textarea>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <div class="col-md-12 col-md-offset-1">
                                            <input onclick='myFunction()' name='input' value='Kirim' class='btn btn-primary' style="width:6em;">
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
            if(confirm("Anda yakin ingin mengirim email proses pembayaran, dan mengarsipkan pesanan member ini ?"))
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