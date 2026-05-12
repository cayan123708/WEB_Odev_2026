<?php
/**
 * Sakarya Üniversitesi - Web Teknolojileri Projesi
 * login.php: Güvenli giriş mekanizması ve doğrulama sayfası
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // HTML formundan gelen verileri al
    $email = $_POST['email'] ?? '';
    $sifre = $_POST['sifre'] ?? '';

    // Ödev yönergesinde belirtilen kriterlere göre tanımlanan bilgiler
    // Örnek numara: b241210020 (Bunu kendi numaranla değiştirebilirsin)
    $dogru_email = "b241210020@sakarya.edu.tr"; 
    $dogru_sifre = "b241210020";

    // 1. Durum: Alanların boş bırakılması kontrolü
    if (empty(trim($email)) || empty(trim($sifre))) {
        // Boş alan hatasıyla geri yönlendir
        header("Location: login.html?hata=bos");
        exit();
    } 
    // 2. Durum: Bilgilerin doğru olması (Başarılı Giriş)
    elseif ($email === $dogru_email && $sifre === $dogru_sifre) {
        // E-posta adresinden @ işaretinden öncesini (öğrenci numarasını) ayıkla
        $ogrenci_no = explode('@', $email)[0];
        
        // Başarı ekranını yazdır
        echo "<!DOCTYPE html>
        <html lang='tr'>
        <head>
            <meta charset='UTF-8'>
            <title>Hoşgeldiniz</title>
            <style>
                body { font-family: Arial, sans-serif; background-color: #f8f8f8; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
                .success-card { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); text-align: center; }
                h1 { color: #28a745; margin-bottom: 20px; }
                p { color: #666; font-size: 1.1em; }
                .btn { display: inline-block; margin-top: 25px; padding: 12px 25px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; transition: background 0.3s; }
                .btn:hover { background-color: #0056b3; }
            </style>
        </head>
        <body>
            <div class='success-card'>
                <h1>Hoşgeldiniz " . htmlspecialchars($ogrenci_no) . "</h1>
                <p>Sisteme başarıyla giriş yaptınız.</p>
                <a href='index.html' class='btn'>Ana Sayfaya Dön</a>
            </div>
        </body>
        </html>";
    } 
    // 3. Durum: Bilgilerin hatalı olması
    else {
        // Hata parametresiyle login sayfasına geri yönlendir
        header("Location: login.html?hata=yanlis");
        exit();
    }
} else {
    // Sayfaya doğrudan (POST dışı) erişim sağlanırsa login sayfasına yönlendir
    header("Location: login.html");
    exit();
}
?>