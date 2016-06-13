<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	include("../library/lib_func.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="SHORTCUT ICON" href="../favicon.ico"> 
<?php require('../head/style_admin.php') ?>
<title>Gagal Login Admin- e-Order</title>
</head>

<body>
	<table width="100%" border="0" bordercolor="transparent">
	<tr>
		<td colspan="2" align="center" bgcolor="#999999"> <?php header_web(); ?> 
		</td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td width="200px" valign="top" bgcolor="white"> <?php menu(); ?> 
		</td>
		<td valign="top">
			<div class="col-md-12 col-md-offset-0">
		<p class="judul">GAGAL LOGIN</p>
				<p class="warning">Username atau Password Admin yang Anda masukkan salah. <br />
				Silahkan ulangi proses Login
				</p>
			</div>
			<p>&nbsp;</p>
		</td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td colspan="2" align="center" bgcolor="#FFCC00">
			<?php footer_web(); ?>
		</td>
	</tr>
	</table>
</body>
</html>
