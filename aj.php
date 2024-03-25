<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["UpdateEle"])) {
    // Get form data
    $id = $_POST['id'];
    $NaamNL = $_POST['NaamNL'];
    $NaamFR = $_POST['NaamFR'];
    $NaamEN = $_POST['NaamEN'];

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
                    updateElement($id, null, null, null, $foto_name);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    } else {
        // No new photo provided, update the database without changing the photo and retain existing name values
        updateElement($is, $NaamNL, $NaamFR, $NaamEN);
    }
}

function updateElement($id, $NaamNL = null, $NaamFR = null, $NaamEN = null, $foto_name = null) {
    include '../db.php';
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    if ($foto_name) {
        $stmt = $conn->prepare("UPDATE elementen SET foto=? WHERE id=?");
        $stmt->bind_param("si", $foto_name, $id);
    } else {
        // No new photo provided, update only the name fields if they are not empty
        $sql = "UPDATE praatplaten SET ";
        $params = array();
        $types = '';
        if (!empty($NaamNL)) {
            $sql .= "NaamNL=?, ";
            $params[] = $NaamNL;
            $types .= 's';
        }
        if (!empty($NaamFR)) {
            $sql .= "NaamFR=?, ";
            $params[] = $NaamFR;
            $types .= 's';
        }
        if (!empty($NaamEN)) {
            $sql .= "NaamEN=?, ";
            $params[] = $NaamEN;
            $types .= 's';
        }
        // Remove the last comma and space
        $sql = rtrim($sql, ", ");
        // Add condition for id
        $sql .= " WHERE id=?";
        // Add id to params
        $params[] = $id;

        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            echo "Error preparing statement: " . $conn->error;
            return;
        }
        // Dynamically bind parameters
        $types .= 'i'; // Add 'i' for the id parameter
        $stmt->bind_param($types, ...$params);
    }

    // Execute the statement
    if ($stmt->execute()) {
        echo "Praatplaat bijgewerkt.";
    } else {
        echo "Fout bij bijwerken van praatplaat: " . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect to the page after updating
    // header("Location: elementEdit.php");
    exit();
}

?>
