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
  
  if (tambah_kota($_POST) > 0 ) {
     echo "<script>
        alert('Produk Berhasil Ditambahkan!');
        window.location.href='data_kota.php';
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
            <h2 class="judul">Tambah Kota Ongkos Kirim</h2>
            <center><a href="index.php">Kembali</a></center>
            <article class="card">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="jarak">
                         <label for="nama">Nama Kota</label>
                         <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Kota" required>
                    </div>
                    <div class="jarak">
                         <label for="ongkos">Ongkos Kirim</label>
                         <input type="number" id="ongkos" name="ongkos" placeholder="Masukkan Ongkos Kirim" required>
                    </div>
                    <button type="submit" name="register" class="btn" style="width: 100%;padding:10px;background-color: royalblue;">Tambah</button>
                </form>
            </article>
        </div>
    </main>


    <?php include '../footer.php'; ?>

</body>
