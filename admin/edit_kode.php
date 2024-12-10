<?php
include 'header.php';

// parameter ID ada?
if (!isset($_GET['id'])) {
    echo "ID kode promo tidak ditemukan.";
    exit;
}

$id = $_GET['id'];

// Ambil data kode promo berdasarkan ID
$query = "SELECT * FROM kode_promo WHERE id = '$id'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    echo "Kode promo tidak ditemukan.";
    exit;
}

$data = mysqli_fetch_assoc($result);

// Proses form edit kode promo
if (isset($_POST['submit'])) {
    $nama_promo = $_POST['nama_promo'];
    $kode = $_POST['kode'];
    $kategori = $_POST['kategori'];

    // Query untuk memperbarui data kode promo
    $updateQuery = "UPDATE kode_promo SET nama_promo = '$nama_promo', kode = '$kode', kategori_id = '$kategori' WHERE id = '$id'";
    if (mysqli_query($conn, $updateQuery)) {
        header('Location: daftar_kode.php');
        exit;
    } else {
        echo "Terjadi kesalahan saat mengupdate data.";
    }
}
?>

<div class="container my-5">
    <h2>Edit Kode Promo</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="nama_promo">Nama Promo:</label>
            <input type="text" name="nama_promo" id="nama_promo" class="form-control" value="<?= $data['nama_promo'] ?>" required>
        </div>

        <!-- kategori -->
        <div class="mb-3">
            <label for="kategori">Kategori:</label>
            <select name="kategori" id="kategori" class="form-control" required>
                <?php
                // Ambil kategori dari tabel kategori
                $kategoriQuery = "SELECT * FROM kategori";
                $kategoriResult = mysqli_query($conn, $kategoriQuery);

                // Tampilkan pilihan kategori dari tabel kategori
                while ($kategoriRow = mysqli_fetch_assoc($kategoriResult)) {
                    echo "<option value='" . $kategoriRow['id'] . "' " . ($data['kategori_id'] == $kategoriRow['id'] ? 'selected' : '') . ">" . ucfirst($kategoriRow['nama_kategori']) . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="kode">Kode Promo:</label>
            <input type="text" name="kode" id="kode" class="form-control" value="<?= $data['kode'] ?>" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="daftar_kode.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
