<?php 

session_start();

if (!isset($_SESSION['admin'])) {
   echo "<script>
         window.location.replace('../login.php');
       </script>";
  exit;
}
require 'functions.php';


if (isset($_POST["register"])) {
  
  if (tambah($_POST) > 0 ) {
     echo "<script>
        alert('Produk Berhasil Ditambahkan!');
        window.location.href='index.php';
      </script>";
  } else {
    echo mysqli_error($conn);
  }

} 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">

    <title>Ilham Motor</title>
    <style>
        .btn {
            text-decoration: none;
            padding: 3px 10px;
            background-color: darkred;
        }
        #content {
            width: 100%;
        }
    </style>
</head>

<body>
    <header>
        <?php include '../jumbotron.php'; ?>
    </header>

   <main>
        <div id="content">
            <h2 class="judul">Tambah Produk</h2>
            <center><a href="index.php">Kembali</a></center>
            <article class="card">
                <form action="" method="post" enctype="multipart/form-data">
                    <?php $email = $_SESSION['email']; ?>
                    <input type="hidden" id="email_seller" name="email_seller" value="<?= $email; ?>">
                    <div class="jarak">
                         <label for="gambar">Gambar Produk</label>
                         <input type="file" id="gambar" name="gambar" required>
                    </div>
                    <div class="jarak">
                         <label for="nama">Nama Produk</label>
                         <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Produk" required>
                    </div>
                    <div class="jarak">
                         <label for="kode">Kode Produk</label>
                         <input type="text" id="kode" name="kode" placeholder="Masukkan Kode Produk" required>
                    </div>
                    <div class="jarak">
                         <label for="tgl_produksi">Tanggal Produksi</label>
                         <input type="date" id="tgl_produksi" name="tgl_produksi" required>
                    </div>
                    <div class="jarak">
                         <label for="deskripsi">Deskripsi Produk</label>
                         <textarea id="deskripsi" name="deskripsi" required></textarea>
                    </div>
                    <div class="jarak">
                         <label for="harga">Harga Produk</label>
                         <input type="number" id="harga" name="harga" placeholder="Masukkan Harga Produk" required>
                    </div>
                    <div class="jarak">
                         <label for="stok">Stock Produk</label>
                         <input type="number" id="stok" name="stok" placeholder="Masukkan Stock Produk" required>
                    </div>
                    <div class="jarak">
                         <label for="status">Status</label>
                         <input type="radio" id="status" name="status" value="Siap Kirim" required>Siap Kirim
                         <input type="radio" id="status" name="status" value="Pre-Order" required>Pre-Order
                    </div>
                    <div class="jarak">
                        <select name="kategori" id="kategori" required>
                            <option value="" hidden>Pilih Kategori</option>
                            <option value="AKI">AKI</option>
                            <option value="OLI">OLI</option>
                            <option value="BAN">BAN</option>
                            <option value="FRAMEPART">FRAMEPART</option>
                            <option value="AKSESORIS">AKSESORIS</option>
                        </select>
                    </div>
                    <button type="submit" name="register" class="btn" style="width: 100%;padding:10px;background-color: royalblue;">Tambah</button>
                </form>
            </article>
        </div>
    </main>


    <?php include '../footer.php'; ?>

</body>
</html>