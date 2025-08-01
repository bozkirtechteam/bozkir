<?php
session_start();
include("config.php");  

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$isim = $conn->real_escape_string($_POST['isim']);
$soyisim = $conn->real_escape_string($_POST['soyisim']);
$firma = $conn->real_escape_string($_POST['firma']);
$email = $conn->real_escape_string($_POST['email']);
$telefon = $conn->real_escape_string($_POST['telefon']);
$mesaj = $conn->real_escape_string($_POST['mesaj']);


$sql = "INSERT INTO TblSponsorlar (isim, soyisim, firma, email, telefon, mesaj) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL prepare hatası: " . $conn->error);
}

$stmt->bind_param("ssssss", $isim, $soyisim, $firma, $email, $telefon, $mesaj);

if ($stmt->execute()) {
    // Mail gönderimi
    $to = "bozkirtechteam@gmail.com";
    $subject = "Yeni Sponsor Başvurusu";
    $mailMessage = "
Yeni bir sponsor başvurusu alındı:

İsim: $isim
Soyisim: $soyisim
Firma: $firma
E-posta: $email
Telefon: $telefon
Mesaj: $mesaj
";
    $headers = "From: iletisim@bozkirteknoloji.com.tr\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $mailMessage, $headers)) {
        echo "Başvuru kaydedildi ve e-posta gönderildi.";
    } else {
        echo "Başvuru kaydedildi ancak e-posta gönderilemedi.";
    }

} else {
    echo "Veritabanı hatası (execute): " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
