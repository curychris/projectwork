<?php
include 'header.php';

// Tambahkan kode promo baru
if (isset($_POST['submit'])) {
    $nama_promo = $_POST['nama_promo'];
    $kode = $_POST['kode'];
    $kategori = $_POST['kategori'];

    $query = "INSERT INTO kode_promo (nama_promo, kode, kategori_id) VALUES ('$nama_promo', '$kode', '$kategori')";
    mysqli_query($conn, $query);
    header('Location: daftar_kode.php');
}
?>

<div class="container my-5">
    <h2>Tambah Kode Promo</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="nama_promo">Nama Promo:</label>
            <input type="text" name="nama_promo" id="nama_promo" class="form-control" required>
        </div>

        <!-- Dropdown untuk kategori -->
        <div class="mb-3">
            <label for="kategori">Kategori:</label>
            <select name="kategori" id="kategori" class="form-control" required>
                <option value="" disabled selected>Pilih Kategori</option>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM kategori");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id']}'>{$row['nama_kategori']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="kode">Kode Promo:</label>
            <div class="input-group">
                <input type="text" name="kode" id="kode" class="form-control" required>
            </div>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Tambah Kode Promo</button>
    </form>
</div>