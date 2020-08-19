<!DOCTYPE html>
<html lang="hr">
<head>
    <title>Ribogram</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles/profil.css?rnd=132">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-sm">
        <div class="navbar-header">
            <img src="images/logo.png" widht="200px" height="100px">
        </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigationBar">
            <span class="fas fa-align-justify" style="color:white">
            </span>
        </button>
            <div class="container-fluid">
                <ul class="nav navbar-nav navbar-right">
                    <li id="pocetna"><a href="./pocetna.php">Početna</a></li>
                    <li id="razmak"> | </li>
                    <li id="profil"><a href="./profil.php">Moj profil</a></li>
                    <li id="razmak"> | </li>
                    <li id="postavke"><a href="./postavke.html" >Postavke</a></li>
                    <li id="razmak"> | </li>
                    <li id="odjava"><a href="" onclick=logout() >Odjava</a></li>
                </ul>
            </div>
    </nav>
    <div class="container">
        <div class="info-wrapper">
            <?php
                include_once "./DbHandler.php";
                use db\DbHandler as handler;

                error_reporting(E_ERROR | E_PARSE);
                session_start();

                $db = new handler();
                $sql = "SELECT * FROM users WHERE id='".$_SESSION["id"]."'";
                $result = $db->select($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){ 
                        $user = new stdClass();
                        $user->slika = $row["slika"];
                        $user->korisnickoime = $row["korisnickoime"];
                        $user->aktivnost = $row["aktivnost"];
                        echo '<img src="./uploads/'.$user->slika.'" alt="user img" width="180" height="180">';
                        echo '<div class="user-box" data-info = \''.(json_encode($user)) .'\' >';   
                            echo '<h1>'.$user->korisnickoime.'</h1>';
                            if($user->aktivnost == "online")
                                echo '<p style="color:green"><b>'.$user->aktivnost.'</b></p>';
                            else
                                echo '<p style="color:red"><b>'.$user->aktivnost.'</b></p>';
                        echo "</div>";
                        echo "<button type='button' class='btn btn-primary' onclick=ucitajsliku()>Učitaj</button>";
                    }
                }
                    
            ?>
        </div>

        <div class="row fish-list">
        <?php
            error_reporting(E_ERROR | E_PARSE);

            $sql = "SELECT * FROM photos where autor='".$_SESSION["id"]."'";
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
                    echo "<div class='btn-wrapper'>";
                        echo "<button id='".$photo->id."' class='btn2 mb-4 btn-lg btn-primary' onclick=uredisliku(this.id)>Uredi</button>";
                        //echo '<input type="text" hidden class="form-control" id="fish-id" value='.$photo->id.' name="id">';
                        echo "<button id='".$photo->id."' class='btn2 mb-4 btn-lg btn-danger' onclick=obrisisliku(this.id)>Obriši</button>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        ?>
            
        </div>
    </div>
    </div>

    <script src="frontend/profil.js" type="text/javascript"></script>

</body>
</html>