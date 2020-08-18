<?php 
   include '../DbHandler.php';
   use db\DbHandler;

   session_start();
    
    $uploadDir = "../uploads/";

    if(isset($_POST['opis']) || isset($_POST['zaporka']) ||isset($_POST['korisnickoime']) ){ 
        $opis = $_POST['opis']; 
        $zaporka=hash('sha512',$_POST['zaporka']);
        $korisnickoime=$_POST['korisnickoime'];
        $id = $_POST['id'];
        
        // Check whether submitted data is not empty 
        if(!empty($opis) && !empty($korisnickoime) && !empty($zaporka)){ 
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
                    $sql = "UPDATE users SET opis = '".$opis."',korisnickoime='".$korisnickoime."',zaporka='".$zaporka."',slika='".$fileName."'
                        WHERE id='".$id."'";
                    
                    $db->update($sql);

                    echo "sucesfully";
                } 
            }
            else{
                $db= new DbHandler();
                $sql = "UPDATE users SET opis = '".$opis."',korisnickoime='".$korisnickoime."',zaporka='".$zaporka."'
                        WHERE id='".$id."'";
                
                $db->update($sql);
                echo "sucesfully";
            }
        }
    } 
?>