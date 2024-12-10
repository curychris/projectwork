<?php
include 'header.php';

// Query untuk mengambil data kode promo
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
?>

<div class="container my-5">
    <h2 class="text-left mb-4">Daftar Pengguna</h2>

    <!-- Kolom Pencarian -->
    <div class="d-flex justify-content-end mb-3">
        <input type="text" id="searchInput" class="form-control w-25" placeholder="Cari Username...">
    </div>

    <!-- Tabel Daftar Kode Promo -->
    <table class="table table-bordered" id="promoTable">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['user_id']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td>
                            <a href="../includes/admin/delete_user.inc.php?id=<?= $row['user_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus User ini?')">Delete</a>
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
