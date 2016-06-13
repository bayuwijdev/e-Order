<?php

		include("../library/lib_func.php");
			$id_kategori=$_GET['id_kategori'];    	
			$nama=$_POST['nama_kategori'];
			    
      		
      		$update="UPDATE kategori SET  
            nama = '$nama'
            WHERE id_kategori='$id_kategori'";

		$link=koneksi_db();

		$res=mysql_query($update,$link); 
            if(!$res ) {
               echo "<script type='text/javascript'>
						window.alert('die('Could not update data: ' . mysql_error())')
					  </script>";
            }
            echo "<script type='text/javascript'>
						window.alert('Updated data kategori is success!')
					  </script>
					  <script>document.location='kategori_add_view.php'</script>
					  ";
?>