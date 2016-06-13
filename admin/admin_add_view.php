<?php
	session_start();
	if(($_SESSION['sudahlogin']==true)&&($_SESSION['level']=="SUPERADMIN")) {
?>
<html>
<head>
<?php 
	include("../library/lib_func.php");
?>
<title>Data Admin - e-Order</title>
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
  <p class="judul">Data ADMIN e-Order</p>
    
	 	<form class="form-horizontal" method="post" action="" name="input">
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <label class="control-label">Nama</label>                                        
                                            <input style="width:25em;" type="text" class="form-control" name="nama_admin" id="nama_admin" required placeholder="Nama Admin">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <label class="control-label">Username</label>                                        
                                            <input style="width:15em;" required type="text" class="form-control" name="username_admin" required id="username_admin" placeholder="Username Admin">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <label class="control-label">Password</label>                                       
                                            <input style="width:15em;" type="password" class="form-control" name="password_admin" id="password_admin" required placeholder="Password Admin">
                                        </div>
                                    </div>           
                                    <div class="form-group">
                                        <div class="col-md-2 ">
                                            <label class="control-label">Level</label>                                       
                                            <input style="width:15em;" type="text" class="form-control" name="level_admin" id="level_admin" required placeholder="Level Admin">
                                        </div>
                                    </div>            
                                    <div class="form-group">
                                        <div class="col-md-2 ">
                                            <input type="submit" name="input" class="btn btn-success" value="Tambah">
                                            <input type="reset" name="reset" class="btn btn-warning" value="Reset">
                                        </div>
                                    </div> 
	</form>
	<?php
		$link=koneksi_db();
		$sql="select * from admin order by level DESC"; 
		$res=mysql_query($sql,$link); 
		$banyakrecord=mysql_num_rows($res); 
		if($banyakrecord>0) { 
	?>				
					<hr>
					<form class="form-inline "name="cari" method="post" action="">
                        <div class="input-group custom-search-form">
                          <input style="width:15em;margin-top:1em; margin-right: 0.5em;" type="text" class="form-control" id="data_cari" name="data_cari" placeholder="Cari Admin"> <button style="margin-top: 1em;" class="btn btn-info" type="submit" name="cari">Cari</button>
                        </div>
                    </form>  
                    <hr> 
								<table class="table table-hover table-striped">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Username</th>
                                          <th>Nama</th>
                                          <th>Level</th>
                                          <th colspan="2" class="text-center">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                      if(isset($_POST['cari']))
                                      {
                                        $datacari=$_POST['data_cari'];
                                        $select_admin = "SELECT * from admin where username like '%$datacari%' OR nama like '%$datacari%' OR level like '%$datacari%'";
                                      }//endif post cari
                                      else if(!isset($_POST['data_cari']))
                                          {
                                            $select_admin  = "select * from admin order by level DESC";
                                          }

                                      $no=1;//penomoran              
                                      $sql = mysql_query($select_admin,$link);
                                      while($hasil = mysql_fetch_array($sql))
                                      {
                                        $username = $hasil['username'];
                                        $nama = $hasil['nama'];
                                        $level = $hasil['level'];
                                        echo "
                                                <tr>
                                                    <td>$no</td>
                                                    <td>$username</td>
                                                    <td>$nama</td>
                                                    <td>$level</td>
                                                    <td align='center'>
                                                      <a class='btn btn-primary' type='submit' href='admin_edit.php?username=$username'>
                                                        Ubah
                                                      </a>
                                                    </td>
                                                    <td align='center'>
                                                      <a id='hapus' class='btn btn-danger' href='admin_delete.php?username=$username' onclick='return myFunction()'>
                                                        Hapus
                                                      </a>
                                                    </td>
                                                </tr>
                                            ";
                                        $no++;
                                      }//endwhile
                                    ?>
                                  </tbody>
                                </table>
    <?php 
    	}
    	else {
    ?>
          <div class="warning">Data admin tidak ditemukan!</div>
    <?php		
    	}

    ?>
    </div>
    </td>
</tr>
<tr>
<td colspan="2"><hr></td>
</tr>
<tr><td colspan="2"><?php footer_web();?></td></tr>
</table>
<?php
	if(isset($_POST['input'])) {
		$nama=$_POST['nama_admin'];
		$username=$_POST['username_admin'];
		$userpass=$_POST['password_admin'];
		$level=$_POST['level_admin']; 

		$link=koneksi_db();
		$sql="insert into admin values('$username',password('$userpass'),'$nama','$level')"; 
		$res=mysql_query($sql,$link); 
		if($res) {
		?> 
			<script type='text/javascript'>
            	window.alert('Data Admin <?php echo $nama;?> dengan username <?php echo $username;?> berhasil disimpan!')
			</script>
            <script>document.location='admin_add_view.php'</script>
		<?php
		} 
		else{
			
		?> 
			<script type='text/javascript'>
            	window.alert('Terjadi kesalahan dalam penyimpanan data admin baru dengan kesalahan <?php echo mysql_error($link);?>. Silahkan diulang lagi!<br>')
            </script>
            <script>document.location='admin_add_view.php'</script>
		<?php
		} 
	}		
?>
<script>
    function myFunction() {         
        return confirm("Anda yakin ingin menghapus data admin ini ?");
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