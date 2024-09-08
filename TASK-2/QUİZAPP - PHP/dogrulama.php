<?php 
include "imports.php";

 if(isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] != ""  && $_POST['password'] != "")
{
    $username = $_POST['username'];
    $password = $_POST['password'];
     try{$sorgu = $pdo->query("SELECT username,password FROM users WHERE username='$username'");
        parolaDogrula($sorgu);
     }
     catch(Exception $e) {
        echo "Yanlış kullanıcı adı girdiniz!";
        echo $e;
     }


}
else{
    echo "Kullanıcı adı ve şifre girdilerini boş bırakmayın!";
}


function parolaDogrula($sorgu){
    global $username, $password;
    $sonuc = $sorgu->fetchAll();
    $db_pass = $sonuc[0]['password'];


    if ($db_pass == $password)
    {
        session_start();
        kullaniciYönlendir();
    }
    else{
        echo "hata";
    }
      
}


function kullaniciYönlendir(){
    global $username;


    if($username=="admin")
    {
        $_SESSION['user'] = "admin";
        header("Location:edit.php");

    }
    else{
        $_SESSION['user'] = $username;
        header("Location:play.php");
    }
}






?>

