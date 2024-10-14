<!-- NavBar -->

<link href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">


<nav class="navbar navbar-expand-lg fixed-top navbar-light" style="background-color: #2D285D;">
<div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><img src="./img/yavuzlar/navbar-logo.png" width="200" height="auto"></img></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="nav-link active mx-1"><a href="index.php">Ana Sayfa</a></li>
      <?php if (isset($_SESSION['admin']) || isset($_SESSION['rest_id'])): ?>
      <li class="nav-link active mx-1"><a href="adminPanel.php" style='color: red !important;'>Yönetim Paneli</a></li>
      <?php endif ?>
      <li class="nav-link active mx-1"> <a href="viewAllRestaurant.php">Restoranlar</a></li>
      <li class="nav-link active mx-1"> <i class="fa-solid fa-basket-shopping"><a href="viewBasket.php">Sepet</a></i></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      
    <div class="btn-group">
   <button type="button" class="btn btn-secondary"><li><h1 class="nav-link" href="#"><i class="fa-regular fa-user"></i> Profil</h1></li></button> 

  <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">Action</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="logout.php">Çıkış Yap</a>
  </div>
</div>
      </nav>
<!-- NavBar son-->