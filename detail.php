<?php 
session_start();

if (isset($_SESSION["admin"])) {
  echo "<script>
         window.location.replace('admin');
       </script>";
  exit;
}
if (!isset($_SESSION['user'])) {
   echo "<script>
         window.location.replace('login.php');
       </script>";
  exit;
}
require 'functions.php';

$id = $_GET['id'];

$produk = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$id'");
$total_produk = mysqli_num_rows($produk);

if (isset($_POST["add"])) {
  
  if (tambah($_POST) > 0 ) {
     echo "<script>
        alert('Berhasil Ditambahkan Ke Keranjang!');
        window.location.href='keranjang.php';
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
    <link rel="stylesheet" href="css/style.css">
    <!-- Icon dari Fontawesome -->
    <script src="https://kit.fontawesome.com/348c676099.js" crossorigin="anonymous"></script>
    <title>Rajawali Motor</title>
    <style>
        /*Membuat Tulisan Berkedip*/
        blink {
          -webkit-animation: 2s linear infinite condemned_blink_effect;
          animation: 1s linear infinite condemned_blink_effect;
        }
        @keyframes condemned_blink_effect {
          0% {
            visibility: hidden;
          }
          50% {
            visibility: hidden;
          }
          100% {
            visibility: visible;
          }
        }
        .btn {
            text-decoration: none;
            padding: 5px 10px;
        } 
        .p {
            width: 170px;
        }
    </style>
</head>

<body>
    <header>
        <?php include 'nav.php'; ?>
        <?php include 'jumbotron.php'; ?>
    </header>

    <main>
        <article class="card">
            <h3>Detail Buku</h3>
        </article>

            <div style="display: flex;justify-content: flex-start;flex-wrap: wrap; width: 100%;">
            <?php foreach ($produk as $p) : ?>
                <div class="card p">
                    
                    <img src="images/<?= $p["gambar"]; ?>" class="featured-image">
                    <h4><?= $p["nama"]; ?></h4>
                    <p>Nama Seller : <?= $p['username_seller']; ?></p>
                    <p>Tanggal Produksi = <?= $p['tgl_produksi']; ?></p>
                    <p>Deskripsi : <?= $p['deskripsi']; ?></p>
                    <p style="position: relative;bottom: 5px;color:green;font-weight: bold;">Rp<?= number_format($p['harga'],0,',','.'); ?></p>
                    <p>

                        <form action="" method="post" enctype="multipart/form-data">
                            <?php $username = $_SESSION['username']; ?>
                            <input type="hidden" name="username" id="username" value="<?= $username; ?>">
                            <input type="hidden" name="id_produk" id="id_produk" value="<?= $p['id']; ?>">
                            <input type="hidden" name="nama" id="nama" value="<?= $p['nama']; ?>">
                            <input type="hidden" name="harga" id="harga" value="<?= $p['harga']; ?>">
                            <button type="submit" name="add" class="btn btn-beli" style="width:100%;">Tambah Ke Keranjang</button>
                            <br>
                            <br>

                        </form>
                        <button onclick="window.location.href='index.php'" class="btn btn-beli" style="width:100%;">Ke Beranda</button>
                    </p>
                    
               </div>
            <?php endforeach; ?>

            

            </div>
    </main>
    

    <?php include 'footer.php'; ?>


</body>
</html>