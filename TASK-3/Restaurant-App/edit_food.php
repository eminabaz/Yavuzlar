<?php
//session_start();
require 'conn.php';

/*if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();}*/

$baglanti = new conn("restaurant_app");


if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    
    $query = "SELECT f.*, r.id AS rest_id, r.name AS rest_name
    FROM restaurant r
    INNER JOIN food f ON f.restaurant_id = r.id WHERE f.id=$id"; 
    $result = $baglanti->select($query);
    foreach ($result as $row) {
        $rows[] = $row;
    }

}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];  
    $desc = $_POST['desc']; 
    $path = $_POST['path']; 
    $price = $_POST['price'];
    $disc = $_POST['disc'];
    
    $query = "UPDATE food SET name='$name', description='$desc', image_path='$path', price='$price', discount='$disc' WHERE id=$id"; 
    $baglanti->updein($query);
    
    header("Location:manage_food.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Yemek Düzenle</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Yemek Düzenle</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <?php foreach($rows as $food) { ?>
                <label for="name" class="form-label">Yemek Adı</label>
                <input type="text" class="form-control" name="name" value="<?= $food['name'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Yemek Açıklaması</label>
                <input type="text" class="form-control" name="desc" value="<?= $food['description'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label"> Fiyat</label>
                <input type="text" class="form-control" name="price" value="<?= $food['price'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label"> İndirim Gir</label>
                <input type="text" class="form-control" name="disc" value="<?= $food['discount']?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Resim Yolu</label>
                <input type="text" class="form-control" name="path" value="<?= $food['image_path'] ?>" required>
            </div>
            <?php } ?>
            <button type="submit" name="submit" class="btn btn-primary">Güncelle</button>
            <a href="manage_food.php" class="btn btn-secondary">İptal</a>
        </form>
    </div>
</body>
</html>