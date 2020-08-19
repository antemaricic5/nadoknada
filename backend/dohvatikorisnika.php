<?php

include '../DbHandler.php';
use db\DbHandler;

$db= new DbHandler();
session_start();

$user= new stdClass();
$sql =" SELECT * FROM users WHERE korisnickoime='".$_POST['korisnickoime']."'";

$db->select($sql);

$result = $db->select($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $user= $row;
    }
}
echo (json_encode($user));
?>