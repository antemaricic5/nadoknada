<?php
    include '../DbHandler.php';
    use db\DbHandler;
    
    $db= new DbHandler();

    error_reporting(E_ERROR | E_PARSE);
    session_start();
    $sql = "SELECT * FROM photos where autor='".$_POST["id"]."'";
    $result = $db->select($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){ 
            $photo = new stdClass();
            $photo->id = $row["id"];
            $photo->slika = $row["slika"];
            $photo->opis = $row["opis"];
            echo '<div class="col-md-4 mb-1">';
                echo '<div class="photo-box" >';   
                    echo '<img class="photo-img" src="uploads/'.$photo->slika.'" alt="Fish Box 1">';
                echo "</div>";
            echo "</div>";
        }
    }
?>