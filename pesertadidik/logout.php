<?php

session_start();
session_destroy();

echo "<script>alert('Logout Sukses'); document.location.href='../'</script>";

?>