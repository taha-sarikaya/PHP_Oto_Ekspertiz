<?php 

include 'Vt/baglan.php';






if (isset($_POST['kullaniciKayit'])) {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    $kullanici_mail = $_POST['kullanici_mail'];
    $kullanici_ad = $_POST['kullanici_ad'];
    $kullanici_soyad = $_POST['kullanici_soyad'];
    $kullanici_sifre	 = $_POST['kullanici_sifre'];
    $kullanici_sifretekrar = $_POST['kullanici_sifretekrar'];

if ($kullanici_sifre != $kullanici_sifretekrar) {
    echo "hata";
}else {
    if (!$kullanici_mail || !$kullanici_ad || !$kullanici_soyad || !$kullanici_sifre) {
        echo "boş";
    }else {
        $kayitEkle = $baglanti->prepare('INSERT INTO kullanicilar SET
    
    
    kullanici_mail=?,    
        
    kullanici_ad=?,    
        
    kullanici_soyad=?,
        
    kullanici_sifre=?     
        ');
    
    
                    $kaydet = $kayitEkle->execute([
    
                        $kullanici_mail, $kullanici_ad, $kullanici_soyad, $kullanici_sifre
    
                    ]);

                    if ($kaydet) {
                      header("Location:index.php?durum=ok");
                    }
    
    }
}



}

// Müşteri randevu başlangıç

if (isset($_POST['randevu_al'])) {
//    echo "<pre>";
//     print_r($_POST);
//     echo "</pre>";
//     exit;
    $randevu_tarih = $_POST['randevu_tarih'];
    $randevu_saat = $_POST['randevu_saat'];
    $randevu_ad = $_POST['randevu_ad'];
    $randevu_soyad = $_POST['randevu_soyad'];
    $randevu_plaka	 = $_POST['randevu_plaka'];
    $randevu_usta = $_POST['randevu_usta'];
    $kullanici_id = $_POST['kullanici_id'];


    if (!$randevu_tarih || !$randevu_saat || !$randevu_ad || !$randevu_soyad || !$randevu_plaka || !$randevu_usta ) {
        echo "boş";
    }else {
        $kayitEkle = $baglanti->prepare('INSERT INTO randevular SET
    
    
    randevu_tarih=?, 

    randevu_saat =?,   
        
    randevu_ad=?,    
        
    randevu_soyad=?,
        
    randevu_plaka=?,  

    randevu_usta=?,    
        
    kullanici_id=?   
        ');
    
    
                    $kaydet = $kayitEkle->execute([
    
                        $randevu_tarih, $randevu_saat, $randevu_ad, $randevu_soyad, $randevu_plaka ,$randevu_usta ,$kullanici_id
    
                    ]);

                    if ($kaydet) {
                      header("Location:randevual.php?durum=randevuok");
                    }
    
    }




}
// Müşteri randevu guncelle

if (isset($_POST['randevu_guncelle'])) {

  
    $randevu_tarih = $_POST['randevu_tarih'];
    $randevu_saat = $_POST['randevu_saat'];
    $randevu_ad = $_POST['randevu_ad'];
    $randevu_soyad = $_POST['randevu_soyad'];
    $randevu_plaka	 = $_POST['randevu_plaka'];
    $randevu_usta = $_POST['randevu_usta'];
    $randevu_id = $_POST['randevu_id'];
    if ($baglanti->query("UPDATE randevular SET randevu_tarih = '$randevu_tarih', randevu_saat =  '$randevu_saat', randevu_ad ='$randevu_ad', randevu_soyad = '$randevu_soyad',randevu_plaka = '$randevu_plaka' ,randevu_usta='$randevu_usta' WHERE randevu_id =".$randevu_id)) 
    {
        header("location:randevual.php?durum=randevuguncel");
      
    }




}






// admin işlem ekleme 

if (isset($_POST['arac_islem_Kaydet'])) {
    //    echo "<pre>";
    //     print_r($_POST);
    //     echo "</pre>";
    //     exit;
        $randevu_plaka = $_POST['arac_plaka'];
        $arac_islem = $_POST['arac_islem'];
        $randevu_tarih = $_POST['arac_tarih'];
        $islem_ucret = $_POST['arac_ucret'];
        $arac_usta	 = $_POST['arac_usta'];
        $musteri_id = $_POST['musteri_id'];
        
    
    
        if (!$randevu_plaka || !$arac_islem || !$randevu_tarih || !$islem_ucret || !$arac_usta  ) {
            echo "boş";
        }else {
            $kayitEkle = $baglanti->prepare('INSERT INTO aracislemler SET
        
        
        arac_plaka=?, 
    
        arac_islem =?,   
            
        arac_tarih=?,    
            
        arac_ucret=?,
            
        arac_usta=?,
              
        kullanici_id=?   
            ');
        
        
                        $kaydet = $kayitEkle->execute([
        
                            $randevu_plaka, $arac_islem, $randevu_tarih, $islem_ucret, $arac_usta ,$musteri_id
        
                        ]);
    
                        if ($kaydet) {
                          header("Location:admin/aracislem.php?durum=ok");
                        }
        
        }
    
    
    
    
    }

































?>