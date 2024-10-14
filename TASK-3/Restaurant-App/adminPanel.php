<?php 
session_start();

$admin= 0;
if(isset($_SESSION['admin']))
$admin = $_SESSION['admin'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Paneli</title>
</head>


<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Admin Paneline Hoş Geldiniz</h1>
        <nav class="nav justify-content-center">
            <?php if($admin == 1): ?>
            <a class="nav-link btn btn-primary m-1" href="manage_restaurants.php">Restoran Yönetimi</a>
            <a class="nav-link btn btn-primary m-1" href="manage_coupons.php">Kupon Yönetimi</a>
            <a class="nav-link btn btn-primary m-1" href="manage_companies.php">Firma Yönetimi</a>
            <a class="nav-link btn btn-primary m-1" href="manage_customers.php">Müşteri Yönetimi</a>
            <?php endif?>
            <a class="nav-link btn btn-primary m-1" href="manage_food.php">Yemek Yönetimi</a>
            <a class="nav-link btn btn-primary m-1" href="manage_food.php">Sipariş Yönetimi</a>
            <br>
            <a class="nav-link btn btn-primary m-1" href="index.php">Geri Dön</a>
        </nav>
    </div>
</body>
</html>