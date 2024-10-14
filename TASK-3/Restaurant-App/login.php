<?php 
  
  include 'process.php';
  if(isset($_SESSION['username']))
  {
    header("location:index.php");
  }
  $options = "";
  $sonuc = $connection->select("SELECT * FROM restaurant");
	foreach ($sonuc as $restoran)
	{

        $options .= "<option value='". $restoran['id'] ."'>".  $restoran['name'] . "</option>";
		
	}

	
?>
<!DOCTYPE html>
<html>

<head>
	<title>Giriş Sayfası</title>
	<link rel="stylesheet" type="text/css" href="./css/style-login.css">
	<meta charset="UTF-8">
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
	<div class="main">
		<input type="checkbox" id="chk" aria-hidden="true">

		<div class="signup">
			<form action method="post" action="index.php">
				<label for="chk" aria-hidden="true">Kayıt</label>
				<input type="text" name="name" placeholder="isim" required="">
				<input type="text" name="surname" placeholder="soy isim" required="">
				<input type="text" name="username" placeholder="kullanıcı adı" required="">
				<input type="password" name="pswd" placeholder="Şifre" required="">
				<label for="role">Rolünüz Nedir:</label>
				<select name="role" id="rol-secim" onchange="showInput()">
					<option value="" selected disabled>Seçiniz</option>
					<option value="musteri">Müşteri</option>
					<option value="calisan">Restoran</option>
				</select>
				<br>
				<h1 id="restoran-sorgu" style="display:none; font: size 15px;">Hangi restoran? </h1>
				<select name="restoran-name" id="extra-secim" style="display:none">
				 <option value="" selected disabled>Seçiniz</option>
				 <?php echo $options;?>
                </select> 

				<button name="submit">Kayıt Tamamla</button>
			</form>
		</div>

		<div class="login" action="index.php">
			<form method="post" >
				<label for="chk" aria-hidden="true">Giriş</label>
				<input type="" name="username" placeholder="kullanıcı adı" required="">
				<input type="password" name="password" placeholder="şifre" required="">
				<button name="login">Giriş</button>
			</form>
		</div>
	</div>
</body>
<script>

	function showInput()
	{
		var selection = document.getElementById("rol-secim").value;
		var h1 = document.getElementById("restoran-sorgu");
		var extraselect = document.getElementById("extra-secim");
		console.log(selection);

		<?php $restoranlar = $connection->select("SELECT * FROM restaurant");?>
		
		if (selection =="calisan")
	    {
         extraselect.style.display = ""; 
		 h1.style.display="";
	    } 
		else{
			extraselect.style.display = "none"; 
			h1.style.display="none";
		}
        
	}
</script>
</html>