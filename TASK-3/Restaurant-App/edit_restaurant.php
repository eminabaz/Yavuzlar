<?php
//session_start();
require 'conn.php';

/*if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();}*/

$baglanti = new conn("restaurant_app");


if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    
    $query = "SELECT r.*, c.id AS company_id, c.name AS company_name
    FROM restaurant r
    INNER JOIN company c ON r.company_id = c.id WHERE r.id=$id"; 
    $result = $baglanti->select($query);
    foreach ($result as $row) {
        $rows[] = $row;
    }

}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];  
    $desc = $_POST['desc']; 
    $path = $_POST['path']; 
    
    $query = "UPDATE restaurant SET name='$name', description='$desc', image_path='$path' WHERE id=$id"; 
    $baglanti->updein($query);
    
    header("Location:manage_restaurants.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Restoran Düzenle</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Restoran Düzenle</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <?php foreach($rows as $restaurant) { ?>
                <label for="name" class="form-label">Restoran Adı</label>
                <input type="text" class="form-control" name="name" value="<?= $restaurant['name'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Restoran Açıklaması</label>
                <input type="text" class="form-control" name="desc" value="<?= $restaurant['description'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Resim Yolu</label>
                <input type="text" class="form-control" name="path" value="<?= $restaurant['image_path'] ?>" required>
            </div>
            <?php } ?>
            <button type="submit" name="submit" class="btn btn-primary">Güncelle</button>
            <a href="manage_restaurants.php" class="btn btn-secondary">İptal</a>
        </form>
    </div>
</body>
</html>