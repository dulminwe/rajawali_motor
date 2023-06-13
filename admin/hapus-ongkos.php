<?php 
require 'functions.php';

function hapus_ongkos($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM kota WHERE id = $id");

	return mysqli_affected_rows($conn);
}


$id = $_GET["id"];
if (hapus_ongkos($id) > 0 ) {
	echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href = 'data_kota.php';
		</script>
	";
    } else {
	echo "
		<script>
			alert('Data gagal dihapus!');
			document.location.href = 'data_kota.php';
		</script>
	";
	}
 ?>