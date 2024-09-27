<?php 

include 'Vt/baglan.php';


$kullanicisor = $baglanti -> prepare('SELECT * FROM kullanicilar WHERE kullanici_mail=:kullanici_mail and kullanici_yetki = 2');
$kullanicisor -> execute([

      'kullanici_mail' => $_SESSION['kullanici_mail']

]);


$say = $kullanicisor -> rowCount();
$kullanicicek = $kullanicisor -> fetch(PDO::FETCH_ASSOC);

if ($say == 0) {


  header('location:index.php?izinsizgiris');

  exit;
}





?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Randevu Sistemi</title>
    <style>
    body {
        background-color: #f2f2f2;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 100vh;
    }

    .container {
        width: 80%;
        margin-top: 20px;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    form h2 {
        color: #4d4dff;
        margin-bottom: 20px;
    }

    form label {
        display: block;
        margin-bottom: 5px;
        color: #333;
    }

    form input[type="text"],
    form input[type="date"],
    form input[type="time"],
    form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    form button[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #4d4dff;
        color: #fff;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    form button[type="submit"]:hover {
        background-color: #2fa8d4;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    th,
    td {
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    th {
        background-color: #4d4dff;
        color: #fff;
        text-align: left;
    }

    tr:hover {
        background-color: #f2f2f2;
    }

    footer {
        margin-top: auto;
        background-color: #afaff6;
        padding: 10px;
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
        display: inline-block;
        margin: 0 10px;
    }

    .contact-item a {
        text-decoration: none;
        color: #333;
        margin-left: 5px;
    }

    .contact-item a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="container">
        <form action="islem.php" method="post">
            <h2>Randevu Al</h2> <span>
                <?php 
                
                if (isset($_GET['durum']) && $_GET['durum'] == 'randevuok') {
              
                    echo"Kayıt Oluşturuldu";
                    header("Refresh:2;randevual.php");
                    exit;
                }  

                if (isset($_GET['durum']) && $_GET['durum'] == 'silindi') {
              
                    echo"Randevu silindi";
                    header("Refresh:2;randevual.php");
                    exit;
                }
              
                ?>
            </span>
            <label for="tarih">Tarih:</label>
            <input type="date" id="tarih" name="randevu_tarih" required>

            <label for="saat">Saat:</label>
            <input type="time" id="saat" name="randevu_saat" required>

            <label for="ad">Ad:</label>
            <input type="text" id="ad" name="randevu_ad" required value="<?= $kullanicicek['kullanici_ad'] ?>">

            <label for="soyad">Soyad:</label>
            <input type="text" id="soyad" name="randevu_soyad" required value="<?= $kullanicicek['kullanici_soyad'] ?>">

            <label for="plaka">Plaka:</label>
            <input type="text" id="plaka" name="randevu_plaka" required>

            <label for="brans"> Branşı:</label>
            <select id="doktor" name="randevu_usta" required>
                <option value="Boyama">Boyama</option>
                <option value="Motor">Motor</option>
                <option value="Egzoz">Egzoz</option>

            </select>

            <input type="text" name="kullanici_id" value="<?= $kullanicicek['kullanici_id'] ?>" hidden>

            <button type="submit" name="randevu_al">Randevu Al</button>
        </form>
        <?php 

$id=$kullanicicek['kullanici_id'];


$randevucek = $baglanti -> query("SELECT * FROM randevular WHERE kullanici_id = '$id' ");
$cekrandevu = $randevucek->fetchAll(PDO::FETCH_ASSOC);







?>
        <table>
            <thead>
                <tr>
                    <th>Randevu Tarihi</th>
                    <th>Randevu Saati</th>
                    <th>Müşteri Adı</th>
                    <th>Müşteri Soyadı</th>
                    <th>Plaka</th>                    
                    <th>İşlem</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php

foreach ($cekrandevu as $randevukayitGoster) { ?>
 

                <tr>
                    <td><?= $randevukayitGoster['randevu_tarih'] ?></td>
                    <td><?= $randevukayitGoster['randevu_saat'] ?></td>
                    <td><?= $randevukayitGoster['randevu_ad'] ?></td>
                    <td><?= $randevukayitGoster['randevu_soyad'] ?></td>
                    <td><?= $randevukayitGoster['randevu_plaka'] ?></td>
                    <td><?= $randevukayitGoster['randevu_usta'] ?></td>                    
                    <td>
                        <a href="randevuguncelle.php?id=<?= $randevukayitGoster['randevu_id'] ?>">Güncelle</a>
                        <a href="randevusil.php?id=<?= $randevukayitGoster['randevu_id'] ?>">İptal Et</a>
                        
                    </td>
                </tr>
                <?php }
?>
            </tbody>
        </table>

        <br>
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
        <!-- Diğer randevular buraya ekl