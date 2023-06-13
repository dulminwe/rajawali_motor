<?php 
session_start();

if (!isset($_SESSION['admin'])) {
   echo "<script>
         window.location.replace('../login.php');
       </script>";
  exit;
}

require 'functions.php';
  $user = mysqli_query($conn, "SELECT * FROM user");
  
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
                <center><h3 style="color:royalblue;">Data User</h3></center>
        </article>

        <div id="content">
            <?php foreach ($user as $p) : ?>
            <div class="flex">
                <div class="card">
                    <p><?= $p["email"]; ?></p>
                    <p><?= $p["nama"]; ?></p>
                    <p> <a href="edit-user.php?id=<?= $p["id"]; ?>" class="btn" style="background-color: orange;">Edit</a>
                    <a href="hapus-user.php?id=<?= $p["id"]; ?>" class="btn">Hapus</a></p>
               </div>
            </div>
            <?php endforeach; ?>
        </div>

        <aside>

            <a href="tambah.php" style="text-decoration: none;"><div class="card">
                <center><p>Tambah Produk</p></center>
            </div></a>

            <a href="data_kota.php" style="text-decoration: none;"><div class="card">
                <center><p>Data Ongkos</p></center>
            </div></a>

            <a href="tambah_user.php" style="text-decoration: none;">
                <div class="card">
                    <center>Tambah User</center>
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