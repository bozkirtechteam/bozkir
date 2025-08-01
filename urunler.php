<?php

session_start();
include 'config.php';

// Sepetteki ürün sayısını alma
$urun_sayisi = 0;
if (isset($_SESSION['musteri_id'])) {
    $musteri_id = $_SESSION['musteri_id'];
    $stmt = $conn->prepare("SELECT SUM(adet) AS toplam_adet FROM sepet WHERE musteri_id = ?");
    $stmt->bind_param("i", $musteri_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $urun_sayisi = $row['toplam_adet'] ?? 0;
    $stmt->close();
}

// Kategoriye göre ürünleri filtreleme
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'tum';

if ($kategori === 'tum') {
    $sql = "SELECT * FROM urunler";
    $result = $conn->query($sql);
} else {
    $stmt = $conn->prepare("SELECT * FROM urunler WHERE kategori = ?");
    $stmt->bind_param("s", $kategori);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
}

// Sepete ekleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['islem']) && $_POST['islem'] === 'ekle') {
    if (!isset($_SESSION['musteri_id'])) {
        header("Location: giris.php");
        exit();
    }

    $urun_id = intval($_POST['urun_id']);
    $musteri_id = $_SESSION['musteri_id'];

    $check_query = "SELECT * FROM sepet WHERE musteri_id = ? AND urun_id = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("ii", $musteri_id, $urun_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $update_query = "UPDATE sepet SET adet = adet + 1 WHERE musteri_id = ? AND urun_id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ii", $musteri_id, $urun_id);
        $update_stmt->execute();
        $update_stmt->close();
    } else {
        $insert_query = "INSERT INTO sepet (musteri_id, urun_id, adet) VALUES (?, ?, 1)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("ii", $musteri_id, $urun_id);
        $insert_stmt->execute();
        $insert_stmt->close();
    }

    $check_stmt->close();

    // Sepete eklenme mesajı
    echo "<script>alert('Ürün sepete eklendi!');</script>";
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bozkır Teknoloji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="x-icon" href="upload/rocket-takeoff.svg">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400&display=swap" rel="stylesheet">
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

    <!-- ürünler -->
    <div class="container urunler fonttema mt-5">
        <h1 class="text-center my-4">Products</h1>
        <div class="btn-container filtre text-center mb-4">
            <a href="?kategori=tum" class="btn tema colorW">All</a>
            <a href="?kategori=Araç" class="btn tema colorW">ROV Vehicles</a>
            <a href="?kategori=YedekParça" class="btn tema colorW">Spare Parts</a>
        </div>

        <div class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <?php if (!empty($row['urun_foto'])): ?>
                                <img src="<?php echo htmlspecialchars($row['urun_foto']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['urun_adi']); ?>" style="max-height: 200px; object-fit: cover;">
                            <?php else: ?>
                                <img src="default.jpg" class="card-img-top" alt="Varsayılan Görsel" style="max-height: 200px; object-fit: cover;">
                            <?php endif; ?>

                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['urun_adi']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($row['aciklama']); ?></p>
                                <p class="card-text"><strong>Price:</strong> <?php echo htmlspecialchars($row['fiyat']); ?> $</p>
                                <form method="POST">
                                    <input type="hidden" name="urun_id" value="<?php echo $row['urun_id']; ?>">
                                    <input type="hidden" name="islem" value="ekle">
                                    <button type="submit" class="btn tema">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">No results found.</p>
            <?php endif; ?>
        </div>
        </div>
    <!-- footer -->
    <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top text-light mb-0 navbar-offset tema" id="iletisim">
        <div class="col mb-3 ps-5 logo">
            <h4>Rukiye Uçar</h4>
            <p>© 2024</p>
            <img src="upload/LOGO3.png" alt="">
        </div>
        <div class="col mb-3 ps-5">
            <h5>Hızlı Erişim</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="index.php" class="nav-link p-0 text-secondary fs-5 fonttema">Anasayfa</a></li>
                <li class="nav-item mb-2"><a href="index.php#hakkimizda" class="nav-link p-0 text-secondary fs-5 fonttema">Hakkımızda</a></li>
                <li class="nav-item mb-2"><a href="urunler.php" class="nav-link p-0 text-secondary fs-5 fonttema">Ürünler</a></li>
                <li class="nav-item mb-2"><a href="index.php#rov" class="nav-link p-0 text-secondary fs-5 fonttema">ROV Nedir?</a></li>
            </ul>
        </div>
        <div class="col mb-3 ps-5">
            <h5>İletişim</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="https://bozkirteknoloji.com/" class="nav-link p-0 text-secondary fs-5 fonttema">Web Sitemiz</a></li>
                <li class="nav-item mb-2"><a href="https://www.instagram.com/bozkirtech/" class="nav-link p-0 text-secondary fs-5 fonttema">Instagram</a></li>
                <li class="nav-item mb-2"><a href="https://www.linkedin.com/in/rukiye-u%C3%A7ar-007a0b232/" class="nav-link p-0 text-secondary fs-5 fonttema">Rukiye Uçar</a></li>
                <li class="nav-item mb-2"><a href="https://www.linkedin.com/in/yasin-yer-430163234" class="nav-link p-0 text-secondary fs-5 fonttema">Yasin Yer</a></li>
                <li class="nav-item mb-2"><a href="https://www.instagram.com/bozkir3desing/" class="nav-link p-0 text-secondary fs-5 fonttema">Bozkır 3D Tasarım</a></li>
            </ul>
        </div>
        <div class="col mb-3 ps-5">
            <p class="soz">Ben öyle bilirim ki yaşamak, berrak bir gökte çocuklar aşkına savaşmaktır.</p>
            <p class="soz2">İsmet ÖZEL</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
