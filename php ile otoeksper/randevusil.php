<?php 
include("Vt/baglan.php");
if ($_GET) 
{

if ($baglanti->query("DELETE FROM randevular WHERE randevu_id =".(int)$_GET['id'])) 
{
    header("location:randevual.php?durum=silindi"); 
}
}

?>