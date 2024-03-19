<?php
include '../db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_submit"])) {
    // Get form data
    $plaatplaat_id = $_POST['plaatplaat_id'];
    $naam_nl = $_POST['naam_nl'];
    $naam_fr = $_POST['naam_fr'];
    $naam_en = $_POST['naam_en'];

   
    if ($_FILES['foto']['size'] > 0) {
        
        $target_dir = "../fotos/"; 
        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if($check !== false) {
           
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            } else {
                
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                  
                    $foto_name = basename($_FILES["foto"]["name"]);
                    updatePraatplaat($plaatplaat_id, $naam_nl, $naam_fr, $naam_en, $foto_name);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    } else {
       
        updatePraatplaat($plaatplaat_id, $naam_nl, $naam_fr, $naam_en);
    }
}


function updatePraatplaat($id, $naam_nl, $naam_fr, $naam_en, $foto_name = null) {
    include '../db.php';
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($foto_name) {
        $stmt = $conn->prepare("UPDATE praatplaten SET Foto=?, NaamNL=?, NaamFR=?, NaamEN=? WHERE id=?");
        $stmt->bind_param("ssssi", $foto_name, $naam_nl, $naam_fr, $naam_en, $id);
    } else {
        $stmt = $conn->prepare("UPDATE praatplaten SET NaamNL=?, NaamFR=?, NaamEN=? WHERE id=?");
        $stmt->bind_param("sssi", $naam_nl, $naam_fr, $naam_en, $id);
    }
    
    if ($stmt->execute()) {
        echo "Praatplaat bijgewerkt.";
    } else {
        echo "Fout bij bijwerken van praatplaat: " . $conn->error;
    }

    $stmt->close();
    $conn->close();


    header("Location: praatplaat.php");
    exit();
}
?>
