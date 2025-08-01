<?php


session_start();
include 'config.php';


$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

  
    $sql = "SELECT * FROM musteriler WHERE email = ? AND sifre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();
        $_SESSION['musteri_id'] = $user['musteri_id']; 
        $_SESSION['ad'] = $user['ad'];
        
        header("Location: urunler.php"); 
        exit(); 
    } else {
       
        $error = "E-posta veya şifre hatalı.";
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOZKIR | Login Form</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="x-icon" href="upload/rocket-takeoff.svg">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Pacifico&family=Roboto+Slab:wght@100..900&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Merienda:wght@300..900&family=Pacifico&family=Playwrite+BE+WAL:wght@100..400&family=Roboto+Slab:wght@100..900&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

</head>
<body class="yazi">


   <!-- navbar -->
   <nav class="navbar navbar-expand-lg fixed-top tema" id="anasayfa">
      <div class="container-fluid">
          <img src="upload/LOGO3.png" alt="">
          <a class="navbar-brand text-light" href="#">BOZKIR | Bozkır Teknoloji</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse fonttema" id="navbarNav">
              <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                      <a class="nav-link active fonttema text-light" href="index.php">Anasayfa</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link fonttema text-light" href="urunler.php">Ürünler</a>
                  </li>

                  <?php if (isset($_SESSION['musteri_id'])): ?>
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle text-light fonttema" href="#" id="hesabimMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Hesabım
                          </a>
                          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="hesabimMenu">
                              <li><a class="dropdown-item" href="cikis.php">Çıkış Yap</a></li>
                          </ul>
                      </li>
                  <?php else: ?>
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle text-light fonttema" href="#" id="girisMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Giriş Yap
                          </a>
                          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="girisMenu">
                            <li><a class="dropdown-item" href="giris.php">Giriş Yap</a></li>
                            <li><a class="dropdown-item" href="signup.php">Kayıt Ol</a></li>
                          </ul>
                      </li>
                  <?php endif; ?>

                  <li class="nav-item">
                      <a class="nav-link position-relative fonttema text-light" href="sepetim.php">
                          <i class="bi bi-cart"></i> Sepetim
                          <?php if ($urun_sayisi > 0): ?>
                              <span class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-danger">
                                  <?php echo $urun_sayisi; ?>
                                  <span class="visually-hidden">ürün</span>
                              </span>
                          <?php endif; ?>
                      </a>
                  </li>
              </ul>

          </div>
      </div>
  </nav>

    <!-- Login Form -->
    <div class="maincontainer">
        <?php if (!empty($ad) && !empty($soyad)): ?>
            <h2 style="color: #fff;">Hoş Geldiniz!</h2>
            <p><strong><?php echo htmlspecialchars($ad . ' ' . $soyad); ?></strong></p>
            <p>Ürünlerimize bakmak ister misiniz? <a href="urunler.php">Tıklayın</a></p>
        <?php else: ?>
            <!-- Giriş Formu -->
            <form action="" method="POST">
                <h2 style="color: #fff;">Login</h2>
                <div class="input-field">
                    <input type="email" name="email" id="email" required>
                    <label for="email">Enter your E-mail</label>
                </div>
                <div class="input-field">
                    <input type="password" name="password" id="password" required>
                    <label for="password">Enter your Password</label>
                </div>
                <button type="submit" class="btn" >Log In</button>
                <div class="account-options">
                    <p>Don't have an account? <a href="signup.php">Register</a></p>
                </div>
            </form>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>
    </div>
</body>
</html>