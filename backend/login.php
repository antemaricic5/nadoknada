<?php

include '../DbHandler.php';
use db\DbHandler;

$db= new DbHandler();

session_start();

$korisnickoime = $_POST['korisnickoime'];
$zaporka =substr(hash('sha512',$_POST['zaporka']), 0,30) ;

$sql = "SELECT * FROM users where korisnickoime = '".$korisnickoime."' and zaporka = '".$zaporka."'";

$db->select($sql);

$result = $db->select($sql);

if($result->num_rows>0){
    $user = $result->fetch_assoc();
    $_SESSION["korisnickoime"] = $user["korisnickoime"];
    $_SESSION["id"] = $user["id"];

    echo $_SESSION["korisnickoime"]; 
}
else{
    echo 0;
}

?>