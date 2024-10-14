<?php
//session_start();
require 'conn.php';

/*if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();}*/

$baglanti = new conn("restaurant_app");

$query = "SELECT c.name FROM company c";

$result = $baglanti->select($query);

foreach ($result as $row) {
    $rows[] = $row;
}


if (isset($_POST['submit'])) {
    $name = $_POST['name'];  
    $desc = $_POST['desc']; 
    $path = $_POST['path']; 
    $sirket_name = $_POST['sirket'];

    $query = "SELECT c.id FROM company c WHERE c.name='$sirket_name'";
    $result = $baglanti->select($query);
    $sirket_id = $result[0]['id'];
    
    $query = "INSERT INTO restaurant (name, description, image_path, company_id) VALUES ('$name', '$desc', '$path', '$sirket_id')"; 
    $baglanti->updein($query);

    sleep(2);
    
    header("Location: manage_restaurants.php");
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
        <h1 class="text-center mb-4">Restoran Ekle</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Restoran Adı</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Restoran Açıklaması</label>
                <input type="text" class="form-control" name="desc" required>
            </div>
            <div class="mb-3">
                <label for="path" class="form-label">Resim Yolu</label>
                <input type="text" class="form-control" name="path" required>
            </div>
            <label for="sirket">Şirket Seç:</label>
            <div class="mb-3">
            
       <select name="sirket">
       <?php foreach($rows as $sirket){echo "<option value='". $sirket['name']. "'>". $sirket['name'] . "</option>" ;} ?>
         </select>
</div>
            <button type="submit" name="submit" class="btn btn-primary">Güncelle</button>
            <a href="manage_restaurants.php" class="btn btn-secondary">İptal</a>
        </form>
    </div>
</body>
</html>