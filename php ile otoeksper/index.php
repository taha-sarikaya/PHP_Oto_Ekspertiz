<?php 
include 'Vt/baglan.php';
      ob_start();
       ?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarıkaya Otoekspertiz Sistemi</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

    body {
        background-color: #f9fafb;
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 100vh;
        color: #333;
    }

    .header {
        margin-top: 100px;
        text-align: center;
    }

    h2 {
        color: #333;
        font-size: 2.5em;
        font-weight: 700;
    }

    .note {
        color: #555;
        margin-bottom: 30px;
        font-size: 1.2em;
    }

    .container {
        display: flex;
        justify-content: space-between;
        width: 80%;
        max-width: 1000px;
        margin-top: 20px;
    }

    .form-column {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 10px;
        width: 45%;
        text-align: center;
    }

    h3 {
        text-align: center;
        color: #333;
        font-size: 1.5em;
        margin-bottom: 20px;
        font-weight: 500;
    }

    label {
        color: #007bff;
        display: block;
        margin-bottom: 10px;
        font-size: 1em;
        text-align: left;
        font-weight: 500;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 1em;
    }

    button[type="submit"] {
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        font-size: 1em;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    .new-user {
        display: block;
        margin-top: 20px;
        color: #28a745;
        text-decoration: none;
        font-size: 1em;
        font-weight: 500;
    }

    .new-user:hover {
        text-decoration: underline;
    }

    footer {
        margin-top: auto;
        background-color: #afaff6;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 1em;
        width: 100%;
    }

    .contact-item {
        display: flex;
        align-items: center;
    }

    .contact-item a {
        text-decoration: none;
        color: #007bff;
        margin-left: 5px;
        font-weight: 500;
    }

    .contact-item a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .container {
            flex-direction: column;
            align-items: center;
        }

        .form-column {
            width: 80%;
            margin-bottom: 20px;
        }
    }
    </style>
</head>

<body>
    <div class="header">
        <h2>Sarıkaya Otoekspertiz Sistemi</h2>
        <div class="note">Lütfen size ait alanları doldurunuz</div>
    </div>
    <div class="container">
        <div class="form-column">
            <h3>Kullanıcı Girişi</h3>
            <span>
                <?php 
                
                                
                if (isset($_GET['durum']) == "ok") {
              
                    echo"Kayıt Başarılı";
                    header("Refresh:2;index.php");
                }
                ?>
            </span>
            <form action="" method="post">
                <label for="kullanici_mail">Kullanıcı Mail:</label>
                <input type="text" id="kullanici_mail" name="kullanici_mail" required>

                <label for="kullanici_sifre">Şifre:</label>
                <input type="password" id="kullanici_sifre" name="kullanici_sifre" required>

                <button type="submit" name="kullanici_giris">Giriş</button>
                <?php 
                
                if (isset($_POST['kullanici_giris'])) {
                    $mail = $_POST['kullanici_mail'];
                    $sifre = $_POST['kullanici_sifre'];
                    
                            $kullanicicek = $baglanti -> prepare('SELECT * FROM kullanicilar WHERE kullanici_mail=:kullanici_mail and kullanici_sifre=:kullanici_sifre and kullanici_yetki = 2 ' );
                            $kullanicicek -> execute([
                            'kullanici_mail' => $mail,
                            'kullanici_sifre'=>$sifre
                    
                            ]);
                    
                    $say =$kullanicicek ->rowCount();
                    if ($say == 1) {
                       
                        $_SESSION['kullanici_mail']=$mail;
                    
                        header('location:anasayfa.php?girisbasarili');
                        exit;
                    
                    }
                    else {
                        header('location:index.php?giris=hatali');
                        exit;
                    }
                    
                    }
                    
                
                
                ?>
            </form>
            <a class="new-user" href="kayit.html">Yeni üye olmak için tıklayın</a>
        </div>
        <div class="form-column">
            <h3>Yönetici Girişi</h3>
            <form action="" method="post">
                <label for="kullanici_mail">Yönetici Mail:</label>
                <input type="text" id="kullanici_mail" name="kullanici_mail" required>

                <label for="kullanici_sifre">Şifre:</label>
                <input type="password" id="kullanici_sifre" name="kullanici_sifre" required>

                <button type="submit" name="adminGiris">Giriş</button>
                <?php 
                
                if (isset($_POST['adminGiris'])) {
                    $mail = $_POST['kullanici_mail'];
                    $sifre = $_POST['kullanici_sifre'];
                    
                            $kullanicicek = $baglanti -> prepare('SELECT * FROM kullanicilar WHERE kullanici_mail=:kullanici_mail and kullanici_sifre=:kullanici_sifre and kullanici_yetki = 1 ' );
                            $kullanicicek -> execute([
                            'kullanici_mail' => $mail,
                            'kullanici_sifre'=>$sifre
                    
                            ]);
                    
                    $say =$kullanicicek ->rowCount();
                    if ($say == 1) {
                       
                        $_SESSION['kullanici_mail']=$mail;
                    
                        header('location:admin/anasayfa.php?girisbasarili');
                        exit;
                    
                    }
                    else {
                        header('location:index.php?giris=hatali');
                        exit;
                    }
                    
                    }
                    
                
                
                ?>
            </form>
        </div>
    </div>
    <footer>
        <div class="contact-item">
            <span>📞</span>
            <a href="tel:+905555555555">İletişim</a>
        </div>
        <div class="contact-item">
            <span>✉️</span>
            <a href="mailto:info@example.com">Mail</a>
        </div>
        <div class="contact-item">
            <span>🏠</span>
            <a href="hakkimizda.html">Hakkımızda</a>
        </div>
    </footer>
</body>

</html>