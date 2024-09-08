<?php 
include 'database.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Quiz Uygulamasi</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">

</head>


<body>

    <div class="discontainer" id="discontainer">
    <div class="sorucontainer">

    <h1>Skor Tablosu</h1>
    
   <?php 
    $sorgu = $pdo->query("SELECT username, skor FROM skorlog ORDER BY skor DESC");

    $sorgu->execute();

    $sonuc=$sorgu->fetchAll();

    $i = 1;
    foreach($sonuc as $s)
    {
        echo $i .". kullanıcı adı: " . $s['username']. " -- skoru: ". $s['skor'] . "<br> ";
        $i++;
    }


?>
    </div>  
    
   
    </div>


</body>
</html>



