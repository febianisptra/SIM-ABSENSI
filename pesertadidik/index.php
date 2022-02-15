<?php
session_start();

include '../config/database.php';

$user = @$_POST['user'];

$a = mysqli_query($connection, "SELECT * FROM tbl_siswa WHERE nis = '$user'");
$b = mysqli_fetch_array($a);
$c = mysqli_num_rows($a);
$nama = @$b['nama'];

if (isset($_POST['login'])) {
    if ($_POST['pass'] == $_POST['user']) {
      $_SESSION['username'] = $_POST['user'];
      $_SESSION['password'] = $_POST['pass'];
      echo "<script>alert('Selamat datang {$nama}!!'); document.location.href='hal_peserta_didik.php?menu=home'</script>";
    } else {
      echo "<script>alert('Username dan Password Tidak Sesuai!!'); document.location.href='index.php'</script>";
    }
}

if (isset($_POST['batal'])) {
  header("location:../");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SIM ABSENSI</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/awal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body>
    <div class="container">
        <div class="icon">
            <a href="../index.php"><i class="fas fa-angle-left"></i></a>
        </div>

        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 30px; font-family:arial; font-weight: 600;">Peserta Didik</p>
            <div class="input-group">
                <input type="text" placeholder="Username" name="user">
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="pass">
            </div>
            <div class="input-group">
                <button name="login" class="btn">Login</button>
                <button name="batal" class="btn">Batal</button>
            </div>
        </form>
    </div>
    <img class="big-circle" src="../bg/big-eclipse.svg" alt="" />
    <img class="medium-circle" src="../bg/mid-eclipse.svg" alt="" />
    <img class="small-circle" src="../bg/small-eclipse.svg" alt="" />
</body>
</html>