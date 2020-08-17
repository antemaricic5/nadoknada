<?php

require "../DbHandler.php";
use db\DbHandler;

$db = new DbHandler();

session_start();

$sql = "UPDATE users SET aktivnost = 'online'
        WHERE korisnickoime='".$_SESSION["korisnickoime"]."'";
$db->update($sql);



?>