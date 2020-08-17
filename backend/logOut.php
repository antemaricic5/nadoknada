<?php

include '../DbHandler.php';
use db\DbHandler;

$db= new DbHandler();

session_start();

$sql = "UPDATE users SET aktivnost = 'offline'
        WHERE korisnickoime='".$_SESSION["korisnickoime"]."'";

$db->update($sql);

$result = $db->update($sql);
echo $result;

?>