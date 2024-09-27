<?php 

include '../Vt/baglan.php';


$kullanicisor = $baglanti -> prepare('SELECT * FROM kullanicilar WHERE kullanici_mail=:kullanici_mail and kullanici_yetki = 1');
$kullanicisor -> execute([

      'kullanici_mail' => $_SESSION['kullanici_mail']

]);


$say = $kullanicisor -> rowCount();
$kullanicicek = $kullanicisor -> fetch(PDO::FETCH_ASSOC);

if ($say == 0) {


  header('location:../index.php?izinsizgiris');

  exit;
}





?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetici Platformu</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #0000ac, #6666ff);
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #ffffff;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .container {
            display: flex;
            width: 80%;
            height: 50%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            border-radius: 40px;
            overflow: hidden;
            background-color: #ffffff;
        }

        .section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background-color 0.3s ease;
            background-size: cover;
            background-position: center;
            border-right: 1px solid #ccc;
        }

        .section:last-child {
            border-right: none; /* Son bölümün sağ kenarını kaldır */
        }

        .section:hover {
            background-color: rgba(255, 255, 255, 0.7);
        }

        .section-randevular {
            background-image: url('as.jpg'); /* Randevuları Göster bölümü arka plan resmi */
        }

        .section-islemler {
            background-image: url('islemler.jpg'); /* İşlemler bölümü arka plan resmi */
        }

        .section-kullanici {
            background-image: url('kullanici.jpg'); /* Kullanıcı Bilgileri Düzenle bölümü arka plan resmi */
        }

        .action-button {
            padding: 15px 30px; /* Butonun boyutlarını ayarla */
            font-size: 18px; /* Yazı boyutunu ayarla */
            color: #ffffff;
            background-color: #3333ff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .action-button:hover {
            background-color: #04044d;
            transform: translateY(-3px);
        }
        .cikis span a{
            color: white;
            font-size: 25px;
            text-decoration: none;

        }
        .cikis span a:hover{
      
          background-color: #3333ff;
          color: red;
          font-size: 35px;

        }
    </style>
</head>
<body>
<div class="cikis"><span><a href="exit.php">Çıkış Yap</a></span></div>
    <h1>Lütfen bir adım seçiniz: <?php echo $kullanicicek['kullanici_ad'] ." ". $kullanicicek['kullanici_soyad']  ?></h1>
    <div class="container">
    
        <div class="section section-randevular">
       
            <button class="action-button" onclick="window.location.href='randevular.php'">Randevuları Göster</button>
        </div>
        <div class="section section-islemler">
            <button class="action-button" onclick="window.location.href='islemler.php'">İşlemler</button>
        </div>
        <!-- <div class="section section-kullanici">
            <button class="action-button" onclick="window.location.href='kullanici.html'">Kullanıcı Bilgilerini Düzenle</button>
        </div> -->
    </div>
</body>
</html>
