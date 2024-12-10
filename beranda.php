<?php
include_once 'helpers/helper.php';
require 'helpers/init_conn_db.php';

// Mengambil data artikel beserta kategori dari database
$query = "SELECT a.*, k.nama_kategori AS kategori 
          FROM artikel a 
          LEFT JOIN kode_promo kp ON a.kode_promo = kp.id
          LEFT JOIN kategori k ON kp.kategori_id = k.id";
$result = mysqli_query($conn, $query);
?>
<?php subview('header.php'); ?>

<!-- Pesan Logout -->
<?php if (isset($_GET['logout']) && $_GET['logout'] === 'success') : ?>
    <script>
        Swal.fire({
            title: 'Success!',
            text: 'You have successfully logged out.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>

<!-- Header -->
<div class="text-center my-4">
    <h2 class="fw-bold" style="margin-bottom: 35px; margin-top: 40px;">Temukan Promo yang Menarik di Sini!</h2>
</div>

<!-- Tombol Kategori Promo -->
<?php
// Query untuk mengambil kategori
$kategori_query = "SELECT * FROM kategori";
$kategori_result = mysqli_query($conn, $kategori_query);
?>

<div class="container text-center mb-4">
    <div class="btn-group" role="group" aria-label="Promo buttons">
        <button type="button" class="btn btn-outline-secondary active" data-filter="all">Semua Promo</button>
        <?php while ($kategori = mysqli_fetch_assoc($kategori_result)) : ?>
            <button type="button" class="btn btn-outline-secondary" data-filter="<?= htmlspecialchars($kategori['nama_kategori']); ?>">
                <?= htmlspecialchars($kategori['nama_kategori']); ?>
            </button>
        <?php endwhile; ?>
    </div>
</div>

<?php
// Pastikan untuk membebaskan hasil query kategori
mysqli_free_result($kategori_result);
?>


<!-- Kartu Promo -->
<div class="container" id="promo">
    <div class="row g-1">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <div class="col-md-4 promo-card" data-category="<?= htmlspecialchars($row['kategori'] ?? ''); ?>">
                <div class="p-2">
                    <a href="promo.php?id=<?= $row['id']; ?>">
                        <img src="assets/image/<?= htmlspecialchars($row['gambar']); ?>" alt="Promo" class="img-fluid" style="width: 360px; height: 200px; border-radius:15px;">
                    </a>
                    <p class="text-center"><?= htmlspecialchars($row['judul']); ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php
mysqli_free_result($result);
?>
<?php subview('footer.php'); ?>
<script>
    // Fungsi untuk memfilter kartu promo berdasarkan kategori
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('[data-filter]');
        const promoCards = document.querySelectorAll('.promo-card');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const category = this.getAttribute('data-filter');

                // Menyesuaikan tampilan tombol aktif
                buttons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                // Menampilkan atau menyembunyikan kartu berdasarkan kategori
                promoCards.forEach(card => {
                    if (category === 'all' || card.getAttribute('data-category') === category) {
                        card.style.display = 'block'; // Tampilkan
                    } else {
                        card.style.display = 'none'; // Sembunyikan
                    }
                });
            });
        });
    });
</script>
