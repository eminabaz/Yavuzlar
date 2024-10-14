<?php 


function pass(){
$pass = password_hash("deneme80" ,PASSWORD_ARGON2ID);
print($pass);}


pass();





?>