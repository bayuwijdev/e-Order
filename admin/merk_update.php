<?php

		include("../library/lib_func.php");
			$id_merk=$_GET['id_merk'];    	
			$nama=$_POST['nama_merk'];
			    
      		
      		$update="UPDATE merk SET  
            nama = '$nama'
            WHERE id_merk='$id_merk'";

		$link=koneksi_db();

		$res=mysql_query($update,$link); 
            if(!$res ) {
               echo "<script type='text/javascript'>
						window.alert('die('Could not update data: ' . mysql_error())')
					  </script>";
            }
            echo "<script type='text/javascript'>
						window.alert('Updated data merk is success!')
					  </script>
					  <script>document.location='merk_add_view.php'</script>
					  ";
?>