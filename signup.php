<?php


include 'config.php';
$errors = [];
$inputs = [];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputs['ad'] = $_POST['ad'] ?? '';
    $inputs['soyad'] = $_POST['soyad'] ?? '';
    $inputs['telefon'] = $_POST['telefon'] ?? '';
    $inputs['email'] = $_POST['email'] ?? '';
    $inputs['sifre'] = $_POST['sifre'] ?? '';
    
    

    if (empty($inputs['ad'])) {
        $errors['ad'] = "Ad alanı gerekli.";
    }

    if (empty($inputs['soyad'])) {
        $errors['soyad'] = "Soyad alanı gerekli.";
    }

    if (empty($inputs['telefon']) || !preg_match('/^[0-9]{10,11}$/', $inputs['telefon'])) {
        $errors['telefon'] = "Geçerli bir telefon numarası giriniz (10-11 haneli).";
    }

    if (empty($inputs['email']) || !filter_var($inputs['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Geçerli bir email adresi giriniz.";
    }

    if (empty($inputs['sifre']) || strlen($inputs['sifre']) < 6) {
        $errors['sifre'] = "Şifre en az 6 karakter olmalıdır.";
    }


   
    if (empty($errors)) {
        $ad = $conn->real_escape_string($inputs['ad']);
        $soyad = $conn->real_escape_string($inputs['soyad']);
        $telefon = $conn->real_escape_string($inputs['telefon']);
        $email = $conn->real_escape_string($inputs['email']);
        $sifre = $conn->real_escape_string($inputs['sifre']);
        $kayit_tarihi = date("Y-m-d H:i:s");

        
        $sql = "INSERT INTO musteriler (ad, soyad, email, telefon, sifre, kayit_tarihi)
                VALUES ('$ad', '$soyad', '$email', '$telefon', '$sifre', '$kayit_tarihi')";

        if ($conn->query($sql) === TRUE) {
            header("Location: giris.php");
            exit();
        } else {
            $errors['general'] = "Veritabanı hatası: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="shortcut icon" type="x-icon" href="upload/rocket-takeoff.svg">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Pacifico&family=Roboto+Slab:wght@100..900&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Merienda:wght@300..900&family=Pacifico&family=Playwrite+BE+WAL:wght@100..400&family=Roboto+Slab:wght@100..900&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body class="yazi">


<div class="maincontainer ">
        <?php if ($kullanici): ?>
            <h2>Sign-up successful</h2>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($kullanici['ad']); ?></p>
            <p><strong>Surname:</strong> <?php echo htmlspecialchars($kullanici['soyad']); ?></p>
            <p><strong>E-mail:</strong> <?php echo htmlspecialchars($kullanici['email']); ?></p>
            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($kullanici['telefon']); ?></p>
        <?php else: ?>
            <form action="" method="POST">
    <h2>Sign up</h2>
    
    <div class="input-field">
        <input type="text" name="ad" required value="<?= htmlspecialchars($inputs['ad'] ?? '') ?>">
        <label for="ad">Name</label>
        <small style="color: red;"><?= $errors['ad'] ?? '' ?></small>
    </div>
    
    <div class="input-field">
        <input type="text" name="soyad" required value="<?= htmlspecialchars($inputs['soyad'] ?? '') ?>">
        <label for="soyad">Last Name</label>
        <small style="color: red;"><?= $errors['soyad'] ?? '' ?></small>
    </div>

    <div class="input-field">
        <input type="text" name="telefon" required value="<?= htmlspecialchars($inputs['telefon'] ?? '') ?>">
        <label for="telefon">Phone Number</label>
        <small style="color: red;"><?= $errors['telefon'] ?? '' ?></small>
    </div>
    
    <div class="input-field">
        <input type="email" name="email" required value="<?= htmlspecialchars($inputs['email'] ?? '') ?>">
        <label for="email">E-mail</label>
        <small style="color: red;"><?= $errors['email'] ?? '' ?></small>
    </div>

    <div class="input-field">
        <input type="password" name="sifre" required>
        <label for="sifre">Password</label>
        <small style="color: red;"><?= $errors['sifre'] ?? '' ?></small>
    </div>

    <button type="submit">Sign Up</button>

    <div class="account-options">
        <p>Already have an account?<a href="giris.php">Log in</a></p>
    </div>
    <div class="account-options">
        <a href="urunler.php">Back to the Main Page</a>
    </div>
</form>

            
        <?php endif; ?>     
    </div>
    <?php if (isset($errors['general'])): ?>
        <p style="color: red;"><?= $errors['general'] ?></p>
    <?php endif; ?>
</body>
</html>
