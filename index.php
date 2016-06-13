<?php 
  session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
  include("library/lib_func_member.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Situs - E-Order</title>
<link rel="SHORTCUT ICON" href="favicon.ico"> 
<?php require('head/style_member.php') ?>
</head>
<body>
<table width="100%" align="center" border=0 bordercolor="#FFFFFF"> 
  <tr>
    <td colspan=2 align="center" bgcolor="#0000CC"><?php header_web();?></td>
  </tr>
  <tr>
    <td colspan="2"><hr></td>
  </tr>
  <tr> 
    <td width="200px" valign="top" bgcolor="white"><?php menu();?></td> 
    <td valign="top" align="center">
    <div class="col-md-12 col-md-offset-0">
        <?php if(isset($_SESSION['membersudahlogin'])) { $nama = $_SESSION['nama_member']; echo "<p><h2>Selamat datang $nama </h2></p> <br><p>Selamat berbelanja di situs e-Order.</p>"; } else { echo "<p>Toko Sagala Aya menyediakan berbagai jenis perangkat komputer dan elektronik sesuai dengan kebutuhan Anda</p>"; } ?> 
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
  <tr><td colspan="2"><?php footer_web();?></td>
  </tr> 
</table>
</body>
</html>
