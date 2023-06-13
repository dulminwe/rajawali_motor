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

    if (isset($_SESSION['email'])) {
     $email = $_SESSION['email'];

     $pesanan = mysqli_query($conn, "SELECT * FROM pesanan WHERE email = '$email'"); 

  }

$total_pesanan = mysqli_num_rows($pesanan);

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
        .btn {
            text-decoration: none;
            padding: 5px 10px;
            background-color: red;
        }
        .flex {
            display: flex;
            flex-direction: column;
        }
        .btn-beli {
            text-decoration: none;
            padding: 5px 10px;
            background-color: green;
        }
        .harga {
            padding: 5px;
            border-radius: 5px;
            color: green;
            background-color: #90DE90;
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
                <center><h3 style="color:royalblue;">Pesanan Saya</h3></center>
        </article>

        <div id="content">
            <?php foreach ($pesanan as $cf) : ?>
            <div class="flex">
                <div class="card">
                      <h2>Nomor Pesanan : <?= $cf['id']; ?></h2>
                      <hr>
                      <div style="display:flex;justify-content: space-between;">
                          <div>
                              <p>Customer Detail</p>
                              <hr>
                          </div>
                          <div>
                              <p>Item Detail</p>
                              <hr>
                          </div>
                      </div>

                      <div style="display:flex;justify-content: space-between;">
                          <div>
                              <p>Nama Penerima <br> <b><?= $cf["nama_penerima"]; ?></b></p>
                          </div>
                          <div style="text-align:right;">
                              <p>Nama Produk <br> <b><?= $cf["produk"]; ?></b></p>
                          </div>
                      </div>

                      <div style="display:flex;justify-content: space-between;">
                          <div>
                              <p>Alamat Penerima <br> <b><?= $cf["alamat_penerima"]; ?></b></p>
                          </div>
                          <div style="text-align:right;">
                              <p>Estimasi Tiba <br> <b><?= $cf["tanggal"]; ?></b></p>
                          </div>
                      </div>

                      <div style="display:flex;justify-content: space-between;">
                          <div>
                              <p>Nomor Handphone Penerima <br> <b><?= $cf["nohp_penerima"]; ?></b></p>
                          </div>
                          <div style="text-align:right;">
                              <p>Total Pembayaran <br> <b>Rp<?= number_format($cf['total_bayar'],2,',','.'); ?></b></p>
                          </div>
                      </div>

                      <div style="display:flex;justify-content: space-between;">
                          <div>
                             
                          </div>
                          <div style="text-align:right;">
                              <p>Status Pesanan <br> <b><?= $cf['status_pesanan']; ?></b></p>
                          </div>
                      </div>
               </div>
            </div>
            <?php endforeach; ?>
        </div>

        <aside>
            <div class="card">
                <center><p>Total Pesanan Saya : <b><span style="color: #royalblue;"><?= $total_pesanan; ?></span></b></p></center>
            </div>
        </aside>
           
    </main>

    <?php include 'footer.php'; ?> 
     
</body>
</html>