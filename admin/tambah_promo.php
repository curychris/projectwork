<?php
include 'header.php';
?>
<?php
// Fetch kode promo untuk combo box
$query_promo = mysqli_query($conn, "SELECT * FROM kode_promo");

// Proses form tambah promo
if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $promo_berlaku = $_POST['promo_berlaku'];
    $minimum_pembelian = $_POST['minimum_pembelian'];
    $kode_promo = $_POST['kode_promo'];

    $gambar = $_FILES['gambar']['name'];
    $target = '../assets/image/' . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target);

    $query = "INSERT INTO artikel (judul, deskripsi, gambar, promo_berlaku, minimum_pembelian, kode_promo) 
              VALUES ('$judul', '$deskripsi', '$gambar', '$promo_berlaku', $minimum_pembelian, $kode_promo)";
    mysqli_query($conn, $query);
    header('Location: index.php');
}
?>


<div class="container my-5">
    <h2>Tambah Promo</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="gambar"> Pilih Gambar:</label>
            <input type="file" name="gambar" id="gambar" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="judul">Judul:</label>
            <input type="text" name="judul" id="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi">Deskripsi:</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="promo_berlaku">Berlaku Sampai:</label>
            <input type="date" name="promo_berlaku" id="promo_berlaku" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="minimum_pembelian">Minimum Pembelian:</label>
            <input type="number" name="minimum_pembelian" id="minimum_pembelian" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="kode_promo">Pilih Kode Promo:</label>
            <select name="kode_promo" id="kode_promo" class="form-control" required>
            <option value="0" selected disabled>Pilih Promo</option>
                <?php while ($row = mysqli_fetch_assoc($query_promo)): ?>
                    <option value="<?= $row['id']; ?>"><?= $row['nama_promo']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Tambah Promo</button>
    </form>
</div>
</body>
</html>
