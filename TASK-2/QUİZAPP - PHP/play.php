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


        <li>
    
                 <a href=  "scoreboard.php"> SCOREBOARD  </a>     

        </li> 


    </ul>
    </div>
    </div>

    <div class="discontainer" id="discontainer">
    <div class="sorucontainer">
    <h1 id="soruno"><?php echo $guncelSoruNo?> .Soru</h1>
    <h2 id="soruicerik"><?php echo soruGetir(); ?></h2>


    <div class="cevapbutonlari">
        <form method="post" action="play.php">
            <?php 
            $siklar = siklarıGetir();

            if($siklar){
            for($c=0; $c<4; $c++){
            echo "<input type='radio' name='secenek' value='". $siklar[$c]['id'] ."'> <button class='btn' disabled>" . $siklar[$c]['text'] ."</button> </input> </br>"; 
            }}
            ?>
            
        </br>
            <button id="next-btn" name="gec">next</button>
        </form>
    </div>
    </div>


</body>
</html>


