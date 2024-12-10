<?php
include 'db_connection.php'; // Menyertakan koneksi ke database
require '../../helpers/init_conn_db.php';

// Cek jika ID promo ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil nama gambar berdasarkan ID promo
    $query = mysqli_query($conn, "SELECT gambar FROM artikel WHERE id = '$id'");
    $row = mysqli_fetch_assoc($query);

    // Hapus file gambar dari folder jika ada
    if (!empty($row['gambar'])) {
        unlink('assets/image/' . $row['gambar']);
    }

    // Hapus data promo dari database
    $query_delete = "DELETE FROM artikel WHERE id = '$id'";
    if (mysqli_query($conn, $query_delete)) {
        header('Location: ../../admin/daftar_promo.php'); // Redirect setelah berhasil
    } else {
        echo "Terjadi kesalahan saat menghapus promo!";
    }
} else {
    echo "ID tidak ditemukan!";
}
?>
