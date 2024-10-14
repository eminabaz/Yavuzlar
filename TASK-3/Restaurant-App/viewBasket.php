<?php 
session_start();

include 'conn.php';

$baglanti = new conn("restaurant_app");

$user_id = $_SESSION['user_id'];
$query = "SELECT f.id, f.name, f.price, f.discount FROM basket b RIGHT JOIN food f ON b.food_id = f.id WHERE b.user_id = $user_id;";

$result = $baglanti->select($query);

$_SESSION['basket']['toplam_price']=0;
$total = $_SESSION['basket']['toplam_price'];

foreach($result as $row)
{
    $rows[] = $row;
}

if(isset($_POST['give_order']))
{
    $query = "INSERT INTO 0rder (user_id, total_price)
     VALUES ($user_id , $total);";

     $baglanti->updein($query);
     
     header("location:user_orders.php");
     
}

$food_ids[] = [];
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
<?= include './includes/NavBar.php';?>
<section class="navbardan-ayır"></section>
<div class="container mt-5">
    


        
    <h2>Sepetiniz</h2>
    <?php if(empty($result)): ?>
    
    <h1>"Sepetiniz boş."</h1>

    <?php else:?>
    <?php foreach($rows as $food){ ?>
    <table class="table table-striped">
    <thead>
            <tr>
                <th>Ürün Adı</th>
                <th>Fiyat</th>
                <th>İndirim</th>
                <th>Toplam</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?= $food_ids[] = $food['id'];  ?>
                <td><?= $food['name'] ?></td>
                <td><?= $food['price'] ?></td>
                <td><?= $food['discount'] ?></td>
                <?= $toplam_price = $food['price'] - $food['discount'];?>
                <td><?= $toplam_price;?></td>
                <?= $total += $toplam_price;?>

            </tr>
        </tbody>
    </table>
    <?php } ?>
    <h4 class="mt-3">Toplam: <?= $total?> TL</h4>
    <form method="post" >
    <button type="submit" name="give_order" class="btn btn-primary mt-2">Siparişi Ver</button>
    </form>
    <?php endif;?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>