
<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["uploadEle"])) {

    $NaamNL = $_POST['NaamNL'];
    $NaamFR = $_POST['NaamFR'];
    $NaamEN = $_POST['NaamEN'];
    $cat = $_POST['cat'];

    // Check if a new photo is uploaded
    if ($_FILES['Foto']['size'] > 0) {
        $target_dir = "../fotos/"; 
        $target_file = $target_dir . basename($_FILES["Foto"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["Foto"]["tmp_name"]);
        if ($check !== false) {
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            } else {
                if (move_uploaded_file($_FILES["Foto"]["tmp_name"], $target_file)) {
                    $Foto_name = basename($_FILES["Foto"]["name"]);
                    $Foto = $target_file; // Store the file path in the database
                    addelementen($NaamNL, $NaamFR, $NaamEN, $cat, $Foto);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    } else {
        // No photo provided
        echo "Please select a photo.";
    }
}

function addelementen($NaamNL, $NaamFR, $NaamEN, $cat, $Foto) {
    include '../db.php';
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO elementen (NaamNL, NaamFR, NaamEN, cat, Foto) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $NaamNL, $NaamFR, $NaamEN, $cat, $Foto);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Praatplaat toegevoegd.";
    } else {
        echo "Fout bij toevoegen van praatplaat: " . $conn->error;
    }

   //header("Location: ../paginas/elementEdit.php");   

    $stmt->close();
    $conn->close();
}
?>











<?php
// include '../db.php';

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["UpdateEle"])) {

//     // Check if all required fields are set in the $_POST array
//     if (isset($_POST['NaamNL']) && isset($_POST['NaamFR']) && isset($_POST['NaamEN']) && isset($_POST['cat'])) {

//         $NieuweNaamNL = $_POST['NaamNL'];
//         $NieuweNaamFR = $_POST['NaamFR'];
//         $NieuweNaamEN = $_POST['NaamEN'];
//         $cat = $_POST['cat'];

//         // Check if a new photo is uploaded
//         if ($_FILES['Foto']['size'] > 0) {
//             $target_dir = "../fotos/"; 
//             $target_file = $target_dir . basename($_FILES["Foto"]["name"]);
//             $uploadOk = 1;
//             $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//             $check = getimagesize($_FILES["Foto"]["tmp_name"]);
//             if ($check !== false) {
//                 if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//                     && $imageFileType != "gif") {
//                     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//                     $uploadOk = 0;
//                 } else {
//                     if (move_uploaded_file($_FILES["Foto"]["tmp_name"], $target_file)) {
//                         $Foto_name = basename($_FILES["Foto"]["name"]);
//                         $Foto = $target_file; // Store the file path in the database
//                         updateElement($NieuweNaamNL, $NieuweNaamFR, $NieuweNaamEN, $cat, $Foto);
//                     } else {
//                         echo "Sorry, there was an error uploading your file.";
//                     }
//                 }
//             } else {
//                 echo "File is not an image.";
//                 $uploadOk = 0;
//             }
//         } else {
//             // No photo provided
//             echo "Please select a photo.";
//         }
//     } // else {
//         // Some required fields are missing
//         //echo "Please fill in all required fields.";
//     }
// //}

// function updateElement($NieuweNaamNL, $NieuweNaamFR, $NieuweNaamEN, $cat, $Foto) {
//     include '../db.php';
//     $conn = new mysqli($servername, $username, $password, $dbname);
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }

//     // Prepare the SQL statement
//     $stmt = $conn->prepare("UPDATE elementen SET NaamNL=?, NaamFR=?, NaamEN=?, cat=?, Foto=?");
//     $stmt->bind_param("sssss", $NieuweNaamNL, $NieuweNaamFR, $NieuweNaamEN, $cat, $Foto);

//     // Execute the statement
//     if ($stmt->execute()) {
//         echo "Praatplaat updated.";
//     } else {
//         echo "Error updating praatplaat: " . $conn->error;
//     }

//     header("Location: ../paginas/elementEdit.php");   
//     exit(); // Terminate script execution after redirection

//     $stmt->close();
//     $conn->close();
// }
?>







