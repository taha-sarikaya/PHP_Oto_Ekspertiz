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

@$id=$_GET['id'];


$randevucek = $baglanti -> query("SELECT * FROM randevular WHERE randevu_id = '$id' ");
$cekrandevu = $randevucek->fetch(PDO::FETCH_ASSOC);







?>
    <h2>Kullanıcı Bilgileri</h2>
    <span>
                <?php 
                
                                
                if (isset($_GET['durum']) == "ok") {
              
                    echo"Kayıt Başarılı";
                    header("Refresh:2;islemler.php");
                }
                ?>
            </span>
    <div class="container">
        <div class="form-column">
            <h3>Kullanıcı Bilgileri</h3>
            <form action="../islem.php" method="post">
                <label for="randevu_plaka">Plaka:</label>
                <input type="text" id="kullanici_id" name="arac_plaka" value="<?= @$cekrandevu['randevu_plaka'] ?>" ><br><br>

                <label for="arac_islem">İşlem:</label>
                <input type="text" id="arac_islem" name="arac_islem" required ><br><br>
                
                <label for="randevu_tarih">Tarih:</label>
                <input type="text" id="randevu_tarih" name="arac_tarih" value="<?= @$cekrandevu['randevu_tarih'] ?>" required><br><br>
                
                <label for="islem_ucret">Ücret:</label>
                <input type="text" id="islem_ucret" name="arac_ucret"  required><br><br>
                
                <label for="arac_usta">Usta:</label>
                <input type="text" id="arac_usta" name="arac_usta"  required><br><br>
                <input type="text"  name="musteri_id" value="<?= $cekrandevu['kullanici_id'] ?>"  hidden><br><br>
               
                
                <button type="submit" name="arac_islem_Kaydet">Kaydet</button>
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
