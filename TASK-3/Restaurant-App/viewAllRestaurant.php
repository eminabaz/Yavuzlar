<?php

include 'process.php';



$restoranlar = $connection->select("SELECT r.id AS res_id, r.name AS res_name,r.image_path AS res_img ,r.description AS res_desc , c.name AS com_name FROM restaurant r left JOIN company c ON r.company_id = c.id;");

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome importu-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />


   <!-- BootStrap css importu-->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?= include 'includes/NavBar.php';

?>

<div class="appContainer">
<section id="baslik"><h1> Tüm Restoranlar</h1></section>
<?php foreach ($restoranlar as $restoran){
echo "<div class='restaurantContainer'>
   <div class='restoran-bilgi'>
        <div class='image-section'>
            <img src='" . $restoran['res_img'] ."'>
        </div>
        <div class='info-section'>
            <h1>". $restoran['res_name'] ."  Restoranı</h1>
            <h1>Şirket: ". $restoran['com_name'] ."</h1>
        </div>
    </div>
    <section id='mr-btn'><button id='see-menu'><a href='viewRestaurant.php?id=". $restoran['res_id']  ."'> Menüyü Gör</a> </button></section>
    </div>"; }
    
    
    ?>


</div>


<!-- jquery ve bootstrap import-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

<script src="js/script.js"></script>

</html>



