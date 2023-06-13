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

$email = $_SESSION['email'];


$keranjang = mysqli_query($conn, "SELECT * FROM keranjang WHERE email = '$email'");
$total_keranjang = mysqli_num_rows($keranjang);


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
    <title>Ilham Motor</title>
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
        .card-p {
            width: 300px;
        }
    </style>
</head>

<body>
    <header>
        <?php include 'nav.php'; ?>
        <?php include 'jumbotron.php'; ?>
    </header>

    <main>

            <div style="display: flex;justify-content: flex-start;overflow-wrap: break-word; flex-wrap: wrap; width: 100%;">
            <?php foreach ($keranjang as $p) : ?>
                <div class="card card-p">
                    <h4><?= $p["nama"]; ?></h4>
                    <p style="position: relative;bottom: 5px;color:green;font-weight: bold;">Rp<?= number_format($p['harga'],0,',','.'); ?></p>
                    <p>
                        <a href="produk.php?id=<?= $p['id_produk']; ?>" class="btn">Checkout</a> 
                        <a href="hapus-keranjang.php?id=<?= $p['id']; ?>">Hapus</a>
                    </p>
                    
               </div>
            <?php endforeach; ?>

            

            </div>
    </main>
    
    <div style="margin-top: 200px;"></div>

    <?php include 'footer.php'; ?>


</body>
</html>