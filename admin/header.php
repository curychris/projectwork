<?php
session_start();
require '../helpers/init_conn_db.php';

if (!isset($_SESSION['adminUname'])) {
    header("Location: login.php");
    exit();
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles/scroll.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="daftar_kode.php">List Kode Promo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="daftar_kategori.php">List Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="daftar_promo.php">List Promo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="daftar_user.php">List User</a>
                    </li>
                </ul>
                <form id="logoutForm" action="logout.php" method="POST" class="d-flex">
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmLogout()">Logout</button>
                </form>

                <script>
                    function confirmLogout() {
                        if (confirm("Apakah Anda yakin ingin logout?")) {
                            document.getElementById('logoutForm').submit();
                        }
                    }
                </script>
            </div>
        </div>
    </nav>