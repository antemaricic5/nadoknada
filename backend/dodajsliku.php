<?php 

    include '../DbHandler.php';
    use db\DbHandler;

    session_start();
    
    $uploadDir = "../uploads/";

    if(isset($_POST['opis']) || isset($_POST['customRadio']) ){ 
        // Get the submitted form data 
        $opis = $_POST['opis']; 
        $privatnost=$_POST['customRadio'];
        
        // Check whether submitted data is not empty 
        if(!empty($opis) && !empty($privatnost)){ 

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
                    $sql = "INSERT INTO photos (slika,opis,privatnost,autor) VALUES ('".$fileName."','".$opis."','".$privatnost."','".$_SESSION['korisnickoime']."')"; 

                    $db->insert($sql);
                    
                    echo "sucesfully";
                } 
            }
        }
    } 
?>