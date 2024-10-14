<?php 


include 'conn.php';

$conn = new conn('restaurant_app');


function SorguID($id)
{
    global $conn;
    $query = "SELECT * FROM food WHERE id='$id'";
    $result = $conn->select($query);

    return $result;

}


?>