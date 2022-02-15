<?php

$connection = mysqli_connect("localhost", "root", "") or die("Kesalahan Koneksi... !!");
mysqli_select_db($connection, "db_absensi") or die("Database error!");


?>