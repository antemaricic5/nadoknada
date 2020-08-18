<?php 
include '../DbHandler.php';
use db\DbHandler;

$db = new DbHandler();

$korisnickoime = $_POST['korisnickoime'];

$sql = "SELECT * FROM users WHERE korisnickoime = '".$korisnickoime."'";

$db->select($sql);

$result = $db->select($sql);

if($result->num_rows>0){
    echo 0;     
}
else{
    echo 1;
}

?>