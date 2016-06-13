<?php
	session_start();

	if(isset($_SESSION['username']) && isset($_SESSION['nama']) && isset($_SESSION['level']))
	{
		unset ($_SESSION['username']);
		unset ($_SESSION['nama']);
		unset ($_SESSION['level']);
		
		if(isset($_SESSION['sudahlogin']))
		{
			unset ($_SESSION['sudahlogin']);
		}
	}
	

	header("Location:index.php");
?>