<?php 
include 'database.php'; 

if(isset($_POST['reset']))
{
  dbReset();
}

function dbReset()
{
    global $pdo;


    //kalinan soru id'sinin ilk sorunun idsine eşitlemek için. ilk sorunun id'sini bulma sorguları.
    $sorgu = $pdo->query("SELECT * FROM sorular ORDER BY id ASC LIMIT 1");
    $sorgu->execute();
    $sonuc = $sorgu->fetchAll();
    $ilk_soru_id = $sonuc[0][0];

    $sorgu = $pdo -> query("UPDATE kalinan_log SET kalinan_soru_id='$ilk_soru_id'");
  
    

    header("location: play.php");

}



?>