<?php
	session_start();
	if(($_SESSION['sudahlogin']==true)&&($_SESSION['username']!="")){
?>
<html>
<head>
<?php 
	include("../library/lib_func.php");
?>
<title>Bukan Superadmin - Situs e-Order</title>
<link rel="SHORTCUT ICON" href="../favicon.ico"> 
<?php require('../head/style_admin.php') ?>
</head>
<body>
<table width="100%" align="center">
<tr><td colspan=2 align="center"><?php header_web();?></td></tr>
<tr>
<td colspan="2"><hr></td>
</tr>
<tr>
	<td width="200px" valign="top" bgcolor="white"><?php menu();?></td>
	<td valign="top">
	<div class="col-md-12 col-md-offset-0">
		<p class="judul">ANDA BUKAN SUPERADMIN!</p>
	    <p align="center" class="warning">Anda tidak berhak mengakses halaman ini. Anda harus login sebagai superadmin!</p>
	    <p>&nbsp; </p>
	</div>
	</td>

</tr>
<tr>
		<td colspan="2"><br></td>
	</tr>
	<tr>
		<td colspan="2"><br></td>
	</tr>
	<tr>
		<td colspan="2"><br></td>
	</tr>
	<tr>
		<td colspan="2"><br></td>
	</tr>
	<tr>
		<td colspan="2"><br></td>
	</tr>
	<tr>
		<td colspan="2"><br></td>
	</tr>
	<tr>
		<td colspan="2"><br></td>
	</tr>
	<tr>
		<td colspan="2"><br></td>
	</tr>
	<tr>
		<td colspan="2"><br></td>
	</tr>
	<tr>
		<td colspan="2"><br></td>
	</tr>
	<tr>
		<td colspan="2"><br></td>
	</tr>
	<tr>
		<td colspan="2"><br></td>
	</tr>
	<tr>
		<td colspan="2"><br></td>
	</tr>
	<tr>
		<td colspan="2"><br></td>
	</tr>
<tr>
<td colspan="2"><hr></td>
</tr>
<tr><td colspan="2" ><?php footer_web();?></td></tr>
</table>
</body>
</html>
<?php
	}
	else{
		header("Location: belumlogin.php");
	}
?>