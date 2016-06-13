<?php

		include("../library/lib_func.php");

			$id_produk=$_GET['id_produk'];   	
			$nama_produk=$_POST['nama_produk'];
		    $id_kategori=$_POST['id_kategori_produk'];
		    $id_merk=$_POST['id_merk_produk'];
		    $berat_produk = $_POST['berat_produk'];
		    $harga_produk = $_POST['harga_produk'];
		    $diskon_produk = $_POST['diskon_produk'];
		    $stok_produk = $_POST['stok_produk'];
		    $dijual = $_POST['dijual'];
		    $deskripsi_produk = $_POST['deskripsi_produk'];
			$link=koneksi_db();

			if($_FILES['foto_produk']['error']==0) {
				//echo "upload file";
				$query_gambar = mysql_query("SELECT filegambar from produk WHERE id_produk='$id_produk'",$link);
				if(mysql_num_rows($query_gambar)==1) { 
					$data = mysql_fetch_array($query_gambar);
					$target = "../gambar/".$data['filegambar'];
					if(file_exists($target)) {
						unlink($target);//hapus file lama
					}
					if(file_exists($target)) {
						echo "<script type='text/javascript'>
					                    window.alert('Ada masalah dalam perubahan gambar. Silahkan coba lagi !')
					          </script>
					          <script>document.location='produk_edit.php?id_produk=$id_produk'</script>";
					} else {
						$namafilefotobaru = "../gambar/".$_FILES['foto_produk']['name'];
					    if(move_uploaded_file($_FILES['foto_produk']['tmp_name'], $namafilefotobaru)==true){
					          $namafilefoto=$_FILES['foto_produk']['name'];
					          $update="UPDATE produk SET  
							            id_kategori = '$id_kategori',
							            id_merk = '$id_merk',
							            nama = '$nama_produk',
							            harga = '$harga_produk',
							            berat = '$berat_produk',
							            diskon = '$diskon_produk',
							            stok = '$stok_produk',
							            dijual = '$dijual',
							            deskripsi = '$deskripsi_produk',
							            filegambar = '$namafilefoto'
							            WHERE id_produk='$id_produk'";
					      }
					}
				}
			}
			else {
				//echo "Tidak upload file";
				$update="UPDATE produk SET  
							id_kategori = '$id_kategori',
							id_merk = '$id_merk',
							nama = '$nama_produk',
							harga = '$harga_produk',
							berat = '$berat_produk',
							diskon = '$diskon_produk',
							stok = '$stok_produk',
							dijual = '$dijual',
							deskripsi = '$deskripsi_produk'
							WHERE id_produk='$id_produk'";
			}

      		
      		
			$res=mysql_query($update,$link); 
            if(!$res ) {
               echo "<script type='text/javascript'>
						window.alert('die('Could not update data: ' . mysql_error())')
					  </script>";
            } else {
            	echo "<script type='text/javascript'>
						window.alert('Data produk is success updated!')
					  </script>
					  <script>document.location='produk_add_view.php'</script>
					  ";
				}	  
?>