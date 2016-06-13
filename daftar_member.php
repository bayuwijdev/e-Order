<html>
<head>
<?php 
	include("library/lib_func_member.php");
?>
<title>Registrasi Member - e-Order</title>
<link rel="SHORTCUT ICON" href="../favicon.ico"> 
<?php require('head/style_member.php') ?>

</head>
<body>
<table width="100%" align="center">
<tr><td colspan=2 align="center"><?php header_web();?></td></tr>
<tr>
<tr>
<td colspan="2"><hr></td>
</tr>
	<td width="200px" valign="top"><?php menu();?></td>
	<td valign="top"><p class="judul">Pendaftar Member e-Order</p>
	 	                     <form class="form-horizontal" method="post" action="" name="input">
                                    <div class="form-group" style="margin-left: 10%">
                                        <div class="col-md-4">
                                            <label class="control-label">Nama</label>                                        
                                            <input style="width:25em;" type="text" class="form-control" name="nama_member" id="nama_member" required placeholder="Nama Lengkap Anda">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-left: 10%">
                                        <div class="col-md-4">
                                            <label class="control-label">Email (email ini sebagai ID Member Anda)</label>                                        
                                            <input style="width:25em;" required type="email" class="form-control" name="id_member" required id="id_member" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-left: 10%">
                                        <div class="col-md-4">
                                            <label class="control-label">Alamat</label>                         
                                            <textarea style="width:30em;" type="text" class="form-control" name="alamat_member" id="alamat_member" placeholder="Alamat Lengkap"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-left: 10%">
                                        <div class="col-md-4">
                                            <label class="control-label">Password</label>                                       
                                            <input style="width:15em;" type="password" class="form-control" name="password_member" id="password_member" required placeholder="Password">
                                        </div>
                                    </div>           
                                    <div class="form-group" style="margin-left: 10%">
                                        <div class="col-md-4 ">
                                            <label class="control-label">Ketik Ulang Password</label>                                       
                                            <input style="width:15em;" type="password" class="form-control" name="conf_password_member" id="conf_password_member" required placeholder="Ketik Password Lagi"><span id='message'></span>
                                            
                                        </div>
                                    </div>            
                                    <div class="form-group" style="margin-left: 10%">
                                        <div class="col-md-4 ">
                                            <input type="submit" name="input" class="btn btn-success" onclick="return passValidate()" value="Tambah">
                                            <input type="reset" name="reset" class="btn btn-warning" value="Reset">
                                        </div>
                                    </div> 
	</form>
    </td>
</tr>
<tr>
<td colspan="2"><hr></td>
</tr>
<tr><td colspan="2"><?php footer_web();?></td></tr>
</table>
<?php
	if(isset($_POST['input'])) {
		$id_member=$_POST['id_member'];
    $nama=$_POST['nama_member'];
		$alamat=$_POST['alamat_member']; 
    $userpass=$_POST['password_member'];
		
		$link=koneksi_db();
		$sql="insert into member values('$id_member','$nama','$alamat',password('$userpass'),'')"; 
		$res=mysql_query($sql,$link); 
		if($res) {
		?> 
			<script type='text/javascript'>
            	window.alert('Halo <?php echo $nama;?>, Anda berhasil menjadi member e-Order dengan ID Member <?php echo $id_member;?>\nSilahkan lakukan login dengan akun member Anda !')
			</script>
		<?php
		} 
		else{
			
		?> 
			<script type='text/javascript'>
            	window.alert('Terjadi kesalahan dalam pendaftaran member baru dengan kesalahan <?php echo mysql_error($link);?>. Silahkan diulang lagi!')
            </script>
		<?php
		}
	}		
?>
<script type="text/javascript">
    function passValidate() {
        var password = document.getElementById("password_member").value;
        var confirmPassword = document.getElementById("conf_password_member").value;
        if (password != confirmPassword) {
            alert("Passwords tidak sama!");
            return false;
        }
        return true;
    }
</script>
                                          
</body>
</html>