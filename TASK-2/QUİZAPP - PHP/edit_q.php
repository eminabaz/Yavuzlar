<?php 
include 'imports.php';

if(isset($_GET['number']))
{
 $n = $_GET['number']; 
 
 global $n;
}

if(isset($_POST['submit']))
{
    $yeni_icerik= $_POST['yeni_icerik'];
    soruyuDüzenle($yeni_icerik, $n);
    header("location:edit.php");
    
}

?>


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
      <form method="post" id="soruduzenlemeformu" action=""> <br>
      <h2>Mevcut Soru içeriği : </h2>
      <h3>  <?php echo "" . IDsoruGetir($n)['icerik']?> </h3>



      <h2 style="padding-top:200px" >Yeni Soru içeriğini Girin. </h2>
      <input type="text" id="soruİcerik" name="yeni_icerik" required>
      <br>
      <br>

      </select>
      
      <br>
      <button type="submit" style="margin-top: 40px;" name="submit">Gönder</button>
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

