<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php'); 
require 'helpers/init_conn_db.php';                      
?> 
  <style>
    .hero-section {
      background-image: url('assets/image/landing.jpg'); /* Ganti dengan gambar hero */
      background-size: cover;
      background-position: center;
      color: white;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }
    .hero-text {
      font-size: 2.5rem;
      font-weight: bold;
      color: white;
    }
    .hero-description {
      color: white;
    }
    .btn-custom {
      background-color: transparent;
      font-weight: bold;
      border: 2px solid white;
      color: white;
      padding: 12px 30px;
      border-radius: 30px;
      font-size: 1.2rem;
      position: relative;
    }
    .btn-custom:hover {
    text-decoration: none;
    border-color: white;
    background-color: transparent;
    backdrop-filter: blur(5px);
    }
  </style>
  
</head>
<body>

  <!-- Hero Section -->
  <section class="hero-section">
    <div>
      <h1 class="hero-text">Welcome to Disc4U</h1>
      <p class="hero-description lead">Tempat dimana Anda dapat menemukan berbagai macam promo terbaik.</p>
      <div>
        <a href="login.php" class="btn btn-custom mx-3">Login User</a>
        <a href="admin/login.php" class="btn btn-custom mx-3">Login Admin</a>
      </div>
    </div>
  </section>

  <?php if (isset($_GET['logout']) && $_GET['logout'] === 'success'): ?>
    <script>
        alert("Logout berhasil!");
    </script>
  <?php endif; ?>
