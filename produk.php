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

$id = $_GET["id"];
$produk = query("SELECT * FROM produk WHERE id = $id")[0];

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}


$time_sekarang = time();
$tanggal = date("d F Y", strtotime("+4 days", $time_sekarang));

if (isset($_POST["pesan"])) {
  if (pesanan($_POST) > 0 ) {
    echo "<script>
        alert('Produk Berhasil di Pesan!');
        window.location.href='pesanan.php';
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
        .btn {
            text-decoration: none;
            padding: 10px;
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
        #content {
            width: 55%;
        }
        aside {
            width: 45%;
        }
        .alert {
            margin: 10px 0;
            font-size: 0.9rem;
            background-color: #FCC663;
            padding: 10px;
            border: 1px solid darkorange;
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

        <div id="content">
                <div class="card">
                    <center>
                    <img src="images/<?= $produk["gambar"]; ?>" class="featured-image">
                    <h4><?= $produk["nama"]; ?></h4>
                    <p><?= $produk["deskripsi"]; ?></p>
                    <p>Harga : <span style="text-decoration: line-through;font-size: 0.8rem">Rp<?= number_format($produk['harga'],2,',','.'); ?></p></span>
                    <p>Harga Promo : Rp<?= number_format($produk['harga_promo'],2,',','.'); ?></p>
                    <p>Diproduksi : <?= $produk["tgl_produksi"]; ?></p>
                    <p style="color: green"><?= $produk["status"]; ?></p>
                    </center>
               </div>

               <div class="card">
                   <h3>Informasi Nomor Rekening</h3>
                   <hr>
                   <div style="display:flex;justify-content: space-between;">
                       <div>
                           <span style="color:orange;"><b>BNI</b></span>
                       </div>
                       <div>
                           <b>03199123872</b>
                       </div>
                   </div>
                   <hr>
                   <div style="display:flex;justify-content: space-between;">
                       <div>
                           <span style="color:royalblue;"><b>BRI</b></span>
                       </div>
                       <div>
                           <b>101872213</b>
                       </div>
                   </div>
                   <hr>
                   <div style="display:flex;justify-content: space-between;">
                       <div>
                           <span style="color:blue;"><b>BCA</b></span>
                       </div>
                       <div>
                           <b>0719878123</b>
                       </div>
                   </div>
                   <hr>
                   <div style="display:flex;justify-content: space-between;">
                       <div>
                           <span style="color:#9BE0E9;"><b>Mandiri</b></span>
                       </div>
                       <div>
                           <b>011991272</b>
                       </div>
                   </div>
               </div>
        </div>

        <aside>
            <div class="card">
                <form action="" method="post" enctype="multipart/form-data">
                 <input type="hidden" id="email" name="email" value="<?= $email; ?>" required>
                 <input type="hidden" id="produk" name="produk" value="<?= $produk["nama"]; ?>" required>
                 <input type="hidden" id="tanggal" name="tanggal" value="<?= $tanggal; ?>" required>
                 <input type="hidden" id="status" name="status" value="Sedang Diproses" required>
                 
                    <center><h4>Format Pemesanan</h4></center>
                    <div class="alert">Pastikan semua data yang anda isi sudah benar, sebelum klik tombol pesan.</div>
                     <div class="alert" style="padding: 1px 10px;"><p style="color: white;">Pengiriman memerlukan waktu 4 hari kalender paling lama <i class="fas fa-exclamation-circle"></i></p></div>
                    <br>
                    <div class="jarak">
                         <label for="nama_penerima">Nama Penerima</label>
                         <input type="text" id="nama_penerima" name="nama_penerima" placeholder="Masukkan Nama Penerima" required>
                    </div>
                    <div class="jarak">
                         <label for="alamat_penerima">Alamat Penerima</label>
                         <input type="text" id="alamat_penerima" name="alamat_penerima" placeholder="Masukkan Alamat Penerima" required>
                    </div>
                    <div class="jarak">
                         <label for="nohp_penerima">Nomor Handphone Penerima</label>
                         <input type="number" id="nohp_penerima" name="nohp_penerima" placeholder="Masukkan Nomor Handphone Penerima" required>
                    </div>
                    <div class="jarak">
                         <label for="gambar">Bukti Transfer</label>
                         <input type="file" id="gambar" name="gambar" required>
                    </div>
                    <div class="jarak">
                         <label for="tanggal">Estimasi Produk Sampai Tujuan</label>
                         <p><span class="harga" style="background-color: #FBD388;color: #D37401;"><?= $tanggal; ?></span></p>
                    </div>
                    <div class="jarak">
                         <label for="ongkir">Kota</label>
                         <select name="kota" id="kota">
                            <?php $kota = mysqli_query($conn, "SELECT * FROM kota"); ?>
                            <?php foreach ($kota as $d) : ?>
                             <option value="<?= $d['ongkos']; ?>"><?= $d['nama']; ?></option>
                            <?php endforeach; ?>
                         </select>
                    </div>
                    <input type="hidden" id="harga" name="harga" value="<?= $produk['harga_promo']; ?>" required>
                    <button type="submit" name="pesan" class="btn" style="width: 100%;background-color: green;">Pesan Sekarang</button>
                </form>
            </div>
            <a href="katalog.php">
            <div class="card">
                <center><p>Kembali ke Katalog</p></center>
            </div>
            </a>
        </aside>
           
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>