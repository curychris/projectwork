<?php
include 'header.php';

// Query untuk mengambil data kode promo
$query = "SELECT kp.id, kp.nama_promo, kp.kode, k.nama_kategori AS kategori 
          FROM kode_promo kp 
          LEFT JOIN kategori k ON kp.kategori_id = k.id";
$result = mysqli_query($conn, $query);

?>

<div class="container my-5">
    <h2 class="text-left mb-4">Daftar Kode Promo</h2>

    <!-- Kolom Pencarian -->
    <div class="row mb-3">
        <div class="col-6">
            <a href="kode_promo.php" class="btn btn-primary">
                Buat Kode Promo
            </a>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <input type="text" id="searchInput" class="form-control w-50" placeholder="Cari Kode Promo...">
        </div>
    </div>

    <!-- Tabel Daftar Kode Promo -->
    <table class="table table-bordered" id="promoTable">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nama Promo</th>
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
                        <td><?= $row['nama_promo']; ?></td>
                        <td><?= $row['kode']; ?></td>
                        <td><?= ucfirst($row['kategori']); ?></td>
                        <td>
                            <a href="edit_kode.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="../includes/admin/delete_kode.inc.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus promo ini?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada kode promo</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    // Fungsi untuk memfilter tabel berdasarkan input pencarian
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchQuery = this.value.toLowerCase();
        const rows = document.querySelectorAll('#promoTable tbody tr');

        rows.forEach(row => {
            const columns = row.getElementsByTagName('td');
            const namePromo = columns[1].textContent.toLowerCase();
            const promoCode = columns[2].textContent.toLowerCase();

            // Menyembunyikan atau menampilkan baris berdasarkan pencarian
            if (namePromo.includes(searchQuery) || promoCode.includes(searchQuery)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
