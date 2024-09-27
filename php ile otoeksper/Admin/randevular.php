<?php 

include '../Vt/baglan.php';


$kullanicisor = $baglanti -> prepare('SELECT * FROM kullanicilar WHERE kullanici_mail=:kullanici_mail');
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
    footer {
        position: fixed;
        bottom: 10px;
        left: 10px;
        right: 10px;
        background-color: #afaff6;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

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

    table {
        width: 80%;
        margin-top: 20px;
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
    </style>
</head>

<body>
    <h2> RANDEVULAR </h2>
    <?php 




$randevucek = $baglanti -> query("SELECT * FROM randevular");
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
                <th> Branşı</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <?php  foreach ($cekrandevu as $randevukayitGoster) { ?>
            <tr>
                <td><?= $randevukayitGoster['randevu_tarih'] ?></td>
                <td><?= $randevukayitGoster['randevu_saat'] ?></td>
                <td><?= $randevukayitGoster['randevu_ad'] ?></td>
                <td><?= $randevukayitGoster['randevu_soyad'] ?></td>
                <td><?= $randevukayitGoster['randevu_plaka'] ?></td>
                <td><?= $randevukayitGoster['randevu_usta'] ?></td>
                <td>
                   
                    <a href="aracislem.php?id=<?= $randevukayitGoster['randevu_id'] ?>">işlem Yap</a>
                </td>
            </tr>
            <?php  } ?>

            <!-- Diğer randevular buraya eklenebilir -->
        </tbody>
    </table>
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