<?php

include '../DbHandler.php';
use db\DbHandler;

$db= new DbHandler();
session_start();

$fish= new stdClass();
$fish->id = $_POST["id"];
$sql =" SELECT * FROM photos WHERE id='".$fish->id."'";

$db->select($sql);

$result = $db->select($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $fish= $row;
    }
}
echo (json_encode($fish));
?>