<?php
session_start();
require 'conn.php';
$baglanti = new conn("restaurant_app");



/*if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}*/
 

$query = "SELECT f.*, r.id AS rest_id, r.name AS rest_name
FROM restaurant r
INNER JOIN food f ON r.id = f.restaurant_id AND f.deleted_at IS NULL";  
if(isset($_SESSION['rest_id']))
{
   $rest_id = $_SESSION['rest_id'];
   $query .= " AND restaurant_id=$rest_id;";

}
$result = $baglanti->select($query);  
foreach ($result as $row) {
    $rows[] = $row; 
}



$aranacak = '';
if (isset($_POST['search'])) {
    $rows = [];
    $aranacak = $_POST['search'];
    $query = "SELECT f.*, r.id AS rest_id, r.name AS rest_name
FROM restaurant r
INNER JOIN food f ON r.id = f.restaurant_id WHERE f.name LIKE '%$aranacak%' AND f.deleted_at IS NULL";  
if(isset($_SESSION['rest_id']))
{
   $rest_id = $_SESSION['rest_id'];
   $query .= " AND restaurant_id=$rest_id;";
}

    $result = $baglanti->select($query);  
    foreach ($result as $row) {
        $rows[] = $row;
    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Yemek Yönetimi</title>
</head>
<!-- Restoran Arama kısmı -->
<form method="POST" class="mb-4">
            <h4>Yemek Ara</h4>
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Yemek adı ile ara" value="<?= $aranacak ?>">
                <button class="btn btn-primary" type="submit">Ara</button>
            </div>
        </form>

        <a href="add_food.php" class="btn btn-success mb-3">Yemek Ekle</a>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Yemekler</h1>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Restoran ID</th>
                    <th>Yemek ID </th>
                    <th>İsim</th>
                    <th>Restoran İsmi</th>
                    <th>Fiyat</th>
                    <th>İndirim</th>
                    <th>Oluşturulma</th>
                    <th>Aksiyonlar</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($rows)):?>
                    <tr>
                        <td colspan="4" class="text-center">Sonuç bulunamadı.</td>
                    </tr>

                <?php else: ?>
                <?php foreach ($rows as $food) { ?>
                <tr>
                    <td><?= $food['rest_id'] ?></td>
                    <td><?= $food['id'] ?></td>
                    <td><?= $food['name'] ?></td>
                    <td><?= $food['rest_name'] ?></td>
                    <td><?= $food['price'] ?></td>
                    <td><?= $food['discount'] ?></td>
                    <td><?= $food['created_at'] ?></td>
                    <td>
                        <a href="delete_food.php?id=<?= $food['id'] ?>" class="btn btn-danger btn-sm">Sil</a>
                        <a href="edit_food.php?id=<?= $food['id'] ?>" class="btn btn-warning btn-sm">Düzenle</a>
                    </td>
                </tr>
                <?php } ?>
                <?php endif;?>
            </tbody>
        </table>
    </div>
</body>
</html>