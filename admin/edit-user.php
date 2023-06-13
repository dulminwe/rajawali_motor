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
$user = query("SELECT * FROM user WHERE id = $id")[0];

if (isset($_POST["submit"])) {

  if (ubah_user($_POST) > 0 ) {
    echo "
      <script>
        alert('Data Berhasil Diubah!');
        window.location.href='user.php';
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
            <h2 class="judul">Edit User</h2>
            <article class="card">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?= $user["id"]; ?>">
                     <div class="jarak">
                         <label for="email">Alamat Email User</label>
                         <input type="text" id="email" name="email" placeholder="Masukkan Alamat Email User" value="<?= $user["email"]; ?>" required>
                    </div>
                    <div class="jarak">
                         <label for="nama">Nama Lengkap</label>
                         <input type="text" id="nama" name="nama" value="<?= $user["nama"]; ?>" required></input>
                    </div>
                    <button type="submit" name="submit" class="btn" style="width: 100%;padding:10px;background-color: royalblue;">Ubah Data</button>
                </form>
            </article>
        </div>
    </main>
    

   <?php include '../footer.php'; ?>

</body>
</html>