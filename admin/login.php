<?php
	include("../library/lib_func.php");
	$username = $_POST["username"];
	$userpass = $_POST["password"];
		$link = koneksi_db();
		$ressql = mysql_query("select * from admin where username = '$username' and password=password('$userpass')",$link);
		if(mysql_num_rows($ressql)==1) { // apabila username dan password benar
			$data = mysql_fetch_array($ressql);
			session_start();		
			$_SESSION['username'] = $data['username'];
			$_SESSION['nama'] = $data['nama'];
			$_SESSION['level'] = $data['level'];
			$_SESSION['sudahlogin'] = true;
			header("Location:index.php"); // pindah ke halaman index.php
		} else {
			header("Location:gagallogin.php"); 
		}
