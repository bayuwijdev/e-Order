<?php
	include("library/lib_func_member.php");
	$id_pesanan = $_REQUEST['id_pesanan'];
	$link=koneksi_db();
	$update="UPDATE pesanan SET  
            dicheckout = 'Y'
            WHERE id_pesanan='$id_pesanan'";

	$sql = mysql_query($update,$link);
?>
<script>document.location='checkout_pesanan.php'</script>
