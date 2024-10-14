<?php 

session_start();
include 'includes/foodSorgu.php';



if(isset($_GET['id']))
{
    $user_id = $_SESSION['user_id'];
    $food_id = $_GET['id'];

}
else{
    header("location:viewAllRestaurant.php");
}

$result = SorguID($food_id);
foreach($result as $row)
{
    $rows[]= $row;
}

foreach($rows as $food)
{
    $_SESSION['basket']= [
      //basket tablosu için gerekli olanlar
      //'user_id' => $_SESSION['user_id'],
      //'food_id' => $food['id'],
      'tutar' => $food['price'],
      'indirim' => $food['discount'],
      'restoran_id' => $food['restaurant_id'],


      //frontendde göstermek için ekstralar
      'food_name' => $food['name']

    ];
       
}

if(isset($_POST['save']))
{
    $not =  $_POST['note'];
    $toplam = $_POST['price'];
    $restoran_id = $_SESSION['basket']['restoran_id'];

    //database'e ekleme kısmı

    //$result = $conn->updein("");
    
    $query = "INSERT INTO basket (user_id, food_id, note, quantity) VALUES ('$user_id', '$food_id' , '$not' , '$toplam');";

    $result = $conn->updein($query);

    header("location:viewBasket.php");

}

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
    <title>Sipariş Ver</title>
</head>
<body>

<?= include './includes/NavBar.php';?>

<section class="navbardan-ayır"></section>

<div class="container mt-5">
    <h2 class="text-center">Siparişinizi Tamamlayın</h2>
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
            <!-- Sepetteki ürünler burada listelenecek -->
            <tr>
                <td><?= $_SESSION['basket']['food_name']?></td>
                <td><?= $_SESSION['basket']['tutar']?></td>
                <td><?= $_SESSION['basket']['indirim']?></td>
                <?=  
                  $tutar = $_SESSION['basket']['tutar'];
                  $indirim = $_SESSION['basket']['indirim'];
                  $toplam_tutar = $tutar - $indirim;
                  $_SESSION['basket']['toplam'] = $toplam_tutar;
                ?>
                <td><?= $toplam_tutar ?> </td>
            </tr>
        </tbody>
    </table>
    
    <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noteModalLabel">Not Ekleyin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method='post' id="noteForm" action="" name="noteForm">
                        <div class="form-group">
                            <label for="not">Notunuz:</label>
                            <!-- <textarea class="form-control" name="note" rows="3" placeholder="Notunuzu buraya yazın..."></textarea>-->
                             <input type="text" placeholder="Notunuzu ekleyin..." id="not" name="note">
                             <input type="text" placeholder="Notunuzu ekleyin..." name="price" style="display:none;"
                              value=<?= $_SESSION['basket']['toplam']; ?>>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button class="btn btn-primary" type="submit" name="save" id="saveNote">Kaydet</button>
                </div>
             </form>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary btn-lg btn-block" id="orderButton">Sepete Ekle</button>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.getElementById('orderButton').onclick = function() {
        $('#noteModal').modal('show');
    };

    document.getElementById('saveNote').onclick = function() {
        $('#noteModal').modal('hide');

    };
</script>

</body>
</html>