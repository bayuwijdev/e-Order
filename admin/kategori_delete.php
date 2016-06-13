<?php
	include("../library/lib_func.php");
	$id_kategori = $_REQUEST['id_kategori'];
	$link=koneksi_db();
	$update="UPDATE kategori SET  
            dihapus = 'Y'
            WHERE id_kategori='$id_kategori'";
	$sql = mysql_query($update,$link);
?>
<script>document.location='kategori_add_view.php'</script>
