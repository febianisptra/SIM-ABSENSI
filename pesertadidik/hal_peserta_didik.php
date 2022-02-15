<?php
@session_start();

include '../config/database.php';
include '../library/controllers.php';

$perintah = new oop();

$perintah->tampil("tbl_siswa WHERE nis = '$_SESSION[username]'");

if (empty($_SESSION['username'])) {
  echo "<script>alert('Silakan login terlebih dahulu'); document.location.href='index.php'</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIM ABSEN HAL PESERTA DIDIK</title>
  <link rel="stylesheet" href="../bar/style.css">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <div id="utama">
    <nav>
    <div class="sidebar-top">
      <span class="shrink-btn">
        <i class='bx bx-chevron-left'></i>
      </span>
      <h3 class="hide">SIM ABSENSI</h3>
    </div>
    <div class="sidebar-links">
      <ul>
        <div class="active-tab"></div>
        <li class="tooltip-element" data-tooltip="0" >
          <a href="?menu=home" class="active" data-active="0">
            <div class="icon">
              <i class='bx bx-tachometer'></i>
              <i class='bx bxs-tachometer'></i>
            </div>
            <span class="link hide">Home</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="1">
          <a href="?menu=lihat_data" data-active="1">
            <div class="icon">
              <i class='bx bx-folder'></i>
              <i class='bx bxs-folder'></i>
            </div>
            <span class="link hide">Lihat</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="2">
          <a href="?menu=edit_data&nis=<?php echo $_SESSION['username'] ?>" data-active="2">
            <div class="icon">
              <i class='bx bx-notepad'></i>
              <i class='bx bxs-notepad'></i>
            </div>
            <span class="link hide">Edit</span>
          </a>
        </li>
      </ul>

      <h4 class="hide">Laporan</h4>

      <ul>
        <li class="tooltip-element" data-tooltip="1">
          <a href="laporan_today.php?menu=laporan&nis=<?php echo $_SESSION['username'] ?>" target="_blank" rel="noopener noreferrer" data-active="5">
            <div class="icon">
              <i class='bx bx-bar-chart-square'></i>
              <i class='bx bxs-bar-chart-square'></i>
            </div>
            <span class="link hide">Print</span>
          </a>
        </li>
      </ul>
    </div>

    <div class="sidebar-footer">
      <a href="#" class="account tooltip-element" data-tooltip="0">
        <i class='bx bx-user'></i>
      </a>
      <a href="logout.php" onClick="return confirm('Anda Yakin Ingin Keluar?')" class="log-out">
        <i class='bx bx-log-out'></i>
      </a>
  </nav>


    <div class="konten">
      <?php
      switch ($_GET['menu']) {
        case 'home':
          include 'home.php';
          break;
        
        case 'lihat_data':
          include 'lihat_data.php';
          break;

        case 'edit_data';
          include 'edit_data_diri.php';
          break;
      }
      ?>
    </div>
  </div>

  <script src="../js/app.js"></script>
</body>
</html>