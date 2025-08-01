<?php

session_start();
include 'config.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siparişiniz Alındı</title>
</head><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="sepetim.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="shortcut icon" type="x-icon" href="upload/rocket-takeoff.svg">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Pacifico&family=Roboto+Slab:wght@100..900&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Merienda:wght@300..900&family=Pacifico&family=Playwrite+BE+WAL:wght@100..400&family=Roboto+Slab:wght@100..900&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <title>Bozkır Teknoloji</title>
    <style>
        
    </style>
</head>
<body>
    
    
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

      <div class="iletisim">
        <h1>BOZKIR TEKNOLOJİ</h1>
        <div class="picture">
            <img src="upload/kutlama.png" alt="uçak">
        </div>
        <p>TÜRKİYENİN EN İYİ ROV MARKASINI TERCİH ETTİNİZ</p>
        <a href="index.php" class="btn-urunler">Diğer Ürünlerimize Bakmak İster Misiniz?</a>
    </div>
    

    <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top text-light mb-0 navbar-offset tema"  id="iletisim">
      
      <div class="col mb-3 ps-5 logo">
        <h4>Rukiye Uçar</h4>
        <p>© 2024</p>
        <img src="upload/LOGO3.png" alt="">
      </div> 
    

      <div class="col mb-3 ps-5">
        <h5>Hızlı Erişim</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="anasayfa.php" class="nav-link p-0 text-secondary fs-5 fonttema">Anasayfa</a></li>
          <li class="nav-item mb-2"><a href="anasayfa.php#hakkimizda" class="nav-link p-0 text-secondary fs-5 fonttema">Hakkımızda</a></li>
          <li class="nav-item mb-2"><a href="urunler.php" class="nav-link p-0 text-secondary fs-5 fonttema">Ürünler</a></li>
          <li class="nav-item mb-2"><a href="anasayfa.php#rov" class="nav-link p-0 text-secondary fs-5 fonttema">ROV Nedir?</a></li>
        </ul>
      </div>
      
    
      <div class="col mb-3 ps-5">
        <h5>İletişim</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="https://bozkirteknoloji.com/" class="nav-link p-0 text-secondary fs-5 fonttema">Web Sitemiz</a></li>
          <li class="nav-item mb-2"><a href="https://www.instagram.com/bozkirtech/" class="nav-link p-0 text-secondary fs-5 fonttema">Instagram</a></li>
          <li class="nav-item mb-2"><a href="https://www.linkedin.com/in/rukiye-u%C3%A7ar-007a0b232/" class="nav-link p-0 text-secondary fs-5 fonttema">Rukiye Uçar</a></li>
          <li class="nav-item mb-2"><a href="https://www.linkedin.com/in/yasin-yer-430163234?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" class="nav-link p-0 text-secondary fs-5 fonttema">Yasin Yer</a></li>
          <li class="nav-item mb-2"><a href="https://www.instagram.com/bozkirtech?igsh=MXZzbGN2cHJleDdqbg==" class="nav-link p-0 text-secondary fs-5 fonttema">Bozkır 3D Tasarım</a></li>
        </ul>
      </div>
      
      <div class="col mb-3 ps-5" >
        <p class="soz">Derinler yüzey kadar berrak değil</p>
        <p class="soz2">Bozkır</p>
      </div>
    
      
    </footer>
    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>

</body>
</html>
<body>
    
</body>
</html>
