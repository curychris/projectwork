<?php
include 'header.php';

// Ambil ID promo
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data promo
    $query = mysqli_query($conn, "SELECT * FROM artikel WHERE id = '$id'");
    $row = mysqli_fetch_assoc($query);

    if (isset($_POST['submit'])) {
        $judul = $_POST['judul'];
        $deskripsi1 = $_POST['deskripsi1'];
        $deskripsi2 = $_POST['deskripsi2'];
        $promo_berlaku = $_POST['promo_berlaku'];
        $minimum_pembelian = $_POST['minimum_pembelian'];
        $kode_promo = $_POST['kode_promo'];

        $query_update = "UPDATE artikel SET 
                            judul = '$judul',
                            deskripsi1 = '$deskripsi1',
                            deskripsi2 = '$deskripsi2',
                            promo_berlaku = '$promo_berlaku',
                            minimum_pembelian = '$minimum_pembelian',
                            kode_promo = '$kode_promo'";

        // gambar diupdate?
        if (!empty($_FILES['gambar']['name'])) {
            $gambar = $_FILES['gambar']['name'];
            $target = '../assets/image/' . basename($gambar);  // Pastikan path relatif benar

            // gambar berhasil diupload?
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
                $query_update .= ", gambar = '$gambar'";
            } else {
                echo "Gagal mengunggah gambar.";
                exit;
            }
        }

        $query_update .= " WHERE id = '$id'";

        // Eksekusi query update
        if (mysqli_query($conn, $query_update)) {
            header('Location: daftar_promo.php');
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($conn);
        }
    }
} else {
    echo "Promo tidak ditemukan!";
}
?>

<div class="container my-5">
    <h2>Edit Promo</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="gambar">Pilih Gambar:</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>
        <div class="mb-3">
            <label for="judul">Nama Promo:</label>
            <input type="text" name="judul" id="judul" class="form-control" value="<?= $row['judul']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi">Deskripsi 1:</label>
            <textarea name="deskripsi1" id="deskripsi" class="form-control" required><?= $row['deskripsi1']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="deskripsi">Deskripsi 2 (opsional):</label>
            <textarea name="deskripsi2" id="deskripsi" class="form-control"><?= $row['deskripsi2']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="promo_berlaku">Berlaku Sampai:</label>
            <input type="date" name="promo_berlaku" id="promo_berlaku" class="form-control" value="<?= $row['promo_berlaku']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="minimum_pembelian">Minimum Pembelian:</label>
            <input type="number" name="minimum_pembelian" id="minimum_pembelian" class="form-control" value="<?= $row['minimum_pembelian']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="kode_promo">Pilih Kode Promo:</label>
            <select name="kode_promo" id="kode_promo" class="form-control" required>
                <?php
                // Fetch kode promo
                $query_promo = mysqli_query($conn, "SELECT * FROM kode_promo");
                while ($promo = mysqli_fetch_assoc($query_promo)): 
                ?>
                    <option value="<?= $promo['id']; ?>" <?= $row['kode_promo'] == $promo['id'] ? 'selected' : ''; ?>><?= $promo['nama_promo']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Update Promo</button>
        <a href="daftar_promo.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
