<?php 
session_start();

if (!isset($_SESSION['admin'])) {
   echo "<script>
         window.location.replace('../login.php');
       </script>";
  exit;
}

require 'functions.php';
  $kota = mysqli_query($conn, "SELECT * FROM kota");
  
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
                <center><h3 style="color:royalblue;">Data Ongkos Kirim Per Kota</h3></center>
        </article>

        <div id="content">
            <?php foreach ($kota as $p) : ?>
            <div class="flex">
                <div class="card">
                    <h4><?= $p["nama"]; ?></h4>
                    <p>Ongkos : <b>Rp<?= number_format($p['ongkos'],2,',','.'); ?></b></p>
                    <p><a href="edit-kota.php?id=<?= $p["id"]; ?>" class="btn" style="background-color: orange;">Edit</a></p>
                    <p><a href="hapus-ongkos.php?id=<?= $p["id"]; ?>" class="btn">Hapus</a></p>
               </div>
            </div>
            <?php endforeach; ?>
        </div>

        <aside>

            <a href="tambah.php" style="text-decoration: none;"><div class="card">
                <center><p>Tambah Produk</p></center>
            </div></a>

            <a href="ongkos.php" style="text-decoration: none;"><div class="card">
                <center><p>Tambah Kota</p></center>
            </div></a>

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