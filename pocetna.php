<!DOCTYPE html>
<html lang="hr">
<head>
    <title>Ribogram</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles/pocetna.css?rnd=132">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm">
    <div class="navbar-header">
        <img src="images/logo.png" widht="200px" height="100px">
    </div>
      
    <div class="container-fluid">
        <ul class="nav navbar-nav navbar-right">
            <li id="pocetna"><a href="./pocetna.php">Početna</a></li>
            <li id="razmak"> | </li>    
            <li id="profil"><a href="./profil.php">Moj profil</a></li>
            <li id="razmak"> | </li>
            <li id="postavke"><a href="./postavke.html" >Postavke</a></li>
            <li id="razmak"> | </li>
            <li id="odjava"> <a href="./index.php" onclick=logout()>Odjava</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <div id="img-wrapper">
        <img id="oneimageview" src="./images/oneimage.png" width="50px" height="50px" style="padding:10px 10px;margin-left:10px" />
        <img id="galleryview" src="./images/gallery.png" width="50px" height="50px" style="padding:10px 10px;margin-right:10px;border-bottom:2px solid"/>
    </div>
    <div class="col-auto w-100 gallery-view" style="margin-top: 24px">
        <div class="row photo-list">
        <?php
            include_once "./DbHandler.php";
            use db\DbHandler as handler;
            error_reporting(E_ERROR | E_PARSE);
            $db = new handler();
            $sql = "SELECT * FROM photos 
                WHERE privatnost = 'Javno'
                ORDER BY RAND()
                LIMIT 9 ";
            $result = $db->select($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){ 
                    $photo = new stdClass();
                    $photo->id = $row["id"];
                    $photo->opis = $row["opis"];
                    $photo->autor = $row["autor"];
                    $photo->slika = $row["slika"];

                    $sql2 = "SELECT * FROM users 
                        WHERE id = '".$photo->autor."'";
                    
                    $result2 = $db->select($sql2);
                    $row2 = $result2->fetch_assoc();
                    $user = new stdClass();
                    $user->nick = $row2["korisnickoime"];
                    echo '<div class="col-md-4 mb-1">';
                        echo '<div class="photo-box" data-info = \''.(json_encode($photo)) .'\' >';   
                            echo '<img id="myImg" src="./uploads/'.$photo->slika.'" alt="photo Box 1" width="100%" height="250">';
                            echo '<p id="nadimak"><b>'.$user->nick.'</b></p>';
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
        </div>
    </div>
    <div class="col-auto w-100 oneimage-view" style="margin-top: 24px">
        <div class="row photo-list">
        <?php
        
            error_reporting(E_ERROR | E_PARSE);
            $db = new handler();
            $sql = "SELECT * FROM photos 
                WHERE privatnost = 'Javno'
                ORDER BY RAND()
                LIMIT 9 ";
            $result = $db->select($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){ 
                    $photo = new stdClass();
                    $photo->id = $row["id"];
                    $photo->opis = $row["opis"];
                    $photo->autor = $row["autor"];
                    $photo->slika = $row["slika"];
                    $sql2 = "SELECT * FROM users 
                    WHERE id = '".$photo->autor."'";
                
                    $result2 = $db->select($sql2);
                    $row2 = $result2->fetch_assoc();
                    $user = new stdClass();
                    $user->nick = $row2["korisnickoime"];
                    echo '<div class="col-md-12 mb-1">';
                        echo '<div class="photo-box" data-info = \''.(json_encode($photo)) .'\' >';   
                            echo '<img src="./uploads/'.$row['slika'].'" alt="photo Box 1" width="100%" height="350">';
                            echo '<p style="margin-bottom:0; padding-bottom: 0;cursor:pointer;"><b>'.$user->nick.'</b></p>';
                            echo '<p>'.$photo->opis.'</p>';
                        echo "</div>";
                    echo "</div>";
                }
            }
                
        ?>
    </div>
</div>
    

    <script src="frontend/pocetna.js" type="text/javascript"></script>
</body>
</html>