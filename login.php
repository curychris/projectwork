<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php'); ?>

<?php
if(isset($_GET['error'])) {
    if($_GET['error'] === 'invalidcred') {
        echo '<script>alert("Invalid Credentials")</script>';
    } else if($_GET['error'] === 'wrongpwd') {
        echo '<script>alert("Wrong Password")</script>';
    } else if($_GET['error'] === 'sqlerror') {
        echo "<script>alert('Database error')</script>";
    }
}
if(isset($_COOKIE['Uname']) && isset($_COOKIE['Upwd'])) {
  require 'helpers/init_conn_db.php';   
  $email_id = $_POST['user_id'];
  $password = $_POST['user_pass'];
  $sql = 'SELECT * FROM Users WHERE username=? OR email=?;';
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt,$sql)) {
      header('Location: login.php?error=sqlerror');
      exit();            
  } else {
      mysqli_stmt_bind_param($stmt,'ss',$_COOKIE['Uname'],$_COOKIE['Uname']);            
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)) {
          $pwd_check = password_verify($_COOKIE['Upwd'],$row['password']);
          if($pwd_check == false) {
              setcookie('Uname', '',time() - 3600);
              setcookie('Upwd', '',time() - 3600);              
              header('Location: login.php?error=wrongpwd');
              exit();    
          }
          else if($pwd_check == true) {
              session_start();
              $_SESSION['userId'] = $row['user_id'];
              $_SESSION['userUid'] = $row['username'];
              $_SESSION['userMail'] = $row['email'];                            
              header('Location: beranda.php?login=success');
              exit();                   
          } else {
              header('Location: login.php?error=invalidcred');
              exit();                    
          }
      }
      header('Location: login.php?error=invalidcred');
      exit();         
  }
  header('Location: login.php?error=invalidcred');
  exit();      
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Disc4U</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <main>
        <!-- Alert Messages -->
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] === 'invalidcred') {
                echo '<script>alert("Invalid Credentials")</script>';
            } else if ($_GET['error'] === 'wrongpwd') {
                echo '<script>alert("Wrong Password")</script>';
            } else if ($_GET['error'] === 'sqlerror') {
                echo "<script>alert('Database error')</script>";
            }
        }
        ?>

        <!-- Login Form -->
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
                <h3 class="card-title text-center">User Login</h3>
                <form method="POST" action="includes/login.inc.php" class="mt-4">
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

                <div class="mt-3 text-center">
                    <p>Belum punya akun? <a href="register.php" style="text-decoration:none;">Register disini</a></p>
                </div>
            </div>
        </div>
    </main>