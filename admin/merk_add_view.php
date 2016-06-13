<?php
	session_start();
	if(($_SESSION['sudahlogin']==true)&&($_SESSION['username']!="")) {
?>
<html>
<head>
<?php 
	include("../library/lib_func.php");
?>
<title>Data Merk - e-Order</title>
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
    <p class="judul">Data MERK e-Order</p>
	 	<form class="form-horizontal" method="post" action="" name="input">
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <label class="control-label">Nama Merk</label>                                        
                                            <input style="width:25em;" type="text" class="form-control" name="nama_merk" id="nama_merk" required placeholder="Nama Merk">
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
		$sql="select * from merk where dihapus='T'"; 
		$res=mysql_query($sql,$link); 
		$banyakrecord=mysql_num_rows($res); 
		if($banyakrecord>0) { 
	?>				
					<hr>
					<form class="form-inline "name="cari" method="post" action="">
                        <div class="input-group custom-search-form">
                          <input style="width:15em;margin-top:1em; margin-right: 0.5em;" type="text" class="form-control" id="data_cari" name="data_cari" placeholder="Cari Merk"> <button style="margin-top: 1em;" class="btn btn-info" type="submit" name="cari">Cari</button>
                        </div>
                    </form>  
                    <hr> 
								<table class="table table-hover table-striped">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama Merk</th>
                                          <th colspan="2" class="text-center">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                      if(isset($_POST['cari']))
                                      {
                                        $datacari=$_POST['data_cari'];
                                        $select_admin = "SELECT * from merk where nama like '%$datacari%'";
                                      }//endif post cari
                                      else if(!isset($_POST['data_cari']))
                                          {
                                            $select_admin  = "select * from merk where dihapus='T'";
                                          }

                                      $no=1;//penomoran              
                                      $sql = mysql_query($select_admin,$link);
                                      while($hasil = mysql_fetch_array($sql))
                                      {
                                        $id_merk = $hasil['id_merk'];
                                        $nama = $hasil['nama'];
                                        echo "
                                                <tr>
                                                    <td>$no</td>
                                                    <td>$nama</td>
                                                    <td align='center'>
                                                      <a class='btn btn-primary' type='submit' href='merk_edit.php?id_merk=$id_merk'>
                                                        Ubah
                                                      </a>
                                                    </td>
                                                    <td align='center'>
                                                      <a id='hapus' class='btn btn-danger' href='merk_delete.php?id_merk=$id_merk' onclick='return myFunction()'>
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
          <div class="warning">Data merk masih kosong!</div>
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
		$nama=$_POST['nama_merk'];

		$link=koneksi_db();
		$sql="insert into merk values('','$nama','T')"; 
		$res=mysql_query($sql,$link); 
		if($res) {
		?> 
			<script type='text/javascript'>
            	window.alert('Data Merk <?php echo $nama;?> berhasil disimpan!')
			</script>
            <script>document.location='merk_add_view.php'</script>
		<?php
		} 
		else{
			
		?> 
			<script type='text/javascript'>
            	window.alert('Terjadi kesalahan dalam penyimpanan data merk baru dengan kesalahan <?php echo mysql_error($link);?>. Silahkan diulang lagi!<br>')
            </script>
            <script>document.location='merk_add_view.php'</script>
		<?php
		} 
	}		
?>
<script>
    function myFunction() {         
        return confirm("Anda yakin ingin menghapus data merk ini ?");
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