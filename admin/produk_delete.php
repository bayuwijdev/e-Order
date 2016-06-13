<?php
	include("../library/lib_func.php");
	$id_produk = $_REQUEST['id_produk'];
	$link=koneksi_db();
	$update="UPDATE produk SET  
            dihapus = 'Y'
            WHERE id_produk='$id_produk'";
	$sql = mysql_query($update,$link);
?>
<script>document.location='produk_add_view.php'</script>
