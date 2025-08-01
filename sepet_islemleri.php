<?php
session_start();
include 'config.php';

// Oturum kontrolü
if (!isset($_SESSION['musteri_id'])) {
    header("Location: giris.php");
    exit();
}

// İşlem kontrolü
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $islem = $_POST['islem']; // Örneğin: "ekle", "sil", "guncelle"
    $urun_id = isset($_POST['urun_id']) ? intval($_POST['urun_id']) : 0;

    if ($islem === 'ekle' && $urun_id > 0) {
        $musteri_id = $_SESSION['musteri_id'];

        // Ürün sepette mi kontrol et
        $check_query = "SELECT * FROM sepet WHERE musteri_id = ? AND urun_id = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("ii", $musteri_id, $urun_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            // Ürün zaten varsa, miktar artır
            $update_query = "UPDATE sepet SET adet = adet + 1 WHERE musteri_id = ? AND urun_id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("ii", $musteri_id, $urun_id);
            $update_stmt->execute();
            $update_stmt->close();
        } else {
            // Yeni ürün ekle
            $insert_query = "INSERT INTO sepet (musteri_id, urun_id, adet) VALUES (?, ?, 1)";
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bind_param("ii", $musteri_id, $urun_id);
            $insert_stmt->execute();
            $insert_stmt->close();
        }

        $check_stmt->close();
        echo json_encode(['status' => 'success', 'message' => 'Ürün sepete eklendi']);
    } elseif ($islem === 'sil' && $urun_id > 0) {
        // Ürünü sepetten sil
        $delete_query = "DELETE FROM sepet WHERE musteri_id = ? AND urun_id = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param("ii", $_SESSION['musteri_id'], $urun_id);
        $delete_stmt->execute();
        $delete_stmt->close();

        echo json_encode(['status' => 'success', 'message' => 'Ürün sepetten silindi']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Geçersiz işlem']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Geçersiz istek']);
}
?>
