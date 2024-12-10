<?php
include 'header.php';
?>

<?php
// Query jumlah pengguna, artikel, dan kategori promo
$user_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM users"))['count'];
$promo_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM artikel"))['count'];
$kode_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM kode_promo"))['count'];
?>

    <!-- Dashboard Content -->
    <div class="container my-5">
        <h1 class="text-center mb-4">Admin Dashboard</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Jumlah Pengguna</h5>
                        <h2><?= $user_count ?></h2>
                        <a href="daftar_user.php" style="text-decoration:none; color:black;">Detail Lengkap -></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Jumlah Promo</h5>
                        <h2><?= $promo_count ?></h2>
                        <a href="daftar_promo.php" style="text-decoration:none; color:black;">Detail Lengkap -></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Jumlah Kode Promo</h5>
                        <h2><?= $kode_count ?></h2>
                        <a href="daftar_kode.php" style="text-decoration:none; color:black;">Detail Lengkap -></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
