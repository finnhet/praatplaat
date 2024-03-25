
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
                echo "Sorry, alleen JPG, JPEG, PNG & GIF files zijn toegestaan.";
                $uploadOk = 0;
            } else {
                if (move_uploaded_file($_FILES["Foto"]["tmp_name"], $target_file)) {
                    $Foto_name = basename($_FILES["Foto"]["name"]);
                    $Foto = $target_file; // Store the file path in the database
                    addelementen($NaamNL, $NaamFR, $NaamEN, $cat, $Foto);
                } else {
                    echo "Sorry, er was een error uploading uw file.";
                }
            }
        } else {
            echo "File is niet een image.";
            $uploadOk = 0;
        }
    } else {
        // No photo provided
        echo "Selecteer een foto.";
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
        echo "element toegevoegd.";
    } else {
        echo "Fout bij toevoegen van element: " . $conn->error;
    }

     header("Location: ../paginas/elementEdit.php");   

    $stmt->close();
    $conn->close();
}
?>










<?php

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["UpdateEle"])) {
//     // Get form data
//     $id = $_POST['id'];
//     $NaamNL = $_POST['NaamNL'];
//     $NaamFR = $_POST['NaamFR'];
//     $NaamEN = $_POST['NaamEN'];

//     // Check if a new photo is uploaded
//     if ($_FILES['Foto']['size'] > 0) {
//         $target_dir = "../fotos/"; 
//         $target_file = $target_dir . basename($_FILES["Foto"]["name"]);
//         $uploadOk = 1;
//         $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//         $check = getimagesize($_FILES["Foto"]["tmp_name"]);
//         if ($check !== false) {
//             if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//                 && $imageFileType != "gif") {
//                 echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//                 $uploadOk = 0;
//             } else {
//                 if (move_uploaded_file($_FILES["Foto"]["tmp_name"], $target_file)) {
//                     $Foto_name = basename($_FILES["Foto"]["name"]);
//                     $Foto = $target_file; // Store the file path in the database
//                     addelementen($NaamNL, $NaamFR, $NaamEN, $cat, $Foto);
//                 } else {
//                     echo "Sorry, there was an error uploading your file.";
//                 }
//             }
//         } else {
//             echo "File is not an image.";
//             $uploadOk = 0;
//         }
//     } else {
//         // No new photo provided, update the database without changing the photo and retain existing name values
//         updateElement($id, $NaamNL, $NaamFR, $NaamEN);
//     }
// }

// function updateElement($id, $NaamNL = null, $NaamFR = null, $NaamEN = null, $foto_name = null) {
//     include '../db.php';
//     $conn = new mysqli($servername, $username, $password, $dbname);
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }

//     // Prepare the SQL statement
//     if ($foto_name) {
//         $stmt = $conn->prepare("UPDATE elementen SET Foto=? WHERE id=?");
//         $stmt->bind_param("si", $Foto_name, $id);
//     } else {
//         // No new photo provided, update only the name fields if they are not empty
//         $sql = "UPDATE elementen SET ";
//         $params = array();
//         $types = '';
//         if (!empty($NaamNL)) {
//             $sql .= "NaamNL=?, ";
//             $params[] = $NaamNL;
//             $types .= 's';
//         }
//         if (!empty($NaamFR)) {
//             $sql .= "NaamFR=?, ";
//             $params[] = $NaamFR;
//             $types .= 's';
//         }
//         if (!empty($NaamEN)) {
//             $sql .= "NaamEN=?, ";
//             $params[] = $NaamEN;
//             $types .= 's';
//         }
//         // Remove the last comma and space
//         $sql = rtrim($sql, ", ");
//         // Add condition for id
//         $sql .= " WHERE id=?";
//         // Add id to params
//         $params[] = $id;

//         // Prepare and bind parameters
//         $stmt = $conn->prepare($sql);
//         if ($stmt === false) {
//             echo "Error preparing statement: " . $conn->error;
//             return;
//         }
//         // Dynamically bind parameters
//         $types .= 'i'; // Add 'i' for the id parameter
//         $stmt->bind_param($types, ...$params);
//     }

//     // Execute the statement
//     if ($stmt->execute()) {
//         echo "Praatplaat bijgewerkt.";
//     } else {
//         echo "Fout bij bijwerken van praatplaat: " . $conn->error;
//     }

//     // Close the statement and connection
//     $stmt->close();
//     $conn->close();

//     // Redirect to the page after updating
//     // header("Location: elementEdit.php");
//     exit();
// }

?>
