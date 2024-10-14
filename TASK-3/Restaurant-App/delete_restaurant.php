<?php 

require 'conn.php';

$baglanti = new conn("restaurant_app");

if(isset($_GET['id']))
{

    
    $id =  $_GET['id'];

    $query= "UPDATE restaurant SET deleted_at=NOW() WHERE id=$id";

    $baglanti->updein($query);

    header("Location:manage_restaurants.php");
} 


?>