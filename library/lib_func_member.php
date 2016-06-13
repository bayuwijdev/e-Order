<?php	
	
	function header_web(){
	?> 
		<center><font color="black" size=6>Situs Toko Sagala Aya</font></center>
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
				<tr><td align="center" bgcolor="#CCCCCC"><b>LOGIN MEMBER</b></td> </tr>
				<tr><td><input style="width:100%; margin-left: 0.5em; margin-bottom: 0.5em; margin-top: 1em; padding: 2%;" placeholder="ID Member" class="form-control" type="text" name="id_member" size="9"></td></tr>
				<tr><td><input class="form-control" style="width:100%; margin-left: 0.5em; margin-bottom: 0.5em; margin-top: 1em; padding: 2%;" placeholder="Password" type="password" name="password_member" size="9"></td></tr>
				<tr><td align="center"><input type="submit"  name="btn_submit" class="btn btn-success" value="Masuk"> atau <a href="daftar_member.php">Daftar</a></td></tr>
			</table>
		</form>
	<?php
	}
	
	function menu_member(){
	?>
	<div id="left">
 		<table border=0 width="100%" bgcolor="white">
			<tr><td align="center" bgcolor="#CCCCCC"><b>MENU MEMBER</b></td></tr>
			<tr><td><hr></td></tr>
			<tr><td align="center"><a href="pesan_produk.php"><b>PESAN PRODUK</b></a></td></tr>
			<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>
			<tr><td align="center"><a href="checkout_pesanan.php"><b>Checkout Pesanan</b></a></td></tr>
			<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>
			<tr><td><hr></td></tr>
			<tr><td align="center"><a href="logout.php">LOGOUT</a></td></tr>
			<tr><td align="center" bgcolor="#FFCC00" height=3></td></tr>
		</table>
	</div>
	<?php
	}
	
	function menu(){
		if(isset($_SESSION['membersudahlogin'])){
			menu_member();
		} else { 
			form_login();
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
