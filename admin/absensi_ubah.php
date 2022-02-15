<?php
date_default_timezone_set('Asia/Bangkok');
?>

<?php

include_once '../config/database.php';

$perintah = new oop();

$id = @$_GET['id'];
$where = "nis = " . @$_GET['nis'];
$query = "query_absen";
$table = "tbl_rombel";

?>

<form action="" method="post">
  <table align="center">
    <tr>
      <td>Pilih Rombel</td>
      <td>:</td>
      <td>
        <select name="rmbl">
          <?php
          $a = $perintah->tampil("tbl_rombel");
          foreach ($a as $r) { ?>
          <option value="<?php echo $r['0'] ?>"><?php echo $r['1'] ?></option>
          <?php } ?>
        </select>
      </td>
    </tr>

    <tr>
      <td>Tanggal Absen</td>
      <td>:</td>
      <td>
        <select name="tgl">
          <option value=""></option>
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
          <option value=""></option>
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
          <option value=""></option>
          <?php
          for ($thn = 2015; $thn <= 2022; $thn++) {
            ?>
          <option value="<?php echo $thn; ?>"><?php echo $thn; ?></option>
          <?php } ?>
        </select>
      </td>
    </tr>

    <tr>
      <td><input type="submit" name="cetak" value="Cetak"></td>
    </tr>
  </table>
  <hr />

  <?php
  if (isset($_POST['cetak'])) {
    $rombel = $_POST['rmbl'];
    $thn = $_POST['thn'];
    $bln = $_POST['bln'];
    $tgl = $_POST['tgl'];
    ?>
    <script>document.location.href='?menu=ubahabsen&rombel=<?php echo $rombel ?>&thn=<?php echo $thn ?>&bln=<?php echo $bln ?>&tgl=<?php echo $tgl ?>'</script> 
    <?php
  }

  if (!empty(@$_GET['rombel'])) {
    ?>
  <br>

  <table border="1" cellspacing="0" align="center">
    <tr align="center">
      <td rowspan="2">No</td>
      <td rowspan="2">NIS</td>
      <td rowspan="2">Nama</td>
      <td rowspan="2">Rombel</td>
      <td colspan="4" align="center">Keterangan</td>
    </tr>

    <tr>
      <td>Hadir</td>
      <td>Sakit</td>
      <td>Ijin</td>
      <td>Alpa</td>
    </tr>
    <?php
    $rombel = @$_GET['rombel'];
    $thn = @$_GET['thn'];
    $bln = @$_GET['bln'];
    $tgl = @$_GET['tgl'];
    $a = $perintah->tampil("query_absen WHERE id_rombel = '$rombel' and 
    tgl_absen = '$thn-$bln-$tgl'");
    $no = 0;
    if ($a == "") {
      echo "<tr><td align='center' colspan='8'>NO RECORD</td></tr>";
    } else {
      foreach ($a as $r) {
        $no++;

        if ($r['hadir'] == 1) {
          $hadir = "checked";
          $sakit = "";
          $ijin = "";
          $alpa = "";
        }

        if ($r['sakit'] == 1) {
          $hadir = "";
          $sakit = "checked";
          $ijin = "";
          $alpa = "";
        }

        if ($r['ijin'] == 1) {
          $hadir = "";
          $sakit = "";
          $ijin = "checked";
          $alpa = "";
        }

        if ($r['alpa'] == 1) {
          $hadir = "";
          $sakit = "";
          $ijin = "";
          $alpa = "checked";
        }

        ?>

    <tr>
      <td><?php echo $no ?></td>
      <td><?php echo $r['nis'] ?></td>
      <td><?php echo $r['nama'] ?></td>
      <td><?php echo $r['rombel'] ?></td>
      <td><input type="radio" name="keterangan<?php echo $r['nis'] ?>" value="hadir" <?php echo $hadir ?> /></td>
      <td><input type="radio" name="keterangan<?php echo $r['nis'] ?>" value="sakit" <?php echo $sakit ?> /></td>
      <td><input type="radio" name="keterangan<?php echo $r['nis'] ?>" value="ijin" <?php echo $ijin ?> /></td>
      <td><input type="radio" name="keterangan<?php echo $r['nis'] ?>" value="alpa" <?php echo $alpa ?> /></td>
    </tr>

    <?php

    $tgl = date('Y-m-d');
    $table = "tbl_absen";
    $redirect = '?menu=ubahabsen';
    $where = "nis = " . $r['nis'];

    if (@$_POST['keterangan' . $r['nis']] == 'hadir') {
      $field = array('hadir' => '1', 'sakit' => '0', 'ijin' => '0', 'alpa' => '0', 'tgl_absen' => $tgl);
    } elseif (@$_POST['keterangan' . $r['nis']] == 'sakit') {
      $field = array('hadir' => '0', 'sakit' => '1', 'ijin' => '0', 'alpa' => '0', 'tgl_absen' => $tgl);
    } elseif (@$_POST['keterangan' . $r['nis']] == 'ijin') {
      $field = array('hadir' => '0', 'sakit' => '0', 'ijin' => '1', 'alpa' => '0', 'tgl_absen' => $tgl);
    } else {
      $field = array('hadir' => '0', 'sakit' => '0', 'ijin' => '0', 'alpa' => '1', 'tgl_absen' => $tgl);
    }

        if (isset($_REQUEST['ubah'])) {
          $perintah->ubah($table, $field, $where, $redirect);
        }

      }

      ?>
    <tr>
      <td colspan="10" align="center"><input type="submit" name="ubah" value="ubah"></td>
    </tr>
  </table>

  <?php
    }
  }
  ?>
</form>
<br/>