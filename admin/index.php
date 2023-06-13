<?php 
session_start();

if (!isset($_SESSION['admin'])) {
   echo "<script>
         window.location.replace('../login.php');
       </script>";
  exit;
}

require 'functions.php';
$email = $_SESSION['email'];
  $produk = mysqli_query($conn, "SELECT * FROM produk LEFT JOIN gudang ON produk.id = gudang.id WHERE email_seller = '$email'");
  $total_produk = mysqli_num_rows($produk);
  
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
    </style>
</head>

<body>
     <header>
        <nav>
            <ul>
                <li><a href="pesanan.php">Data Pesanan</a></li>
                <li><a href="../logout.php" class="btn" style="border-bottom: none;">Logout</a></li>
            </ul>
        </nav>
        <?php include '../jumbotron.php'; ?>
    </header>

    <main>
         <article class="card">
                <center><h3 style="color:royalblue;">Katalog Produk</h3></center>
        </article>

        <div id="content">
            <?php foreach ($produk as $p) : ?>
            <div class="flex">
                <div class="card">
                    <img src="../images/<?= $p["gambar"]; ?>" class="featured-image">
                    <h4><?= $p["nama"]; ?></h4>
                    <p><?= $p["deskripsi"]; ?></p>
                    <p>Kategori : <b><?= $p["kategori"]; ?></b></p>
                    <p style="font-size: 0.8rem;text-decoration: line-through;">Harga : <b>Rp<?= number_format($p['harga'],2,',','.'); ?></b></p>
                    <p>Harga Promo : <b>Rp<?= number_format($p['harga_promo'],2,',','.'); ?></b></p>
                    <p>Stock : <b><?= $p["stok"]; ?></b></p>
                    <p>Tanggal Produksi : <b><?= $p["tgl_produksi"]; ?></b></p>
                    <p style="color: green;"><b><?= $p["status"]; ?></b></p>
                    <p> <a href="edit-item.php?id=<?= $p["id"]; ?>" class="btn" style="background-color: orange;">Edit</a>
                    <a href="edit-stok.php?id=<?= $p["id"]; ?>" class="btn" style="background-color: orange;">Edit Stock</a>
                    <a href="hapus-item.php?id=<?= $p["id"]; ?>" class="btn">Hapus</a></p>
               </div>
            </div>
            <?php endforeach; ?>
        </div>

        <aside>
            <div class="card">
                <center><p>Total Produk : <b><span style="color: #FF5585"><?= $total_produk; ?></span></b></p></center>
            </div>

            <a href="tambah.php" style="text-decoration: none;"><div class="card">
                <center><p>Tambah Produk</p></center>
            </div></a>

            <a href="data_kota.php" style="text-decoration: none;"><div class="card">
                <center><p>Data Ongkos</p></center>
            </div></a>

            <a href="user.php" style="text-decoration: none;">
                <div class="card">
                    <center>Data User</center>
                </div>
            </a>

            <a href="pesanan.php" style="text-decoration: none;">
                <div class="card">
                    <center>Data Pesanan Pelanggan</center>
                </div>
            </a>
        </aside>
           
    </main>

   <?php include '../footer.php'; ?>

</body>
</html>