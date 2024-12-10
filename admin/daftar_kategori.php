<?php
ob_start(); // Menyalakan output buffering

include 'header.php'; 

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$query = "SELECT * FROM kategori";
$result = mysqli_query($conn, $query);

if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $id = $_GET['delete'];

    $deleteQuery = "DELETE FROM kategori WHERE id = ?";
    
    if ($stmt = mysqli_prepare($conn, $deleteQuery)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: daftar_kategori.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Query gagal dipersiapkan.";
    }
}

// Edit Kategori
if (isset($_POST['id']) && isset($_POST['nama_kategori'])) {
    $id = $_POST['id'];
    $nama_kategori = $_POST['nama_kategori'];

    $updateQuery = "UPDATE kategori SET nama_kategori = ? WHERE id = ?";
    
    if ($stmt = mysqli_prepare($conn, $updateQuery)) {
        mysqli_stmt_bind_param($stmt, "si", $nama_kategori, $id);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: daftar_kategori.php?edit=success");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Query gagal dipersiapkan.";
    }
}

// kategori baru
if (isset($_POST['tambah_kategori'])) {
    $kategori_baru = $_POST['kategori_baru'];
    $query = "INSERT INTO kategori (nama_kategori) VALUES ('$kategori_baru')";
    mysqli_query($conn, $query);
    header('Location: daftar_kategori.php');
}
?>

<div class="container my-5">
    <h2 class="text-left mb-4">Daftar Kategori</h2>
    <div class="row mb-3">
        <div class="col-6">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalKategori">
                Buat Kategori Baru
            </button>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <input type="text" id="searchInput" class="form-control w-50" placeholder="Cari Kategori...">
        </div>
    </div>

    <table class="table table-bordered" id="kategoriTable">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= ucfirst($row['nama_kategori']); ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" 
                                    data-id="<?= $row['id']; ?>" data-nama="<?= $row['nama_kategori']; ?>">Edit</button>
                            <a href="?delete=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">Tidak ada kategori</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal Edit Kategori -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="daftar_kategori.php" method="POST">
          <input type="hidden" id="editId" name="id">
          <div class="mb-3">
            <label for="editNamaKategori" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="editNamaKategori" name="nama_kategori" required>
          </div>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="modalKategori" tabindex="-1" aria-labelledby="modalKategoriLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKategoriLabel">Tambah Kategori Promo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kategori_baru">Nama Kategori:</label>
                        <input type="text" name="kategori_baru" id="kategori_baru" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="tambah_kategori" class="btn btn-primary">Tambah</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // modal edit
    var editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Tombol yang diklik
        var id = button.getAttribute('data-id');
        var nama = button.getAttribute('data-nama');
        
        var modalId = editModal.querySelector('#editId');
        var modalNama = editModal.querySelector('#editNamaKategori');
        
        modalId.value = id;
        modalNama.value = nama;
    });
</script>

<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchQuery = this.value.toLowerCase();
        const rows = document.querySelectorAll('#kategoriTable tbody tr');

        rows.forEach(row => {
            const columns = row.getElementsByTagName('td');
            const kategoriName = columns[1].textContent.toLowerCase();

            if (kategoriName.includes(searchQuery)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

<?php
ob_end_flush(); // Menyelesaikan output buffering
?>
