<?php 
session_start();
require 'functions.php';


// cek session

if (isset($_SESSION["seller"])) {
    header("Location: admin");
    exit;
} if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}


 if (isset($_POST["login"])) {
  
  $email = $_POST["email"];
  $password = $_POST["password"];

  $seller = query("SELECT * FROM seller");
  foreach ($seller as $a) {}

  
  if ($email == $a["email"]) {
    $result = mysqli_query($conn, "SELECT * FROM seller WHERE email = '$email'");


  if (mysqli_num_rows($result) === 1 ) {
    

    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {

            // set session

            $_SESSION["login"] = true;
            $_SESSION["admin"] = true;
            $_SESSION["email"] = $email;

            // cek remember me
            if (isset($_POST['remember'])) {
                // buat cookie
                // $pws5d dan $ssl artinya adalah id dan email, disamarkan agar tidak mudah ditebak oleh penjahat
                setcookie('$ssl', hash('sha256', $row['email']), time()+3600);
            }

      header("Location: admin");
      exit;
    }

  } 

} else {
  $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");


  if (mysqli_num_rows($result) === 1 ) {
    

    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {


            $_SESSION["login"] = true;
            $_SESSION["user"] = true;
            $_SESSION["email"] = $email;

            // cek remember me
            if (isset($_POST['remember'])) {
                // buat cookie
                // $pws5d dan $ssl artinya adalah id dan email, disamarkan agar tidak mudah ditebak oleh penjahat
                setcookie('$pws5d', $row['id'], time()+3600);
                setcookie('$ssl', hash('sha256', $row['email']), time()+3600);
            }
      
      header("Location: index.php");
      exit;
    }
  }
}

$error = true;
  
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
        #content {
            width: 100%;
            padding: 0 350px;
        }
        @media screen and (max-width: 1000px) {
            #content {
                padding: 0 10px;
            }
        }
    </style>
</head>

<body>
    <header>
        <?php include 'jumbotron.php'; ?>
    </header>

    <main>
        <div id="content">
            <h2 class="judul black">Login</h2>
            <?php if (isset($error)) : ?>
            <center>
                <p style="color: #E30A0A;"><b>email / Password Salah!</b> <i class="fas fa-times-circle"></i></p>
            </center>
            <?php endif; ?>
            <article class="card">
                <form action="" method="post">
                    <div class="jarak">
                         <label for="email">Alamat Email</label>
                         <input type="text" id="email" name="email" placeholder="Masukkan Alamat Email" required>
                    </div>
                    <div class="jarak">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
                    </div>
                    <div class="jarak">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember Me</label>    
                    </div>
                    <button type="submit" name="login" class="btn" style="width: 100%;">Login</button>
                </form>
            </article>

            <center class="Black">Belum mempunyai akun? <a href="register.php" class="Black">Registrasi Disini</a></center>
        </div>
    </main>
    
   <?php include 'footer.php'; ?>

</body>
</html>