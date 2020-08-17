<?php 

    include '../DbHandler.php';
    use db\DbHandler;

    $uploadDir = "../uploads/";

    if(isset($_POST['korisnickoime']) || isset($_POST['zaporka']) || isset($_POST['opis'])){ 
        // Get the submitted form data 
        $korisnickoime = $_POST['korisnickoime']; 
        $zaporka =  hash('sha512',$_POST['zaporka']);; 
        $opis = $_POST['opis']; 
        
        // Check whether submitted data is not empty 
        if(!empty($korisnickoime) && !empty($zaporka) && !empty($opis)){ 

            $uploadStatus = 1; 
            // Upload file 
            $uploadedFile = ''; 
            
            if(!empty($_FILES["file"]["name"])){ 
                // File path config 
                $fileName = basename($_FILES["file"]["name"]); 
                $targetFilePath = $uploadDir . $fileName; 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                $uploadedFile = $fileName;            
                // Allow certain file formats 
                $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'); 
                if(in_array($fileType, $allowTypes)){ 
                    // Upload file to the server 
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
                        $uploadedFile = $fileName; 
                    }
                }
                if($uploadStatus == 1){ 
                    $db= new DbHandler();
                    $sql = "INSERT INTO users (korisnickoime,zaporka,opis,slika) VALUES ('".$korisnickoime."','".$zaporka."','".$opis."','".$fileName."')"; 

                    $db->insert($sql);
                    
                    echo "sucesfully";
                } 
            }
        }
    } 
?>