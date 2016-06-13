<?php
	include("../library/lib_func.php");
	$id_merk = $_REQUEST['id_merk'];
	$link=koneksi_db();
	$update="UPDATE merk SET  
            dihapus = 'Y'
            WHERE id_merk='$id_merk'";
	$sql = mysql_query($update,$link);
?>
<script>document.location='merk_add_view.php'</script>
