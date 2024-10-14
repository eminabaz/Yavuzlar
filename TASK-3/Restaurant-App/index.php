<?php 

include 'process.php';

if(!isset($_SESSION['username']))
{
  header("location:login.php");
}

$restoranlar = $connection->select("SELECT * FROM restaurant");

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
      
  
     





<section class="category">

   <h1 class="title">Restoranlar</h1>

   <div class="box-container">

      <?php foreach($restoranlar as $restoran){
      echo "<a href='viewRestaurant.php?id=". $restoran['id'] ."'class='box'>
         <img src='" . $restoran['image_path']  ."' alt=''>
         <h3>
         ".   $restoran['name'] ."
              
         </h3>
      </a>";   
      }  ?>  
   </div>
   <div class="more-btn">
      <a href="viewAllRestaurant.php" class="btn">Hepsini Görüntüle</a>
   </div>
</section>



<!-- jquery ve bootstrap import-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>


</body>
</html>