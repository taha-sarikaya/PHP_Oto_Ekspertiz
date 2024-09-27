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
<?php 

 $id=$_GET['id'];


$randevucek = $baglanti -> query("SELECT * FROM randevular WHERE randevu_id = '$id' ");
$cekrandevu = $randevucek->fetch(PDO::FETCH_ASSOC);







?>
    <div class="container">
        <form action="islem.php" method="post">
            <h2>Randevu Al</h2>
            <label for="tarih">Tarih: <?= $cekrandevu['randevu_tarih'] ?></label>
            <input type="date" id="tarih" name="randevu_tarih" required value="<?= $cekrandevu['randevu_tarih'] ?>">

            <label for="saat">Saat: <?= $cekrandevu['randevu_saat'] ?></label>
            <input type="time" id="saat" name="randevu_saat" required value="<?= $cekrandevu['randevu_saat'] ?>">
            
            <label for="ad">Ad:</label>
            <input type="text" id="ad" name="randevu_ad" required  value="<?= $cekrandevu['randevu_ad'] ?>">

            <label for="soyad">Soyad:</label>
            <input type="text" id="soyad" name="randevu_soyad" required  value="<?= $cekrandevu['randevu_soyad'] ?>">

            <label for="plaka">Plaka:</label>
            <input type="text" id="plaka" name="randevu_plaka" required value="<?= $cekrandevu['randevu_plaka'] ?>">

            <label for="brans"> Branşı:</label>
            <select id="doktor" name="randevu_usta" required value="<?= $cekrandevu['randevu_usta'] ?>">
                <option value="Boyama">Boyama</option>
                <option value="Motor">Motor</option>
                <option value="Egzoz">Egzoz</option>

            </select>

            <input type="text" name="randevu_id" value="<?= $id ?>" hidden>

            <button type="submit" name="randevu_guncelle">Randevu Güncelle</button>
        </form>
   

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