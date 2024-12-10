<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <main>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] === 'invalidcred') {
                echo '<script>alert("Data Invalid");</script>';
            } else if ($_GET['error'] === 'wrongpwd') {
                echo '<script>alert("Password Salah");</script>';
            } else if ($_GET['error'] === 'sqlerror') {
                echo '<script>alert("Database Error");</script>';
            } else if ($_GET['error'] === 'sqlerr') {
                echo '<script>alert("Database Error");</script>';
            }
        }
        ?>

        <!-- Login Form -->
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
                <h3 class="card-title text-center">Admin Login</h3>
                <form method="POST" action="../includes/admin/login.inc.php" class="mt-4">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Username/Email</label>
                        <input type="text" name="user_id" id="user_id" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_pass" class="form-label">Password</label>
                        <input type="password" name="user_pass" id="user_pass" class="form-control" required>
                    </div>
                    <button type="submit" name="login_but" class="btn btn-primary w-100 mt-3">Login</button>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
