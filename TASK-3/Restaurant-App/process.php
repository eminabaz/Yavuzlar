<?php 
session_start();
include 'conn.php';


$conn = new conn("restaurant_app");

//! Yeni kullanıcının Database'e kaydedilmesi işlemleri.
//? Başlagıç
if (isset($_POST['submit']))
{
    $role = $_POST['role'];
    $name = $_POST['name'];
    $surname =$_POST['surname'];
    $username = $_POST['username'];
    $pswd = $_POST['pswd'];
    $password =  password_hash($pswd, PASSWORD_ARGON2ID);


    $lastID_INC1 = usersAdetBul()+1;
 $connection->updein("INSERT INTO users (id, role ,name , surname, username, password)
   VALUES ('$lastID_INC1' , '$role', '$name', '$surname', '$username', '$password')");


if ($_POST['role'] =="calisan")
{
    $restoran_id = $_POST["restoran-name"]; 

    $sirket_id = $connection->select("SELECT id,company_id FROM restaurant WHERE id='$restoran_id'");

    $restoran_id = $sirket_id[0]['id'];
    $sirket_id = $sirket_id[0]['company_id'];

    $connection->updein("UPDATE users SET company_id=$sirket_id, restaurant_id='$restoran_id' WHERE id=$lastID_INC1");
}
}
//? Bitiş


// ! Login işlemleri

if (isset($_POST['login']))
{
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->select($query);
    $hashed_pass = $result[0]['password'];
    $admin_key = $result[0]['is_admin'];
    

    if(password_verify($pass, $hashed_pass))
    {
        $_SESSION['username']=$username;
        $_SESSION['role']=$result[0]['role'];
        $_SESSION['user_id']=$result[0]['id'];
        $rol = $_SESSION['role'];
        if($rol == 'calisan'){
        $_SESSION['rest_id'] = $result[0]['restaurant_id'];
        }
        if($admin_key === 1)
        {
            $_SESSION['admin'] =1;
        }
        header("location:index.php");
    }
    else{
        header("location:login.php");
    }

}

function usersAdetBul(){  
    global $connection;

    $sonuc = $connection->selectARR("SELECT COUNT(*) FROM users");
    
    $sonIndex = $sonuc[0][0];
    $sonIndex -=1; //array'de index 0'dan başladığı için.



    $sonuc = $connection->selectARR("SELECT * FROM users");
  
    $sonID = $sonuc[$sonIndex][0];

    return $sonID;
}


?>