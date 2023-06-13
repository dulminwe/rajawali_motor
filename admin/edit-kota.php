<?php
session_start();

if (!isset($_SESSION['admin'])) {
   echo "<script>
         window.location.replace('../login.php');
       </script>";
  exit;
}
 
require 'functions.php';


$id = $_GET["id"];
$kota = query("SELECT * FROM kota WHERE id = $id")[0];

if (isset($_POST["submit"])) {

  if (ubah_kota($_POST) > 0 ) {
    echo "
      <script>
        alert('Data Berhasil Diubah!');
        window.location.href='index.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Data Gagal Diubah!');
        
      </script>
    ";
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
            <h2 class="judul">Edit Kota</h2>
            <article class="card">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?= $kota["id"]; ?>">
                     <div class="jarak">
                         <label for="nama">Nama Kota</label>
                         <input type="text" id="nama" name="nama" placeholder="Masukkan Nama kota" value="<?= $kota["nama"]; ?>" required>
                    </div>
                    <div class="jarak">
                         <label for="ongkos">Ongkos</label>
                         <input type="number" id="ongkos" name="ongkos" value="<?= $kota["ongkos"]; ?>" required></input>
                    </div>
                    <button type="submit" name="submit" class="btn" style="width: 100%;padding:10px;background-color: royalblue;">Ubah Data</button>
                </form>
            </article>
        </div>
    </main>
    

   <?php include '../footer.php'; ?>

</body>
</html>