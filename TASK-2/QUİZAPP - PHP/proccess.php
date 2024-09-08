<?php
    
    session_start();

    if(!isset($_SESSION['skor'])){
        $_SESSION['skor'] = 0;
    }


    //güncel soru numarasını bulmak için.
    $sorgu = $pdo->query("SELECT guncel_soru, bilinen_adet FROM kalinan_log");
    $sorgu->execute();
    
    $sonuc = $sorgu->fetchAll();

    $guncelSoruNo = $sonuc[0]['guncel_soru'];

    $bilinen_adet = $sonuc[0]['bilinen_adet'];


if(isset($_POST['secenek']))
{

    $value = $_POST['secenek'];
    cevapKontrol($value);
}



function cevapKontrol($id){
    
   global $pdo, $soru_sayac, $guncelSoruNo, $bilinen_adet;

   $sorgu = $pdo->query("SELECT * FROM cevaplar where id=$id");
   $sorgu -> execute();

   $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
   $bool = $sonuc[0]['dogru_mu'];

   if($bool)
   {  
     $guncelSoruNo++;
     $bilinen_adet++;
     $_SESSION['skor'] += 4;
     $skor = $_SESSION['skor'];
     $user = $_SESSION['user'];

     $sorgu = $pdo->query("UPDATE kalinan_log SET guncel_soru='$guncelSoruNo', bilinen_adet='$bilinen_adet'");
     $sorgu = $pdo->query("UPDATE skorlog SET skor='$skor' WHERE username='$user'");

     //$sorgu -> execute();
   }

   else{
    $guncelSoruNo++;
    
    $sorgu = $pdo->query("UPDATE kalinan_log SET guncel_soru='$guncelSoruNo'");
    //$sorgu->execute();

   }
   
   if($guncelSoruNo>=5)
   {
    header("Location: final.php");
    //yönlendirme yaptıktan sonra html kodu arasında resetDisplay()
    //fonksiyonuna yönlendirecek.
   }

}

function resetDisplay()
{
     global $pdo, $guncelSoruNo, $bilinen_adet;

     $sorgu = $pdo->query("UPDATE kalinan_log SET guncel_soru='1', bilinen_adet='0'");

}

/*function soruSayac()
{
    global $soru_sayac;

    return $soru_sayac++;
}*/

function soruGetir()
 {

    global $pdo, $guncelSoruNo, $bilinen_adet;   

    //Öğrencinin kaldığı sorunun id değeri.
    $id = kalinanBul();
    if ($id > sonSoruIDBul()){
        $guncelSoruNo = 1;
        resetDisplay();
        return "Gösterilecek soru kalmadı. </h2> <form method='post' action='dbReset.php'>
         <button id='next-btn' name='reset'> DB Sıfırla </button> </form> <h2>";

    }
    $sorgu = $pdo->query("SELECT icerik FROM sorular WHERE id=$id");
    
    $sorgu->execute();

    $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    if($sonuc){
    $soruicerik = $sonuc[0]['icerik'];
    }
    else{
        
        while($sonuc){
        kalinanArttir(kalinanBul());
        }

        header("location:play.php");
        return;



    }
  
    //kalinan sorunun id'sini 1 arttırmak için
    //kalinanArttir(kalinanBul());

    return $soruicerik;
    
 }


 function IDsoruGetir($id){
    global $pdo;

    $sorgu = $pdo->query("SELECT * FROM sorular where id='$id'");

    $sorgu->execute();

    $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);

    return $sonuc[0];



 }

 function butunSorularıGetir(){
       global $pdo;

       $sorgu = $pdo->query("SELECT * FROM sorular");
       $sorgu->execute();
      
       $sorular = $sorgu->fetchAll();
       

       for($i=0; $i<sorularAdetBul(); $i++)
       {
           if ($sorular[$i]){
           echo "<div class='soruContainer'><h2>Soru:".  $sorular[$i]['icerik'] . " </h2>
           <div id='secenekler'> <br><form method='post' action=''><button id='sil' name='sil' value='" . $sorular[$i]['id'] . "'>Sil</button>
           <button id='düzenle' name='edit' value='". $sorular[$i]['id']   .  "'>düzenle</button></form></div></div>";       } 
       }
 

    }

//! soruyu silme fonksiyonları 
if(isset($_POST['sil'])){
   $silinecek_id = $_POST['sil'];
   soruyuSil($silinecek_id);
}

function soruyuSil($number){

    global $pdo;

    $sorgu= $pdo->query("DELETE FROM sorular WHERE id=$number");

    $sorgu= $pdo->query("DELETE FROM cevaplar WHERE soru_id=$number");
    

}

//! soruyu düzenleme fonksiyonları

if(isset($_POST['edit']))
{
    $id = $_POST['edit'];
    header("location:edit_q.php?number=".$id);
    
}


function soruyuDüzenle($str, $id)
{
   global $pdo;


   $sorgu = $pdo->query("UPDATE sorular SET icerik='$str' WHERE id='$id'");


}


 function butunSiklariGetir()
 {

   global $pdo;






 }



 function kalinanBul(){
     

    global $pdo;

    $sorgu = $pdo->query("SELECT kalinan_soru_id FROM kalinan_log");

    $sorgu->execute();

    $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);

    $kalinan_soru_id = $sonuc[0]['kalinan_soru_id'];

    return $kalinan_soru_id;
    


 }

 function kalinanArttir(int $kalinan)
 {

    global $pdo;
    
    $kalinan++;

    $sorgu = $pdo->query("UPDATE kalinan_log SET kalinan_soru_id=$kalinan");

    $sorgu->execute();

 }

 function siklarıGetir()
{
  global $pdo;

  $id = kalinanBul();

  if ($id > sonSoruIDBul()){
    return null;
    }

  $sorgu = $pdo->query("SELECT * FROM cevaplar WHERE soru_id=$id");

  $sorgu->execute();

  $siklar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
  

  kalinanArttir(kalinanBul());
 

  return $siklar;
  
}



//Tekrar oyna tuşuna basıldığında
/*if(isset($_POST['tekrar']) && $_POST['tekrar'] == "tekrarla")
{
    $deger = $_POST['tekrar'];
    echo "$deger";

}*/


if(isset($_POST['soruİcerik']))
{
    $secenekler = ["secenek_1", "secenek_2" , "secenek_3", "secenek_4"];
    $kontrol = true;

    foreach ($secenekler as $secenek)
    {
        if(!isset($_POST[$secenek])){
            $kontrol = false;
        }


    }

    if($kontrol){

        soruEkle($_POST);
    }
}

function soruEkle($post) 
{
   global $pdo;
   $icerik = $post['soruİcerik'];  
   $id = sonSoruIDBul();
   $id++;
   //soruyu database'e pushlama kısmı
   $sorgu = $pdo->query("INSERT INTO sorular (icerik,id) VALUES ('$icerik',$id)");

   //şıkları database'e pushlama kısmı
   
   $dogru_secenek = $post['dogruNo'];

   for($i=1; $i<5; $i++)
   {
    $secenek = $post['secenek_'.$i];
    if($i == $dogru_secenek)
    {
        $sorgu = $pdo->query("INSERT INTO cevaplar (soru_id,text,dogru_mu) VALUES ($id,'$secenek',1)");
    }
    else{
    $sorgu = $pdo->query("INSERT INTO cevaplar (soru_id,text,dogru_mu) VALUES ($id,'$secenek',0)");
    }

   }


}



function sorularAdetBul(){  //kaç tane soru olduğunu dönecek
    global $pdo;

    $sorgu = $pdo->query("SELECT COUNT(*) FROM sorular");
    $sorgu->execute();

    $sonuc_id = $sorgu->fetchAll();
    if($sonuc_id){
    return $sonuc_id[0][0];
    }

}

function sonSoruIDBul(){

    global $pdo;

    $son_index = sorularAdetBul();
    if($son_index == 0 ){ //EĞER DATABASE'DE HİÇ SORU YOKSA COUNT 0 DÖNER.
          return 0;
    }
    $sorgu = $pdo->query("SELECT * FROM sorular");
    $sorgu->execute();
      
    $sorular = $sorgu->fetchAll();

    $son_soru_id = $sorular[$son_index-1]['id'];

    return $son_soru_id;




}

?>