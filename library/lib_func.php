<?php	
	
	function header_web(){
	?> 
		<center><font color="black" size=6>SITUS ADMINISTRATOR</font></center>
	<?php
	}
	function footer_web(){
	?> 
		<footer>
		    <p align="center"> 2016 &copy <a href="index.php">E-Order</a> by Bayu Wijaya Permana Putra</p>
		</footer>
	<?php
	}
	function form_login(){
	?> 
		<form method="post" action="login.php">
			<table border=0 width="100%" bgcolor="transparent" align="center">
				<tr><td align="center" bgcolor="#CCCCCC"><b>LOGIN</b></td> </tr>
				<tr>
					<td>
						<input style="width:100%; margin-left: 0.5em; margin-bottom: 0.5em; margin-top: 1em; padding: 2%;" required type="text" class="form-control" name="username" required id="username" placeholder="Username Admin" maxlength="15" size="9">
					</td>
				</tr>
				<tr><td>
					<input style="width:100%;padding: 2%; margin-bottom: 0.5em; margin-left: 0.5em;" type="password" class="form-control" name="password" id="password" required placeholder="Password Admin" size="9">
				</td></tr>
				<tr><td align="center">
					<input type="submit" name="btn_submit" style="margin-bottom: 1em;" class="btn btn-success" value="Login">
				</td></tr>
			</table>
		</form>
	<?php
	}

	function menu_super_admin(){
	?>
 	<div id="left">
 	<table border=0 width="100%" bgcolor="transparent">
		<tr><td align="center" bgcolor="#CCCCCC"><b>MENU SUPERADMIN</b></td></tr>
		<tr><td><hr></td></tr>

		<tr><td align="center"><a href="index.php">Beranda</a></td></tr>
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>
		<tr><td align="center" bgcolor="#FFCC00"><b>DATA ADMIN</b></td></tr>
		<tr><td align="center"><a href="admin_add_view.php">Kelola Data Admin</a></td></tr>
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>

		<tr><td align="center" bgcolor="#FFCC00"><b>DATA MERK</b></td></tr>
		<tr><td align="center"><a href="merk_add_view.php">Kelola Data Merk</a></td></tr>
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>

		<tr><td align="center" bgcolor="#FFCC00"><b>DATA KATEGORI</b></td></tr>
		<tr><td align="center"><a href="kategori_add_view.php">Kelola Data Kategori</a></td></tr>		
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>

		<tr><td align="center" bgcolor="#FFCC00"><b>DATA PRODUK</b></td></tr>
		<tr><td align="center"><a href="produk_add_view.php">Kelola Data Produk</a></td></tr>	
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>

		<tr><td align="center" bgcolor="#FFCC00"><b>DATA PESANAN</b></td></tr>
		<tr><td align="center"><a href="pesanan_view.php">Kelola Data Pesanan</a></td></tr>	
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>
		<tr><td><hr></td></tr>
		<tr><td align="center"><a href="logout.php">LOGOUT</a></td></tr>
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>
	</table>
	</div>
	<?php
	}

	function menu_admin(){
	?>
	<div id="left">
 	<table border=1 width="100%" bgcolor="transparent">
		<tr><td align="center" bgcolor="#CCCCCC"><b>MENU ADMIN</b></td></tr>
		<tr><td><hr></td></tr>

		<tr><td align="center"><a href="index.php">Beranda</a></td></tr>
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>

		<tr><td align="center" bgcolor="#FFCC00"><b>DATA MERK</b></td></tr>
		<tr><td align="center"><a href="merk_add_view.php">Kelola Data Merk</a></td></tr>
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>

		<tr><td align="center" bgcolor="#FFCC00"><b>DATA KATEGORI</b></td></tr>
		<tr><td align="center"><a href="kategori_add_view.php">Kelola Data Kategori</a></td></tr>		
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>

		<tr><td align="center" bgcolor="#FFCC00"><b>DATA PRODUK</b></td></tr>
		<tr><td align="center"><a href="produk_add_view.php">Kelola Data Produk</a></td></tr>	
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>

		<tr><td align="center" bgcolor="#FFCC00"><b>DATA PESANAN</b></td></tr>
		<tr><td align="center"><a href="pesanan_view.php">Kelola Data Pesanan</a></td></tr>	
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>

		<tr><td><hr></td></tr>
		<tr><td align="center"><a href="logout.php">LOGOUT</a></td></tr>
		<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>
	</table>
	</div>
	<?php
	}
	
	function menu(){
		if(isset($_SESSION['sudahlogin'])){
			$telahlogin = $_SESSION['sudahlogin'];
		} else {
			$telahlogin = false;
		}

		
		if($telahlogin==false)
			form_login();
		else {
			if(isset($_SESSION['level'])) {
				if($_SESSION['level']=='SUPERADMIN'){
					menu_super_admin();
				} else {
					menu_admin();
				}
			}
		}
	}
	
	function koneksi_db(){ 
        $host = "localhost"; 
        $database = "dbeorder10113218"; 
        $user = "root"; // isikan sesuai yang diisi sewaktu membuka PhpMyadmin
        $password = "";  // isikan sesuai yang diisi sewaktu membuka PhpMyadmin
        $link=mysql_connect($host,$user,$password); 
        mysql_select_db($database,$link);
        if(!$link) 
           echo "Error : ".mysql_error(); 
        return $link; 
    } 
	
?>
