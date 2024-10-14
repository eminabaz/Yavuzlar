<?php 

if(isset($_GET['id']))
{

$id = $_GET['id'];

}

else{
   header("location:viewAllRestaurant.php");
}


include 'process.php';



$result = $connection->select("SELECT r.id AS rest_id, r.name AS rest_name, r.image_path AS rest_img, r.company_id AS c_id, f.* FROM restaurant r LEFT JOIN food f ON r.id = f.restaurant_id WHERE r.id=$id;");
foreach ($result as $row) {
  $rows[] = $row;
}
print_r($result);





?>

<!DOCTYPE html>
<html lang="tr">
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

<section class="navbardan-ayır"></section>
<div class="restaurantContainer">
   <div class="restoran-bilgi">
        <div class="image-section">
            <img src=<?= $result[0]['rest_img']?>>
        </div>
        <div class="info-section">
            <h1><?= $result[0]['rest_name'] ?></h1>
        </div>
    </div>
    <section id="mr-btn" >
        <h1 style="border-bottom: 2px solid black">Lezzetlerimiz</h1>
    </section>

    <?php if(is_null($result[0]['name'])): ?> 
   
      <div class="row yemek">
      <div class="col-md-4">   

        <h1>Görüntülenecek Yemek yok.</h1> 
      </div>
    </div>

    <?php else: ?>
      <div class="foodcontainer restaurantContainer">
    <?php foreach ($rows as $yemek) { ?>
    
    <div class="row">
      <div class="col-md-4">   

        <img src="<?= $yemek['image_path']?>" width="100px" class="img-fluid" alt=""> 
      </div>
      <div class="col-md-5" style="font-size:15px;">
        <h2><?=$yemek['name'] ?></h2>
        <p>Fiyat: <?=$yemek['price'] ?></p>

      </div>
      <div class="col-md-3 text-end">
    <form method="post" action="addBasket.php?id=<?= $yemek['id'] ?>">
    <button name="submit" class="btn btn-success">Sepete Ekle</button>
    </form>
  </div>
    </div>
    <div class="navbardan-ayır">
    </div>
    <?php } ?>
    <?php endif; ?>
  </div>
    </div>
    </div>
   
</body>
