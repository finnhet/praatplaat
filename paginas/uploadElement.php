<?php

include('../db.php');


if (isset($_POST['uploadEle'])) {
    // Check if file is uploaded without errors
    if (isset($_FILES['Foto']) && $_FILES['Foto']['error'] === UPLOAD_ERR_OK) {
        // File details
        $file_name = $_FILES['Foto']['name'];
        $file_tmp = $_FILES['Foto']['tmp_name'];

        // Move uploaded file to directory
        $upload_directory = "../fotos/"; // Specify directory here
        $destination = $upload_directory . $file_name;
        if (move_uploaded_file($file_tmp, $destination)) {
            // Retrieve other form data
            $NaamNL = $_POST['NaamNL'];
            $NaamFR = $_POST['NaamFR'];
            $NaamEN = $_POST['NaamEN'];

            // Prepare an SQL statement to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO elementen (id, Foto, NaamNL, NaamFR, NaamEN) VALUES (NULL, ?, ?, ?, ?)");
            // Bind parameters to the SQL query
            $stmt->bind_param("ssss", $file_name, $NaamNL, $NaamFR, $NaamEN);

            if ($stmt->execute()) {
                // Redirect only if the query was successful
                header('Location: elementEdit.php');
                exit(0);
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Failed to move the file.";
        }
    } else {
        echo "File upload error.";
    }
}

?>
