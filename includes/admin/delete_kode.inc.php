<?php
session_start();
require '../../helpers/init_conn_db.php';

// Memeriksa apakah ID diterima dan apakah ada sesi yang valid
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM kode_promo WHERE id = ?";

    // Menyiapkan statement SQL untuk mencegah SQL Injection
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Menambahkan parameter untuk statement
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Menjalankan query
        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../../admin/daftar_kode.php?delete=success");
            exit();
        } else {
            echo "Terjadi kesalahan dalam menghapus data. Silakan coba lagi.";
        }

        // Menutup statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Gagal menyiapkan query.";
    }

} else {
    header("Location: ../../admin/daftar_kode.php?error=invalidid");
    exit();
}
