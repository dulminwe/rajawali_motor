<?php 
require 'functions.php';

function hapusitem($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM keranjang WHERE id = $id");

	return mysqli_affected_rows($conn);
}


$id = $_GET["id"];
if (hapusitem($id) > 0 ) {
	echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href = 'keranjang.php';
		</script>
	";
    } else {
	echo "
		<script>
			alert('Data gagal dihapus!');
			document.location.href = 'keranjang.php';
		</script>
	";
	}
 ?>