<?php
//session_start();
require 'conn.php';
$baglanti = new conn("restaurant_app");

/*if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}*/
 
//restoran tablosundaki tüm sonuçlar
$query = "SELECT r.*, c.id AS company_id, c.name AS company_name
FROM restaurant r
INNER JOIN company c ON r.company_id = c.id WHERE r.deleted_at IS NULL";  
$result = $baglanti->select($query);  
foreach ($result as $row) {
    $rows[] = $row; 
}



$aranacak = '';
if (isset($_POST['search'])) {
    $rows = [];
    $aranacak = $_POST['search'];
    $query = "SELECT r.*, c.id AS company_id, c.name AS company_name
    FROM restaurant r
    INNER JOIN company c ON r.company_id = c.id WHERE r.name LIKE '%$aranacak%' AND r.deleted_at IS NULL;";  
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
    <title>Restoran Yönetimi</title>
</head>
<!-- Restoran Arama kısmı -->
<form method="POST" class="mb-4">
            <h4>Restoran Ara</h4>
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Restoran adı ile ara" value="<?= $aranacak ?>">
                <button class="btn btn-primary" type="submit">Ara</button>
            </div>
        </form>

        <a href="add_restaurant.php" class="btn btn-success mb-3">Restoran Ekle</a>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Restoranlar</h1>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Restoran ID</th>
                    <th>İsim</th>
                    <th>Şirket ID</th>
                    <th>Şirket İsmi</th>
                    <th>Açıklama</th>
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
                <?php foreach ($rows as $restaurant) { ?>
                <tr>
                    <td><?= $restaurant['id'] ?></td>
                    <td><?= $restaurant['name'] ?></td>
                    <td><?= $restaurant['company_id'] ?></td>
                    <td><?= $restaurant['company_name'] ?></td>
                    <td><?= $restaurant['description'] ?></td>
                    <td><?= $restaurant['created_at'] ?></td>
                    <td>
                        <a href="delete_restaurant.php?id=<?= $restaurant['id'] ?>" class="btn btn-danger btn-sm">Sil</a>
                        <a href="edit_restaurant.php?id=<?= $restaurant['id'] ?>" class="btn btn-warning btn-sm">Düzenle</a>
                    </td>
                </tr>
                <?php } ?>
                <?php endif;?>
            </tbody>
        </table>
    </div>
</body>
</html>