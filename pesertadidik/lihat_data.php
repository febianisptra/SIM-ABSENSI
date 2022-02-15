<?php
@session_start();

include '../config/database.php';

$tampil = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM query_siswa WHERE nis = '$_SESSION[username]'"));

if (empty($_SESSION['username'])) {
  echo "<script>alert('Anda Belum Melakukan Login'); document.location.href='index.php'</script>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lihat Data</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
<h1 align="center">Berikut Data Diri Anda: </h1>
<table align="center">
  <tr>
    <td></td>
    <td><img src="../foto/<?php echo $tampil['foto']; ?>" height="200" width="200" class="img"></td>
    <td></td>
  </tr>
</table>

<table align="center">
  <tr>
    <td>NIS</td>
    <td>:</td>
    <td><?php echo $tampil['nis'] ?></td>
  </tr>
  <tr>
    <td>Nama</td>
    <td>:</td>
    <td><?php echo $tampil['nama'] ?></td>
  </tr>
  <tr>
    <td>Kelamin</td>
    <td>:</td>
    <td><?php echo $tampil['jk'] ?></td>
  </tr>
  <tr>
    <td>Rayon</td>
    <td>:</td>
    <td><?php echo $tampil['rayon'] ?></td>
  </tr>
  <tr>
    <td>Rombel</td>
    <td>:</td>
    <td><?php echo $tampil['rombel'] ?></td>
  </tr>
  <tr>
    <td>Tanggal Lahir</td>
    <td>:</td>
    <td><?php echo $tampil['tgl_lahir'] ?></td>
  </tr>
</table>
</div>

<br/>

  
</body>
</html>