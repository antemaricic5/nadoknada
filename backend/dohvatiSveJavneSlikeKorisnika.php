<?php
    include '../DbHandler.php';
    use db\DbHandler;
    
    $db= new DbHandler();

    error_reporting(E_ERROR | E_PARSE);
    session_start();
    $sql = "SELECT * FROM photos where autor='".$_POST["id"]."' AND privatnost='Javno'";
    $result = $db->select($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){ 
            $photo = new stdClass();
            $photo->id = $row["id"];
            $photo->slika = $row["slika"];
            $photo->opis = $row["opis"];
            echo '<div class="col-md-4 mb-1">';
                echo '<div class="photo-box" data-info = \''.(json_encode($photo)) .'\'>';   
                    echo '<img id="myImg" class="photo-img" src="uploads/'.$photo->slika.'" alt="Fish Box 1" width="100%" height="250">';
                    echo '<p>'.$photo->opis.'</p>';
                    echo '<div id="myModal" class="modal">
                    <span class="close">&times;</span>
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                    </div>';
                echo "</div>";
            echo "</div>";
        }
    }
?>