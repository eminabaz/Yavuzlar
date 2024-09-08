<?php 
include 'imports.php' ?>
<!DOCTYPE html>
<html>

<head>
    <title>Soru Ekleme Paneli</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
</head>

<body>



 <div class="appContainer"> 
    <h1>Soru Ekleme Formu</h1>
  <div class="formContainer">
      <form method="post" id="sorueklemeformu" action="">

      <h2>Soru içeriğini Girin. </h2>
      <input type="text" id="soruİcerik" name="soruİcerik" required>
      <br>
      <br>

      </select>
      <h2>Şıkları Girin.</h2>
          <label>Seçenek 1: </label>
      <input class="siklar" type="text" name="secenek_1" required>
          <label>Seçenek 2: </label>
      <input class="siklar" type="text" name="secenek_2" required>
          <label>Seçenek 3: </label>
      <input class="siklar" type="text" name="secenek_3" required>
          <label>Seçenek 4: </label>
      <input class="siklar" type="text" name="secenek_4" required>
          <br>
          <label>Doğru Seçenek Numarasını girin: </label>
          <input type="number" name="dogruNo" min=1 max=4>

      <br>
      <button type="submit" style="margin-top: 40px;">Gönder</button>
      <br>
      </form>
      <form action='edit.php'>
      <button type="submit" id="geri" style="margin-top: 40px;" onclick="">Geri Dön</button>
      </form>




    </form>
  </div>
 </div>










</body>



</html>

