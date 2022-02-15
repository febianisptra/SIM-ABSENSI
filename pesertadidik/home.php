<?php
@session_start();

include '../config/database.php';

$tampil = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM query_siswa WHERE nis = '$_SESSION[username]'"));

if (empty($_SESSION['username'])) {
  echo "<script>alert('Anda Belum Melakukan Login!'); documen.location.href='index.php'</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIM Absensi</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="container">
    <h1>Welcome <a href="?menu=lihat_data" title="<?php echo $tampil['nama']; ?>">
      <?php echo $tampil['nama']; ?></a>
    </h1>
    <p class="copyright">Sistem Absensi Versi 1.0</p>
  </div>
</body>
</html>