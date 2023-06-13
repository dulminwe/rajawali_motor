<?php 
session_start();

require 'functions.php';

$oli = mysqli_query($conn, "SELECT * FROM produk WHERE kategori = 'OLI'");
$aki = mysqli_query($conn, "SELECT * FROM produk WHERE kategori = 'AKI'");
$ban = mysqli_query($conn, "SELECT * FROM produk WHERE kategori = 'BAN'");
$framepart = mysqli_query($conn, "SELECT * FROM produk WHERE kategori = 'FRAMEPART'");
$aksesoris = mysqli_query($conn, "SELECT * FROM produk WHERE kategori = 'AKSESORIS'");

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
            <marquee><h3 style="color:royalblue;">Selamat Datang di Official Website Rajawali Motor</h3></marquee>
        </article>

        <hr>
        <h3 align="center">OLI</h3>
        <hr>

            <div style="display: flex;justify-content: flex-start;flex-wrap: wrap; width: 100%;">
            <?php foreach ($oli as $p) : ?>
                <div class="card p">
                    
                    <img src="images/<?= $p["gambar"]; ?>" class="featured-image">
                    <h4><?= $p["nama"]; ?></h4>
                    <p style="position: relative;bottom: 5px;font-size: 0.8rem; text-decoration: line-through; font-weight: bold;">Rp<?= number_format($p['harga'],0,',','.'); ?>
                    </p>
                    <p style="position: relative;bottom: 5px;color:green;font-weight: bold;">Rp<?= number_format($p['harga_promo'],0,',','.'); ?>
                    </p>

                    <p>

                        <?php if (isset($_SESSION['email'])) : ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <?php $email = $_SESSION['email']; ?>
                            <input type="hidden" name="email" id="email" value="<?= $email; ?>">
                            <input type="hidden" name="id_produk" id="id_produk" value="<?= $p['id']; ?>">
                            <input type="hidden" name="nama" id="nama" value="<?= $p['nama']; ?>">
                            <input type="hidden" name="harga" id="harga" value="<?= $p['harga_promo']; ?>">
                            <button type="submit" name="add" class="btn btn-beli" style="width:100%;"><small>Tambah Ke Keranjang</small></button>
                            <br><br>
                            <a href="detail.php?id=<?= $p['id']; ?>" style="width:100%;" class='btn'><small>Detail</small></a>
                        </form>

                    <?php endif; ?>
                    </p>
                    
               </div>
            <?php endforeach; ?>
            </div>

              <hr>
        <h3 align="center">AKI</h3>
        <hr>

            <div style="display: flex;justify-content: flex-start;flex-wrap: wrap; width: 100%;">
            <?php foreach ($aki as $a) : ?>
                <div class="card p">
                    
                    <img src="images/<?= $a["gambar"]; ?>" class="featured-image">
                    <h4><?= $a["nama"]; ?></h4>
                    <p style="position: relative;bottom: 5px;color:green;font-weight: bold;">Rp<?= number_format($p['harga'],0,',','.'); ?></p>
                    <p>

                        <?php if (isset($_SESSION['email'])) : ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <?php $email = $_SESSION['email']; ?>
                            <input type="hidden" name="email" id="email" value="<?= $email; ?>">
                            <input type="hidden" name="id_produk" id="id_produk" value="<?= $a['id']; ?>">
                            <input type="hidden" name="nama" id="nama" value="<?= $a['nama']; ?>">
                            <input type="hidden" name="harga" id="harga" value="<?= $a['harga_promo']; ?>">
                            <button type="submit" name="add" class="btn btn-beli" style="width:100%;"><small>Tambah Ke Keranjang</small></button>
                            <br><br>
                            <a href="detail.php?id=<?= $a['id']; ?>" style="width:100%;" class='btn'><small>Detail</small></a>
                        </form>

                    <?php endif; ?>
                    </p>
                    
               </div>
            <?php endforeach; ?>
            </div>

            <hr>
        <h3 align="center">BAN</h3>
        <hr>

            <div style="display: flex;justify-content: flex-start;flex-wrap: wrap; width: 100%;">
            <?php foreach ($ban as $b) : ?>
                <div class="card p">
                    
                    <img src="images/<?= $b["gambar"]; ?>" class="featured-image">
                    <h4><?= $b["nama"]; ?></h4>
                    <p style="position: relative;bottom: 5px;color:green;font-weight: bold;">Rp<?= number_format($p['harga'],0,',','.'); ?></p>
                    <p>

                        <?php if (isset($_SESSION['email'])) : ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <?php $email = $_SESSION['email']; ?>
                            <input type="hidden" name="email" id="email" value="<?= $email; ?>">
                            <input type="hidden" name="id_produk" id="id_produk" value="<?= $b['id']; ?>">
                            <input type="hidden" name="nama" id="nama" value="<?= $b['nama']; ?>">
                            <input type="hidden" name="harga" id="harga" value="<?= $b['harga_promo']; ?>">
                            <button type="submit" name="add" class="btn btn-beli" style="width:100%;"><small>Tambah Ke Keranjang</small></button>
                            <br><br>
                            <a href="detail.php?id=<?= $b['id']; ?>" style="width:100%;" class='btn'><small>Detail</small></a>
                        </form>

                    <?php endif; ?>
                    </p>
                    
               </div>
            <?php endforeach; ?>
            </div>

            <hr>
        <h3 align="center">FRAMEPART</h3>
        <hr>

            <div style="display: flex;justify-content: flex-start;flex-wrap: wrap; width: 100%;">
            <?php foreach ($framepart as $f) : ?>
                <div class="card p">
                    
                    <img src="images/<?= $f["gambar"]; ?>" class="featured-image">
                    <h4><?= $f["nama"]; ?></h4>
                    <p style="position: relative;bottom: 5px;color:green;font-weight: bold;">Rp<?= number_format($p['harga'],0,',','.'); ?></p>
                    <p>

                        <?php if (isset($_SESSION['email'])) : ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <?php $email = $_SESSION['email']; ?>
                            <input type="hidden" name="email" id="email" value="<?= $email; ?>">
                            <input type="hidden" name="id_produk" id="id_produk" value="<?= $f['id']; ?>">
                            <input type="hidden" name="nama" id="nama" value="<?= $f['nama']; ?>">
                            <input type="hidden" name="harga" id="harga" value="<?= $f['harga_promo']; ?>">
                            <button type="submit" name="add" class="btn btn-beli" style="width:100%;"><small>Tambah Ke Keranjang</small></button>
                            <br><br>
                            <a href="detail.php?id=<?= $f['id']; ?>" style="width:100%;" class='btn'><small>Detail</small></a>
                        </form>

                    <?php endif; ?>
                    </p>
                    
               </div>
            <?php endforeach; ?>
            </div>

            <hr>
        <h3 align="center">AKSESORIS</h3>
        <hr>

            <div style="display: flex;justify-content: flex-start;flex-wrap: wrap; width: 100%;">
            <?php foreach ($aksesoris as $aks) : ?>
                <div class="card p">
                    
                    <img src="images/<?= $aks["gambar"]; ?>" class="featured-image">
                    <h4><?= $aks["nama"]; ?></h4>
                    <p style="position: relative;bottom: 5px;color:green;font-weight: bold;">Rp<?= number_format($p['harga'],0,',','.'); ?></p>
                    <p>

                        <?php if (isset($_SESSION['email'])) : ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <?php $email = $_SESSION['email']; ?>
                            <input type="hidden" name="email" id="email" value="<?= $email; ?>">
                            <input type="hidden" name="id_produk" id="id_produk" value="<?= $aks['id']; ?>">
                            <input type="hidden" name="nama" id="nama" value="<?= $aks['nama']; ?>">
                            <input type="hidden" name="harga" id="harga" value="<?= $aks['harga_promo']; ?>">
                            <button type="submit" name="add" class="btn btn-beli" style="width:100%;"><small>Tambah Ke Keranjang</small></button>
                            <br><br>
                            <a href="detail.php?id=<?= $aks['id']; ?>" style="width:100%;" class='btn'><small>Detail</small></a>
                        </form>

                    <?php endif; ?>
                    </p>
                    
               </div>
            <?php endforeach; ?>
            </div>


    </main>
    

    <?php include 'footer.php'; ?>


</body>
</html>