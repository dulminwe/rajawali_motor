<?php 
require 'functions.php';

function hapus_user($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM user WHERE id = $id");

	return mysqli_affected_rows($conn);
}


$id = $_GET["id"];
if (hapus_user($id) > 0 ) {
	echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href = 'user.php';
		</script>
	";
    } else {
	echo "
		<script>
			alert('Data gagal dihapus!');
			document.location.href = 'user.php';
		</script>
	";
	}
 ?>