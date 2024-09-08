<?php 
include 'imports.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Quiz Uygulamasi</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">

</head>


<body>
<div class="headcontainer">
    <div class="longheader">
        <ul class="userlogin">

           


        </ul>
    </div>
</div>

<div class="discontainer" id="discontainer">
    <div class="soruContainer">
        <h1 id="tebrik">Tebrikler!</h1>
        <h2 id="bilinenAdet">4 Soru içerisinden <?php echo $bilinen_adet; resetDisplay(); ?> Soruyu bildiniz.</h2>
        <h3 id="skor">Skorunuz: <?php echo  $_SESSION['skor']; ?></h3>
         <form method="post" action="play.php">
         <button id="tekrarOyna" name="tekrar" value="tekrarla">Tekrar Oyna</button>
         </form>
    </div>


</body>
</html>