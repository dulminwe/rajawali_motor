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
             <center><h1>Contact Us</h1></center>
             <h1>Kelompok 2</h1>
             <br>
             <ul>
                 <li>ABDUL ROHMAN _______________ 19183207003</li>
                 <li>FERALDY SATRIA AFANDI _____ 20183207006</li>
                 <li>AFAN RISQI ARDIANSYAH _____ 20183207020</li>
             </ul>
        </article>

    </main>
    

    <?php include 'footer.php'; ?>


</body>
</html>