<?php
	include("library/lib_func_member.php");
	$id_member = $_POST["id_member"];
	$userpass = $_POST["password_member"];
		$link = koneksi_db();
		$ressql = mysql_query("select * from member where id_member = '$id_member' and katasandi=password('$userpass')",$link);
		if(mysql_num_rows($ressql)==1) { // apabila id_member dan password benar
			$data = mysql_fetch_array($ressql);
			session_start();		
			$_SESSION['id_member'] = $data['id_member'];
			$_SESSION['nama_member'] = $data['nama'];
			$_SESSION['alamat_member'] = $data['alamat'];
			$_SESSION['membersudahlogin'] = true;
			$update="UPDATE member SET  
            loginterakhir = 'NOW()'
            WHERE id_member='$id_member'";

			$res=mysql_query($update,$link);
			header("Location:index.php"); // pindah ke halaman index.php
		} else {
			header("Location:gagallogin.php"); 
		}
