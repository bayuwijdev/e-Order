<?php
	session_start();
	if(($_SESSION['sudahlogin']==true)&&($_SESSION['level']=="SUPERADMIN")) {
?>
<html>
<head>
<?php 
	include("../library/lib_func.php");
?>
<title>Edit Data Kategori - e-Order</title>
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
	<td valign="top"><div class="col-md-12 col-md-offset-0">
    <p class="judul">Edit Data Kategori e-Order</p>
	 <?php 
      $id_kategori = $_REQUEST['id_kategori'];
      $link=koneksi_db();
      $q = mysql_query("SELECT * FROM kategori WHERE id_kategori = '".$_REQUEST['id_kategori']."' ") or die(mysql_error());
      $hasil = mysql_fetch_array($q);
        $id_kategori = $hasil['id_kategori'];
        $nama = $hasil['nama'];   
   ?>

                          <form id="ubah" class="form-horizontal" method="post" action="kategori_update.php?id_kategori=<?php echo $id_kategori; ?>" name="input">
                                    <div class="form-group">
                                        <div class="col-md-12 col-md-offset-1">
                                            <label class="control-label">Nama Kategori</label>                                        
                                            <input style="width:25em;" type="text" class="form-control" name="nama_kategori" id="nama_kategori" required placeholder="Nama Kategori" value="<?php echo $nama; ?>">
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
            if(confirm("Anda yakin ingin mengubah data kategori ini ?"))
              document.getElementById('ubah').submit();
            else
              return false;
        }
    </script> 
</body>
</html>
<?php
	}
	else{
		header("Location: belumlogin.php");
	}
?>