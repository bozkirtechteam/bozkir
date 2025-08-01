<?php
$servername = "localhost"; 
$username = "root";       
$password = "27272626";            
$dbname = "bozkir_tekno";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}
?>
