<?php

		include("../library/lib_func.php");
			$username=$_POST['username_admin'];    	
			$nama=$_POST['nama_admin'];
			$pass=$_POST['password_admin'];
			$level=$_POST['level_admin'];
			    
      		
      		$update="UPDATE admin SET  
            username = '$username', 
            nama = '$nama',
            password = password('$pass'),
            level = '$level'
            WHERE username='$username'";

		$link=koneksi_db();

		$res=mysql_query($update,$link); 
            if(!$res ) {
               echo "<script type='text/javascript'>
						window.alert('die('Could not update data: ' . mysql_error())')
					  </script>";
            }
            echo "<script type='text/javascript'>
						window.alert('Updated data successfully!')
					  </script>
					  <script>document.location='admin_add_view.php'</script>
					  ";
?>