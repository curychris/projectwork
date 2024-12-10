<?php
require 'helpers/init_conn_db.php';

// Memastikan ID yang diterima valid
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query untuk mengambil detail artikel berdasarkan ID
    $query = "
        SELECT a.*, kp.nama_promo, kp.kode, k.nama_kategori 
        FROM artikel a
        LEFT JOIN kode_promo kp ON a.kode_promo = kp.id
        LEFT JOIN kategori k ON kp.kategori_id = k.id
        WHERE a.id = $id
    ";
    $result = mysqli_query($conn, $query);
    $artikel = mysqli_fetch_assoc($result);
    
    // Menampilkan data artikel
    if ($artikel) {
        $judul = $artikel['judul'];
        $deskripsi1 = $artikel['deskripsi1'];
        $deskripsi2 = $artikel['deskripsi2'];
        $gambar = $artikel['gambar'];
        $promo_berlaku = $artikel['promo_berlaku'];
        $minimum_pembelian = $artikel['minimum_pembelian'];
        $kode_promo = $artikel['kode_promo'];
        
        // Ambil data kategori, nama promo, dan kode promo dari hasil query
        $namaPromo = $artikel['nama_promo'];
        $kode = $artikel['kode'];
        $kategori = $artikel['nama_kategori']; // Mengambil nama kategori dari tabel kategori
    } else {
        echo "<p>Promo tidak ditemukan.</p>";
    }
}
?>

<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php'); ?>
<link rel="stylesheet" href="assets/css/form.css">

<div class="text-center my-4">
    <h2 class="fw-bold" style="margin-bottom: 35px; margin-top: 40px;">Detail Promo</h2>
</div>

<div class="container my-4">
  <div class="row">
    <!-- Konten Utama -->
    <div class="col-md-8">
      <div class="card">
        <img src="assets/image/<?php echo $gambar; ?>" class="card-img-top" alt="Promo Image" style="border-radius:15px;">
        <div class="card-body">
          <h3 class="card-title fw-bold" style="padding-top:10px;"><?php echo $judul; ?></h3>
          <hr>
          <p style="text-align: justify;">
              <?php echo $deskripsi1; ?>
          </p>
          <p style="text-align: justify;">
              <?php echo $deskripsi2; ?>
          </p>
        </div>
      </div><br>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-bold">Informasi Lainnya</h5>
          <hr>
          <p><b>Kategori Promo:</b> <?php echo $kategori; ?></p>
          <p><b>Promo Berlaku Sampai:</b> <?php echo $promo_berlaku; ?></p>
          <p><b>Minimum Transaksi:</b> IDR <?php echo number_format($minimum_pembelian, 0, ',', '.'); ?></p>
        </div>
      </div><br>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-bold">Keunggulan Promo</h5>
          <hr>
          <li>Berlaku untuk tiket sekali jalan maupun pulang-pergi.</li>
          <li>Promo berlaku untuk kelas ekonomi.</li>
          <li>Diskon besar-besaran.</li>
        </div>
      </div>
    </div>

    <!-- Kode Promo -->
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h4 style="font-weight: bold;">Kode Promo</h4><br>
          <div class="promo-item">
            <p><b><?php echo $namaPromo; ?></b></p>
            <div class="d-flex">
            <div class="input-group">
              <input type="text" id="promoCodeInput" class="form-control" value="<?php echo $kode; ?>" readonly>
              <button class="btn btn-primary" onclick="copyPromoCode()">Salin</button>
            </div>
            </div>
            </div>
          </div>
          <hr>
        </div>
      </div>
    </div>
  </div>
</div>

<?php subview('footer.php'); ?> 
