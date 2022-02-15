<?php
session_start();

include '../config/database.php';
include '../library/controllers.php';

$perintah = new oop();


$table = "tbl_user";
$username = @$_POST['user'];
$password = @$_POST['pass'];
$nama_form = "hal_admin.php?menu=home";

if (isset($_POST['login'])) {
    $perintah->login($table, $username, $password, $nama_form);
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
            <p class="login-text" style="font-size: 30px; font-family:arial; font-weight: 600;">Administrator</p>
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
