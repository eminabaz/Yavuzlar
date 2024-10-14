<?php
session_start();
require 'conn.php';


/*if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();}*/

$baglanti = new conn("restaurant_app");

$query = "SELECT r.name FROM restaurant r";

$result = $baglanti->select($query);

foreach ($result as $row) {
    $rows[] = $row;
}


if (isset($_POST['submit'])) {
    $name = $_POST['food_name'];  
    $price = $_POST['food_price'];
    $desc = $_POST['food_desc']; 
    $path = $_POST['path']; 

    
    if(isset($_SESSION['admin'])){
    $restoran_name = $_POST['rest_name'];
    $query = "SELECT r.id FROM restaurant r WHERE r.name='$restoran_name'";
    $result = $baglanti->select($query);
    $rest_id = $result[0]['id'];
    $query = "INSERT INTO food (name, price, image_path, description, restaurant_id) VALUES ('$name', '$price', '$path', '$desc' ,'$rest_id')"; 
    $baglanti->updein($query);}

    else{
    $rest_id = $_SESSION['rest_id'];
    $query = "INSERT INTO food (name, price, image_path, description, restaurant_id) VALUES ('$name', '$price', '$path', '$desc' ,'$rest_id')"; 
    $baglanti->updein($query);}
    

    sleep(2);
    
    header("Location:manage_food.php");
}
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
    <title>Yemek Ekle</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Yemek Ekle</h1>
        <form method="POST" action="">
        <div class="mb-3">
                <label for="name" class="form-label">Yemek Adı</label>
                <input type="text" class="form-control" name="food_name" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Fiyat</label>
                <input type="text" class="form-control" name="food_price" required>
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Yemek Açıklaması</label>
                <input type="text" class="form-control" name="food_desc" required>
            </div>
            <div class="mb-3">
                <label for="path" class="form-label">Resim Yolu</label>
                <input type="text" class="form-control" name="path" required>
            </div>
            <?php if(!isset($_SESSION['rest_id'])): ?>
            <label for="sirket">Restoran Seç:</label>
            <div class="mb-3">
            
       <select name="rest_name">
       <?php foreach($rows as $restoran){echo "<option value='". $restoran['name']. "'>". $restoran['name'] . "</option>" ;} ?>
         </select>
            </div>
         <?php endif ?>


            <button type="submit" name="submit" class="btn btn-primary">Ekle</button>
            <a href="manage_food.php" class="btn btn-secondary">İptal</a>
        </form>
    </div>
</body>

<!-- jquery ve bootstrap import-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

<script src="js/script.js"></script>

</html>