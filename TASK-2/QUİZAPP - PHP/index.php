<?php 
include 'imports.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Quiz Uygulamasi</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">

</head>


<body>
    <div class="headcontainer">
        <div class="longheader">
            <ul class="userlogin" id="long-header-text">

                <li>

                    <a disabled> QUİZ-APP </a>

                </li>


            </ul>
        </div>
    </div>

    <div class="discontainer" id="discontainer">
        <div class="logincontainer" id="login-container">
            <form method="post" action="dogrulama.php">
            <h3>admin:admin <br> student:student </h3>
            <div class="inputs">
                
                <h1>Kullanıcı Adı</h1>
                <input type=text id="username" name="username" placeholder="Kullanıcı Adı" required>
                <h1>Parola</h1>
                <input type="password" id="password" name="password" placeholder="Parola" required>
                <button type="submit" style="margin-top: 10px;">Giriş yap</button>
            </div>
         </form>
        </div>
    </div>

</body>

</html>