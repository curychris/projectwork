// copy
function copyPromoCode() {
  const promoCodeInput = document.getElementById('promoCodeInput');
  promoCodeInput.select();
  document.execCommand('copy');
  
  alert('Kode promo berhasil disalin!');
}

// delete
function confirmLogout(event) {
    event.preventDefault(); // Mencegah aksi default
    if (confirm("Apakah Anda yakin ingin logout?")) {
        window.location.href = 'logout.php';
    }
}