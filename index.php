<?php

session_start();
include 'config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="anasayfa.css">
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

    <div id="carouselExampleSlidesOnly" class="carousel slide mt-5 sliderr" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="upload/sliderr1.jpeg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-flex align-items-center justify-content-start">
            <div class="text-box">
              <h5 class="slider-title">Barbaros Hayrettin Paşa'nın </h5>
              <p class="slider-subtitle">Mühendis Mürettebatı..</p>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>

    <div class="container mt-5 hakkimizda navbar-offset" id="hakkimizda">
        <div class="row">
            <div class="col-sm-6">
                <img class="w-100 img-thumbnail custom-size" src="upload/pusula.webp" alt="600*400"> 
            </div>
            <div class="col-sm-6">
                <h2 class="mt-3">Hakkımızda</h2>
                <p>
                &nbsp;Bozkır Teknoloji, 2023 yılında büyük bir tutkuyla hayata geçirilen bir girişimdir. Amacımız; teknolojiye, inovasyona ve mühendisliğe ilgi duyan bireyleri bir araya getirerek bilgi paylaşımını artırmak, projeler geliştirmek ve kalıcı değerler üretmektir. <br>
                  &nbsp;Bozkır Teknoloji olarak, başarının sürdürülebilirlik ve dayanışma ile mümkün olduğuna inanıyoruz. Teknolojik gelişmeleri yakından takip eden, sürekli öğrenen ve üreten bir ekiple, geleceğe yön vermek için çalışıyoruz. Yeni projelerle daha sağlam adımlarla ilerliyoruz. <br>

                  &nbsp;Geleceği şekillendirmek için buradayız ve bizimle birlikte yürüyen herkesin katkısının kıymetini biliyoruz. Bozkır'dan doğan bu teknoloji rüzgarının uzun yıllar esmeye devam edeceğine inanıyoruz. <br>

                  Bizi takipte kalın;)
                </p>
                
            </div>
        </div>
      




        <div class="row mb-2 mt-5" >
          <div class="col-12">
            <div class="row g-0 border rounded overflow-hidden mb-4 shadow-sm position-relative">
              
              <div class="col-12 p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary-emphasis">PRODUCTS</strong>
                <h3 class="mb-0">KCR-76</h3>
                <div class="mb-1 text-body-secondary">14 Ağustos</div>
                <p class="card-text mb-auto">ROV modelinin ayrıntılı bir 3D tasviri. Araçtaki her bileşen, mühendislik ve üretim süreçlerinde kullanılmak üzere hassas bir şekilde modellenmiştir.</p>
              </div>
        
             
              <div class="col-md-6 col-12">
                <img src="upload/kcr.jpg" width="100%" height="100%" alt="ROV Çizim 1">
              </div>
              <div class="col-md-6 col-12">
                <img src="upload/kcr2.jpg" width="100%" height="100%" alt="ROV Çizim 2">
              </div>
            </div>
          </div>
        </div>
        
    </div>
    <div class="about target" id="rov">
      <div class="wrapper target" id="6">
          <div class="text">
              <h1>ROV Nedir?</h1>
              <p>
              
              ROV, Uzaktan Kumandalı Su Altı Aracı (Remotely Operated Underwater Vehicle) anlamına gelir ve bazen su altı dronu veya su altı robotu olarak da adlandırılır. ROV'ler, operatörün veya pilotun su yüzeyinde kalarak su altı dünyasını keşfetmesine olanak tanır. ROV'ler olmadan, okyanusları keşfetme ve oralarda çalışma yeteneğimiz sınırlı olurdu çünkü tüplü dalgıçlar genellikle yüz metreden daha derine inemez ve insan taşıyan denizaltılar hem pahalı hem de nadirdir.
              </p>
              
          </div>
          <div class="picture">
              <img src="upload/kcr.jpg" alt="" >
          </div>
          
      </div>
      <div class="wrapper target" id="6">
        <div class="text">
            <h1>ROV'un Kısa Tarihi</h1>
            <p>
            
            Tarihte üretilen ilk ROV, 1953 yılında Fransız dalış ekipmanı ve fotoğrafçılık öncüsü Dimitri Rebikoff tarafından yapılan Poodle adlı araçtı. Poodle, Rebikoff’un dalış scooter'ının insansız hale getirilmiş bir versiyonuydu ve bir kablo ile yüzeyden kontrol ediliyordu. <br>

            ABD Donanması, 1960’lı yıllarda su altı ekipmanlarının kurtarılması için ROV'leri kullanmaya başladı ve bu teknolojinin gelişimini sürdürdü. 1980'lere gelindiğinde dünya genelinde 500’den fazla ROV bulunuyordu ve bunların çoğu ticari amaçlarla kullanılıyordu. Günümüzde ise on binlerce ROV, farklı endüstrilerde yaygın olarak kullanılmaktadır.
            </p>
            
        </div>
        <div class="picture">
            <img src="upload/aciklama.png" alt="" >
        </div>
        
    </div>
    <div class="wrapper target" id="6">
      <div class="text">
          <h1>ROV Ne Anlama Gelir?</h1>
          <p>
          ROV araçları, polis ve itfaiye teşkilatları tarafından arama ve kurtarma görevlerinde sıklıkla kullanılır. Kayıp kişileri, tekneleri, araçları ve suya batmış diğer nesneleri bulmak için tercih edilirler. Üzerine takılan robotik kıskaçlar sayesinde, nesneleri hatta bazı talihsiz durumlarda kurbanları sudan çıkarmak için de kullanılabilirler. <br>

          ROV'ler ayrıca askeriye ve liman güvenliği tarafından su altı altyapısını incelemek, kaçakçılığı tespit etmek, patlayıcı cihazları ve su altında bulunan delilleri araştırmak için kullanılır. ROV kullanımı sayesinde, bu tür riskli görevler insan dalgıçların hayatını tehlikeye atmadan gerçekleştirilebilir.
          </p>
          
      </div>
      <div class="picture">
          <img src="upload/aciklama2.png" alt="" >
      </div>
      
  </div>
    </div>

<section class="py-5 bg-light" id="sponsorlarimiz">
  <div class="container text-center">
    <h2 class="mb-4 text-primary">Sponsorlarımız</h2>
    <p class="mb-5">Sponsorumuz falan yok tamamen kendi cebimizden nasipse siz olacaksınız</p>
    <div class="row justify-content-center">
      
      <div class="col-md-4 mb-4">
        <div class="card h-100 border-primary">
          <div class="card-body">
            <h5 class="card-title">3D Tasarım</h5>
            <p class="card-text">Projelerimiz için özel olarak modellediğimiz mekanik ve yapısal parçalar.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="card h-100 border-primary">
          <div class="card-body">
            <h5 class="card-title">3D Baskı</h5>
            <p class="card-text">Ürettiğimiz 3D modelleri kendi yazıcımızda kaliteli şekilde bastık.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="card h-100 border-primary">
          <div class="card-body">
            <h5 class="card-title">UI/UX Tasarımı</h5>
            <p class="card-text">Kullanıcı dostu ve estetik arayüzlerle dijital çözümler ürettik.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100 border-primary">
          <div class="card-body">
            <h5 class="card-title">Sağlık</h5>
            <p class="card-text">Diş Çekilir</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100 border-primary">
          <div class="card-body">
            <h5 class="card-title">Kaçakçılık</h5>
            <p class="card-text">Kürtiçi kargoyla hizmetinizde</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100 border-primary">
          <div class="card-body">
            <h5 class="card-title">Ceza İnfaz</h5>
            <p class="card-text">Gasp, Adam Öldürülür </p>
          </div>
        </div>
      </div>

      <!-- Yeni hizmetler eklemek için aşağıya benzer kartlar ekleyebilirsin -->

    </div>
  </div>
</section>


<div class="container my-5 sponsor-form">
    <h2 class="mb-4 text-center">Sponsor Başvuru Formu</h2>
    
    <form action="sponsor_kaydet.php" method="POST" class="mx-auto  " style="max-width: 600px;">
        <div class="mb-3">
            <label for="isim" class="form-label">İsim</label>
            <input type="text" class="form-control" id="isim" name="isim" placeholder="İsminiz" required />
        </div>
        
        <div class="mb-3">
            <label for="soyisim" class="form-label">Soyisim</label>
            <input type="text" class="form-control" id="soyisim" name="soyisim" placeholder="Soyisminiz" required />
        </div>
        
        <div class="mb-3">
            <label for="firma" class="form-label">Firma Adı</label>
            <input type="text" class="form-control" id="firma" name="firma" placeholder="Firma Adı" required />
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">E-posta</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="E-posta adresiniz" required />
        </div>
        
        <div class="mb-3">
            <label for="telefon" class="form-label">Telefon</label>
            <input type="tel" class="form-control" id="telefon" name="telefon" placeholder="Telefon numaranız" />
        </div>

        <div class="mb-4">
      <label for="mesaj" class="form-label">Mesajınız</label>
      <textarea class="form-control" id="mesaj" name="mesaj" rows="4" placeholder="Mesajınızı buraya yazın..." required></textarea>
    </div>
        
        <button type="submit" class="btn btn-custom w-100">Gönder</button>
    </form>

    <div class="my-5 text-center">
  <h3 >Teklif Dosyası</h3>
<a href="pdfler/tanitim-sponsor.pptx" download class="btn btn-custom ">PDF İndir</a>
</div>
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
          <li class="nav-item mb-2"><a href="index.php" class="nav-link p-0 text-secondary fs-5 fonttema">Anasayfa</a></li>
          <li class="nav-item mb-2"><a href="#hakkimizda" class="nav-link p-0 text-secondary fs-5 fonttema">Hakkımızda</a></li>
          <li class="nav-item mb-2"><a href="urunler.php" class="nav-link p-0 text-secondary fs-5 fonttema">Ürünler</a></li>
          <li class="nav-item mb-2"><a href="#rov" class="nav-link p-0 text-secondary fs-5 fonttema">ROV Nedir?</a></li>
        </ul>
      </div>
      
    
      <div class="col mb-3 ps-5">
        <h5>İletişim</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="https://bozkirteknoloji.com/" class="nav-link p-0 text-secondary fs-5 fonttema">Web Sitemiz</a></li>
          <li class="nav-item mb-2"><a href="https://www.instagram.com/bozkirtech/" class="nav-link p-0 text-secondary fs-5 fonttema">Instagram</a></li>
          <li class="nav-item mb-2"><a href="https://www.linkedin.com/in/rukiye-u%C3%A7ar-007a0b232/" class="nav-link p-0 text-secondary fs-5 fonttema">Rukiye Uçar</a></li>
          <li class="nav-item mb-2"><a href="https://www.instagram.com/bozkirtech?igsh=MXZzbGN2cHJleDdqbg==" class="nav-link p-0 text-secondary fs-5 fonttema">Bozkır 3D Tasarım</a></li>
        </ul>
      </div>
      
      <div class="col mb-3 ps-5" >
        <p class="soz">Ben öyle bilirim ki yaşamak, berrak bir gökte çocuklar aşkına savaşmaktır.</p>
        <p class="soz2">İsmet ÖZEL</p>
      </div>
    
      
    </footer>
    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>

</body>
</html>