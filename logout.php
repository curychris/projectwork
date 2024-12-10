<?php
session_start();

// Menghapus semua sesi dan cookies terkait autentikasi
setcookie('Uname', '', time() - 3600, "/");
setcookie('Upwd', '', time() - 3600, "/");
session_unset();  // Menghapus semua variabel sesi
session_destroy(); // Menghancurkan sesi

// Mencegah halaman cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Redirect ke halaman index dengan parameter sukses
header('Location: index.php?logout=success');
exit();
?>
