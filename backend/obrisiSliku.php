<?php
require "../DbHandler.php";
use db\DbHandler;

$db = new DbHandler();

$id = $_POST['id'];

$sql = "DELETE FROM photos WHERE id='".$id."'";

$result = $db->select($sql);
if($result == TRUE){
    echo "1";
}
else {
    echo "0";
}

?>