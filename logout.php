<?php
	session_start();
	if(isset($_SESSION['id_member']) && isset($_SESSION['nama_member']) && isset($_SESSION['alamat_member']))
	{
		unset ($_SESSION['id_member']);
		unset ($_SESSION['nama_member']);
		unset ($_SESSION['alamat_member']);
		
		if(isset($_SESSION['membersudahlogin']))
		{
			unset ($_SESSION['membersudahlogin']);
		}
	}
	header("Location:index.php");
?>