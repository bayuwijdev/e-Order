<?php
	include("../library/lib_func.php");
	$username = $_REQUEST['username'];
	$link=koneksi_db();
	$query = "delete from admin where username ='$username'";
	$sql = mysql_query($query,$link);
?>
<script>document.location='admin_add_view.php'</script>
