<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disc4U - Promo Pesawat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- My Own Styles -->
    <link rel="stylesheet" href="assets/styles/style.css" />
    <link rel="stylesheet" href="assets/styles/scroll.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet" />
</head>

<body>
    <!-- Navbar -->
    <?php if (basename($_SERVER['PHP_SELF']) != 'index.php' && basename($_SERVER['PHP_SELF']) != 'login.php' && basename($_SERVER['PHP_SELF']) != 'register.php'): ?>
        <nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background-color:#333333;">
            <div class="container">
                <a class="navbar-brand fw-bold" href="beranda.php" style="color:white;">Disc4U</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="beranda.php">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="beranda.php#promo">Promo Tiket</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Kami</a></li>
                        <li class="nav-item">
                        <a class="nav-link" href="#" onclick="confirmLogout(event)">
                            <button class="btn btn-outline-danger btn-sm">Logout</button>
                        </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <?php endif; ?>

    <script src="index.js"></script>
</body>
</html>
