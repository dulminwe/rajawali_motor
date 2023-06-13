<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "ilham_motor");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	};
	return $rows;
};

function registrasi($data) {
	global $conn;

	$email = mysqli_real_escape_string($conn, $data["email"]);
	$password_sebelum = mysqli_real_escape_string($conn, $data["password"]);
	$nama = mysqli_real_escape_string($conn, $data["nama"]);

	// cek email seller sudah ada atau belum

	$cekemailseller = "SELECT * FROM seller where email='$email'";
	$prosescek= mysqli_query($conn, $cekemailseller);

	if (mysqli_num_rows($prosescek)>0) { 
	    echo "<script>alert('email Sudah Digunakan!');history.go(-1) </script>";
	    exit;
	}

	// cek email user sudah ada atau belum

	$cekemailuser = "SELECT * FROM user where email='$email'";
	$prosescek= mysqli_query($conn, $cekemailuser);

	if (mysqli_num_rows($prosescek)>0) { 
	    echo "<script>alert('email Sudah Digunakan!');history.go(-1) </script>";
	    exit;
	}

	// enkripsi password
	$password = password_hash($password_sebelum, PASSWORD_DEFAULT);

		// Masukkan Data ke Database
	mysqli_query($conn, "INSERT INTO user VALUES('', '$email', '$password', '$nama')");
	return mysqli_affected_rows($conn);

}


function pesanan($data) {
	global $conn;

	$email = mysqli_real_escape_string($conn, $data["email"]);
	$produk = mysqli_real_escape_string($conn, $data["produk"]);
	$nama_penerima = mysqli_real_escape_string($conn, $data["nama_penerima"]);
	$alamat_penerima = mysqli_real_escape_string($conn, $data["alamat_penerima"]);
	$nohp_penerima = mysqli_real_escape_string($conn, $data["nohp_penerima"]);
	$tanggal = $data["tanggal"];
	$status = mysqli_real_escape_string($conn, $data["status"]);
	$harga = mysqli_real_escape_string($conn, $data["harga"]);
	$kota = mysqli_real_escape_string($conn, $data["kota"]);

	$gambar = upload();

	$total_bayar = $harga + $kota;
	// Masukkan Data ke Database
	mysqli_query($conn, "INSERT INTO pesanan VALUES('', '$email',  '$produk', '$nama_penerima', '$alamat_penerima', '$nohp_penerima', '$tanggal', '$total_bayar', '$gambar', '$status')");
	return mysqli_affected_rows($conn);
}

function tambah($data) {
	global $conn;

	// htmlspecialchars berfungsi untuk tidak menjalankan script
	$id_produk = htmlspecialchars($data["id_produk"]);
	$email = htmlspecialchars($data["email"]);
	$nama = htmlspecialchars($data["nama"]);
	$harga = htmlspecialchars($data["harga"]);


		// tambahkan ke database
		// NULL digunakan karena jika dikosongkan maka akan terjadi error di database yang sudah online
		// sedangkan jika masih di localhost, bisa memakai ''
	mysqli_query($conn, "INSERT INTO keranjang VALUES(NULL, '$id_produk', '$email', '$nama', '$harga')");
	return mysqli_affected_rows($conn);
}

function upload() {
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];


    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'images/' . $namaFileBaru);

    return $namaFileBaru;
}