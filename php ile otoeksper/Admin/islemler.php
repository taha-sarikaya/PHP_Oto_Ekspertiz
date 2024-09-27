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
    <title>Kullanıcı Bilgileri ve İşlemler</title>
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
            display: flex;
            justify-content: space-between;
            width: 80%;
            margin-top: 20px;
        }
        .form-column {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 10px;
            width: 100%;
            text-align: center;
        }
        h2 {
            text-align: center;
            color: #4d4dff;
            margin-top: 20px;
        }
        h3 {
            text-align: center;
            color: #333;
        }
        label {
            color: #6666ff;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        th.plaka, td.plaka {
            width: 15%;
        }
        th.tarih, td.tarih {
            width: 25%;
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




$aracislem = $baglanti -> query("SELECT * FROM aracislemler ");
$islem = $aracislem->fetchAll(PDO::FETCH_ASSOC);







?>
    <h2>Araç İşlemler</h2>
    <div class="container">
        
        <div class="form-column">
            <h3>Yapılan İşlemler</h3>
            <table>
                <thead>
                    <tr>
                        <th class="plaka">Plaka</th>
                        <th>İşlem</th>
                        <th class="tarih">Tarih</th>
                        <th>Ücret</th>
                        <th>Usta</th>
                    </tr>
                </thead>
                <tbody>
                <?php  foreach ($islem as $aracCek_islem) { ?>
                    <tr>
                        <td class="plaka"><?= $aracCek_islem['arac_plaka'] ?></td>
                        <td><?= $aracCek_islem['arac_islem'] ?></td>
                        <td class="tarih"><?= $aracCek_islem['arac_tarih'] ?></td>
                        <td><?= $aracCek_islem['arac_ucret'] ?> ₺</td>
                        <td><?= $aracCek_islem['arac_usta'] ?></td>
                    </tr>
                    <?php } ?>
                  
                </tbody>
            </table>
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
