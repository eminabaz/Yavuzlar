<?php include 'imports.php'?>
<!DOCTYPE html>
<html>

<head>
 <title>Soru Yönetim Paneli</title>
 <link rel="stylesheet" href="style.css">
</head>


<body>
<div class="manageApp" id="manage">
<h1>Soru Yönetim Paneli</h1>
<button id="manageAppButton" onclick="reload()">Yenile</button>
<button id="manageAppButton" onclick="location.href='play.php'">Soru Getir</button>
<div class="searchBox">
    <input type="text" id="search" placeholder="Soru İçeriğini Yazın..." onkeypress="aramaYap()">
    <button onclick="aramaYap()">Ara</button>
    <br>
    <button onclick="window.location.href = 'add.php'">Soru Ekle</button>
</div>
<div class="sorularContainer" id="sorucont">
<?php butunSorularıGetir(); ?>
</div>

</div>


<script src="edit_scripts.js"></script>
</body>

</html>