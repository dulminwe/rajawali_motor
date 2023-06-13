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

function tambah($data) {
	global $conn;

	// htmlspecialchars berfungsi untuk tidak menjalankan script
	$tgl_produksi = htmlspecialchars($data["tgl_produksi"]);
	$nama = htmlspecialchars($data["nama"]);
	$kode = htmlspecialchars($data["kode"]);
	$email_seller = htmlspecialchars($data["email_seller"]);
	$deskripsi = htmlspecialchars($data["deskripsi"]);
	$harga = htmlspecialchars($data["harga"]);
	$harga_promo = htmlspecialchars($data["harga_promo"]);
	$stok = htmlspecialchars($data["stok"]);
	$status = htmlspecialchars($data["status"]);
	$kategori = htmlspecialchars($data["kategori"]);

	$gambar = upload();


		// tambahkan ke database
		// NULL digunakan karena jika dikosongkan maka akan terjadi error di database yang sudah online
		// sedangkan jika masih di localhost, bisa memakai ''
	mysqli_query($conn, "INSERT INTO produk VALUES(NULL, '$kode', '$email_seller', '$gambar', '$tgl_produksi', '$nama', '$deskripsi', '$harga', '$harga_promo', '$status', '$kategori')");
	mysqli_query($conn, "INSERT INTO gudang VALUES(NULL, '$kode', '$stok')");
	return mysqli_affected_rows($conn);
}


function tambah_kota($data) {
	global $conn;

	// htmlspecialchars berfungsi untuk tidak menjalankan script
	$nama = htmlspecialchars($data["nama"]);
	$ongkos = htmlspecialchars($data["ongkos"]);
	

		// tambahkan ke database
		// NULL digunakan karena jika dikosongkan maka akan terjadi error di database yang sudah online
		// sedangkan jika masih di localhost, bisa memakai ''
	mysqli_query($conn, "INSERT INTO kota VALUES(NULL, '$nama', '$ongkos')");
	return mysqli_affected_rows($conn);
}


function hapusitem($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM produk WHERE id = $id");

	return mysqli_affected_rows($conn);
}

function hapuspesanan($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM pesanan WHERE id = $id");

	return mysqli_affected_rows($conn);
}

function ubah($data) {
	global $conn;
     
    $id = $data["id"];
    $kode = $data["kode"];
    $gambar = $data["gambar"];
    $tgl_produksi = $data["tgl_produksi"];
    $nama = $data["nama"];
	$deskripsi = $data["deskripsi"];
	$harga = $data["harga"];
	$harga_promo = $data["harga_promo"];
	$status = $data["status"];

	$query = "UPDATE produk SET 
				kode = '$kode',
				gambar = '$gambar',
				tgl_produksi = '$tgl_produksi',
				nama = '$nama',
				deskripsi = '$deskripsi',
				harga = '$harga',
				harga_promo = '$harga_promo',
				status = '$status'
			  WHERE id = $id
			";
			
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubahstok($data) {
	global $conn;
     
    $id = $data["id"];
    $kode = $data["kode"];
	$stok = $data["stok"];

	$query = "UPDATE gudang SET 
				kode = '$kode',
				stok = '$stok'
			  WHERE id = $id
			";
			
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubahdata($data) {
    global $conn;
     
    $id = $data["id"];
    $status_pesanan =  $data["status_pesanan"];

    $query = "UPDATE pesanan SET 
                status_pesanan = '$status_pesanan'
              WHERE id = $id
            ";
            
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubah_kota($data) {
    global $conn;
     
    $id = $data["id"];
    $nama =  $data["nama"];
    $ongkos =  $data["ongkos"];

    $query = "UPDATE kota SET 
                nama = '$nama',
                ongkos = '$ongkos'
              WHERE id = $id
            ";
            
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubah_user($data) {
    global $conn;
     
    $id = $data["id"];
    $email =  $data["email"];
    $nama =  $data["nama"];

    $query = "UPDATE user SET 
                email = '$email',
                nama = '$nama'
              WHERE id = $id
            ";
            
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubahgambar($data) {
	global $conn;
     
    $id = $data["id"];

	$gambar = upload();


	$query = "UPDATE produk SET 
				gambar = '$gambar'
			  WHERE id = $id
			";
			
	mysqli_query($conn, $query);

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
    move_uploaded_file($tmpName, '../images/' . $namaFileBaru);

    return $namaFileBaru;
}