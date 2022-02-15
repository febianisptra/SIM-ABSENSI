<?php 
@session_start();

include '../config/database.php';

$tampil = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM query_siswa WHERE nis = '$_SESSION[username]'"));

if (empty($_SESSION['username'])) {
  echo "<script>alert('Anda Belum Melakukan Login'); document.location.href='index.php'</script>";
}

if ($tampil['jk'] == "L") {
  $l = 'checked="checked"';
  $p = "";
} else {
  $p = 'checked="checked"';
  $l = "";
}

$date = explode("-", $tampil['tgl_lahir']);
$thn = $date[0];
$bln = $date[1];
$tgl = $date[2];

$perintah = new oop();
$table = "tbl_siswa";
$tanggal = @$_POST['thn'] . "-" . @$_POST['bln'] . "-"  . @$_POST['tgl'];
$where = "nis = "  . $_GET['nis'];
$redirect = "?menu=lihat_data";

if (isset($_POST['ubah'])) {
  $foto = $_FILES['foto'];
  $tempat = "../foto";
  $upload = $perintah->upload($foto, $tempat);
  $field = array('nis' => $_POST['nis'], 'nama' => $_POST['nama'], 'jk' => $_POST['jk'], 'id_rayon' => $_POST['rayon'], 
  'id_rombel' => $_POST['rombel'], 'foto' => $upload, 'tgl_lahir' => $tanggal);
  echo $perintah->ubah($table, $field, $where, $redirect);
}

if (isset($_POST['back'])) {
  header("location:hal_peserta_didik.php?menu=lihat_data");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="container">
  <form action="" method="post" enctype="multipart/form-data">
  <table align="center">
    <tr>
      <td></td>
      <td><img src="../foto/<?php echo $tampil['foto']; ?>" height="155" width="155"></td>
      <td></td>
    </tr>
  </table>
  <table align="center">
  <tr>
    <td>NIS</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="nis" value="<?php echo $tampil['nis'] ?>"></td>
  </tr>
  <tr>
    <td>Nama</td>
    <td>:</td>
    <td colspan="2"><input type="text" name="nama" value="<?php echo $tampil['nama'] ?>"></td>
  </tr>
  <tr>
    <td>Kelamin</td>
    <td>:</td>
    <td colspan="2">
      <input type="radio" name="jk" value="L" <?php echo $l; ?> >Laki-laki
      <input type="radio" name="jk" value="P" <?php echo $p; ?> >Perempuan
    </td>
  </tr>
  <tr>
    <td>Rayon</td>
    <td>:</td>
    <td colspan="2">
      <select name="rayon">
        <option value="<?php echo $tampil['id_rayon'] ?>"><?php echo $tampil['rayon'] ?></option>
        <?php
        $E = mysqli_query($connection, "select * from tbl_rayon");
        while ($r = mysqli_fetch_array($E)) {
          ?>
          <option value="<?php echo $r[0] ?>"><?php echo $r[1] ?></option>
          <?php
        }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td>Rombel</td>
    <td>:</td>
    <td colspan="2">
    <select name="rombel">
        <option value="<?php echo $tampil['id_rombel'] ?>"><?php echo $tampil['rombel'] ?></option>
        <?php
        $E = mysqli_query($connection, "select * from tbl_rombel");
        while ($r = mysqli_fetch_array($E)) {
          ?>
          <option value="<?php echo $r[0] ?>"><?php echo $r[1] ?></option>
          <?php
        }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td>Foto</td>
    <td>:</td>
    <td colspan="2"><input type="file" name="foto"></td>
  </tr>
  <tr>
    <td>Tanggal Lahir</td>
    <td>:</td>
    <td colspan="2">
      <select name="tgl">
        <option value="<?php echo $tgl; ?>"><?php echo $tgl; ?></option>
        <option value="">-----</option>
        <?php
        for ($tgl = 1; $tgl <= 31; $tgl++) {
          if ($tgl <= 9) {
        ?>
        <option value="<?php echo "0" . $tgl; ?>"><?php echo "0" . $tgl; ?></option>
        <?php } else { ?>

        <option value="<?php echo $tgl; ?>"><?php echo $tgl; ?></option>
        <?php 
          }
        }
        ?>
      </select>

      <select name="bln">
        <option value="<?php echo $bln; ?>"><?php echo $bln; ?></option>
        <option value="">-----</option>
        <?php
        for ($bln = 1; $bln <= 12; $bln++) {
          if ($bln <= 9) {
        ?>
        <option value="<?php echo "0" . $bln; ?>"><?php echo "0" . $bln; ?></option>
        <?php } else { ?>
        <option value="<?php echo $bln; ?>"><?php echo $bln; ?></option>
        <?php
          }
        }
        ?>
      </select>

      <select name="thn">
        <option value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
        <option value="">-----</option>
        <?php
        for ($thn = 2000; $thn <= 2022; $thn++) {
        ?>
        <option value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
        <?php } ?>
      </select>
    </td>     
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td><input type="submit" name="back" value="Kembali"></td>
    <td><input type="submit" name="ubah" value="Ubah"></td>
  </tr>
</table>
</form>
  </div>
</body>
</html>
