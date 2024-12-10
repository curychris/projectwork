<?php
include 'header.php';

// Query untuk mengambil data promo, kode_promo, dan kategori
$query_promo = "SELECT a.id, a.judul, a.deskripsi1, a.deskripsi2, a.gambar, a.promo_berlaku, a.minimum_pembelian, k.kode, c.nama_kategori AS kategori 
                FROM artikel a
                JOIN kode_promo k ON a.kode_promo = k.id
                LEFT JOIN kategori c ON k.kategori_id = c.id";  // Mengambil kategori dari tabel kategori
$result = mysqli_query($conn, $query_promo);
?>

<style>
    .table td, .table th {
        font-size: 0.9rem;
        vertical-align: middle;
    }
    .table img {
        max-width: 100px;
        height: auto;
    }
    .table {
        padding: 10px;
    }
</style>

<div class="container my-5">
    <h2 class="text-left mb-4">Daftar Promo</h2>

    <!-- Kolom Pencarian -->
    <div class="row mb-3">
        <div class="col-6">
            <a href="tambah_promo.php" class="btn btn-primary">
                Buat Promo
            </a>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <input type="text" id="searchInput" class="form-control w-50" placeholder="Cari Daftar Promo...">
        </div>
    </div>

    <!-- Tabel Daftar Promo -->
    <table class="table table-bordered" id="promoTable">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Gambar</th>
                <th>Nama Promo</th>
                <th>Deskripsi</th>
                <th>Berlaku Sampai</th>
                <th>Minimum Transaksi</th>
                <th>Kode Promo</th>
                <th>Kategori</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td>
                            <?php
                            // file gambar ada?
                            if (file_exists("../assets/image/" . $row['gambar'])) {
                                echo '<img src="../assets/image/' . $row['gambar'] . '" alt="Promo Image">';
                            } else {
                                echo '<img src="../assets/image/default.jpg" alt="Promo Image">';
                            }
                            ?>
                        </td>
                        <td><?= $row['judul']; ?></td>
                        <td  style="text-align: justify;"><?= $row['deskripsi1'] . ' ' . $row['deskripsi2']; ?></td>
                        <td><?= $row['promo_berlaku']; ?></td>
                        <td><?= $row['minimum_pembelian']; ?></td>
                        <td><?= $row['kode']; ?></td>
                        <td><?= $row['kategori']; ?></td>
                        <td>
                            <a href="edit_promo.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="../includes/admin/delete_promo.inc.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus promo ini?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center">Tidak ada promo ditemukan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchQuery = this.value.toLowerCase();
        const rows = document.querySelectorAll('#promoTable tbody tr');

        rows.forEach(row => {
            const columns = row.getElementsByTagName('td');
            const namaPromo = columns[2].textContent.toLowerCase(); 
            const kodePromo = columns[6].textContent.toLowerCase();
            const kategori = columns[7].textContent.toLowerCase();

            // Menyembunyikan atau menampilkan baris berdasarkan pencarian
            if (namaPromo.includes(searchQuery) || kodePromo.includes(searchQuery) || kategori.includes(searchQuery)) {
                row.style.display = ''; // Menampilkan baris
            } else {
                row.style.display = 'none'; // Menyembunyikan baris
            }
        });
    });
</script>
