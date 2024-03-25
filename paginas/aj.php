<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["UpdateEle"])) {
    include '../db.php'; // Make sure this path is correct and the file is properly included

    $element_id = $_POST['element_id'] ?? null;
    $Naam_NL = $_POST['naam_NL'] ?? null; // Make sure to match the case with your form field names
    $Naam_FR = $_POST['naam_FR'] ?? null;
    $Naam_EN = $_POST['naam_EN'] ?? null;
    $Foto_name = null; // Initialize the variable

    // Check if a new photo is uploaded
    if (!empty($_FILES['Foto']['size'])) {
        $target_dir = "../fotos/";
        $target_file = $target_dir . basename($_FILES["Foto"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["Foto"]["tmp_name"]);
        if ($check !== false && in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($_FILES["Foto"]["tmp_name"], $target_file)) {
                $Foto_name = basename($_FILES["Foto"]["name"]); // Correctly use the name of the uploaded file
            } else {
                echo "Sorry, er was een error uploading uw file.";
                exit;
            }
        } else {
            echo "Sorry, alleen JPG, JPEG, PNG & GIF files zijn toegestaan.";
            exit;
        }
    }

    // Update the element
    updateElement($conn, $element_id, $Naam_NL, $Naam_FR, $Naam_EN, $Foto_name); // Pass $conn and correct variables
}

function updateElement($conn, $element_id, $naam_NL, $naam_FR, $naam_EN, $Foto) {
    // Check if there are any fields to update
    $updates = [];
    if ($naam_NL) $updates[] = "NaamNL='".$conn->real_escape_string($naam_NL)."'";
    if ($naam_FR) $updates[] = "NaamFR='".$conn->real_escape_string($naam_FR)."'";
    if ($naam_EN) $updates[] = "NaamEN='".$conn->real_escape_string($naam_EN)."'";
    if ($Foto) $updates[] = "Foto='".$conn->real_escape_string($Foto)."'";

    if (!empty($updates)) {
        $sql = "UPDATE elementen SET ".implode(", ", $updates)." WHERE id=?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            echo "Error preparing statement: " . $conn->error;
            return;
        }
        $stmt->bind_param('i', $element_id); // Bind $element_id as an integer ('i')
        
        if ($stmt->execute()) {
            echo "Element bijgewerkt.";
        } else {
            echo "Fout bij bijwerken van Element: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "No data to update.";
    }

    $conn->close();
    // Redirect or further processing
    header("Location: elementEdit.php");
    exit();
}
?>
