<?php 






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
    


        
    <h2>Siparişlerim</h2>
    <?php if(empty($result)): ?>
    
    <h1>"Siparişiniz Yok."</h1>

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
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <?php } ?>
    <h4 class="mt-3">Toplam: TL</h4>
    <?php endif;?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>