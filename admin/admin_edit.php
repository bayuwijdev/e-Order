<?php
	session_start();
	if(($_SESSION['sudahlogin']==true)&&($_SESSION['level']=="SUPERADMIN")) {
?>
<html>
<head>
<?php 
	include("../library/lib_func.php");
?>
<title>Edit Data Admin - e-Order</title>
<link rel="SHORTCUT ICON" href="../favicon.ico"> 
<?php require('../head/style_admin.php') ?>

</head>
<body>
<table width="100%" align="center">
<tr><td colspan=2 align="center"><?php header_web();?></td></tr>
<tr>
<tr>
<td colspan="2"><hr></td>
</tr>
	<td width="200px" valign="top"><?php menu();?></td>
	<td valign="top">
    <div class="col-md-12 col-md-offset-0">
    <p class="judul">Edit Data ADMIN e-Order</p>
	 <?php 
      $username = $_REQUEST['username'];
      $link=koneksi_db();
      $q = mysql_query("SELECT * FROM admin WHERE username = '".$_REQUEST['username']."' ") or die(mysql_error());
      $hasil = mysql_fetch_array($q);
        $username = $hasil['username'];
        $nama = $hasil['nama'];
        $level = $hasil['level'];   
   ?>

                          <form id="ubah" class="form-horizontal" method="post" action="admin_update.php" name="input">
                                    <div class="form-group">
                                        <div class="col-md-12 col-md-offset-1">
                                            <label class="control-label">Nama</label>                                        
                                            <input style="width:25em;" type="text" class="form-control" name="nama_admin" id="nama_admin" required placeholder="Nama Admin" value="<?php echo $nama; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-md-offset-1">
                                            <label class="control-label">Username</label>                                        
                                            <input style="width:15em;" required type="text" class="form-control" name="username_admin" required readonly id="username_admin" placeholder="Username Admin" value="<?php echo $username; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-md-offset-1">
                                            <label class="control-label">Password</label>       
                                            <br>*Isi jika ingin ubah password, biarkan kosong jika tidak ingin mengubah password                                
                                            <input style="width:15em;" type="text" class="form-control" name="password_admin" id="password_admin" required placeholder="Password Admin"> 
                                        </div>
                                    </div>           
                                    <div class="form-group">
                                        <div class="col-md-12 col-md-offset-1">
                                            <label class="control-label">Level</label>                                       
                                            <input style="width:15em;" type="text" class="form-control" name="level_admin" id="level_admin" required placeholder="Level Admin" value="<?php echo $level; ?>">
                                        </div>
                                    </div>            
                                    <div class="form-group">
                                        <div class="col-md-12 col-md-offset-1">
                                            <input onclick='myFunction()' name='input' value='Update' class='btn btn-primary' style="width:6em;">
                                            <input type="button" onClick="javascript:history.back()" name="reset" class="btn btn-warning" value="Batal">
                                        </div>
                                    </div> 
	</form>
    </div>
	</td>
</tr>
<tr>
<td colspan="2"><hr></td>
</tr>
<tr><td colspan="2"><?php footer_web();?></td></tr>
</table>

 <script>
        function myFunction() {         
            if(confirm("Anda yakin ingin mengubah data ini ?"))
              document.getElementById('ubah').submit();
            else
              return false;
        }
    </script> 
</body>
</html>
<?php
	}
	else if(($_SESSION['sudahlogin']==true)&&($_SESSION['level']!="SUPERADMIN")){
		header("Location: bukansuperadmin.php");
	}
	else{
		header("Location: belumlogin.php");
	}
?>