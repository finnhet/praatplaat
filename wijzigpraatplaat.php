<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_submit"])) {
    // Get form data
    $plaatplaat_id = $_POST['plaatplaat_id'];
    $naam_nl = $_POST['naam_nl'];
    $naam_fr = $_POST['naam_fr'];
    $naam_en = $_POST['naam_en'];

    // Check if a new photo is uploaded
    if ($_FILES['foto']['size'] > 0) {
        $target_dir = "../fotos/"; // Adjusted target directory path
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check !== false) {
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            } else {
                // Generate a unique filename to avoid conflicts
                $foto_name = uniqid() . "." . $imageFileType;
                $target_file = $target_dir . $foto_name;

                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    updatePraatplaat($plaatplaat_id, null, null, null, $foto_name);
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
        updatePraatplaat($plaatplaat_id, $naam_nl, $naam_fr, $naam_en);
    }
}

function updatePraatplaat($id, $naam_nl = null, $naam_fr = null, $naam_en = null, $foto_name = null) {
    include 'db.php';
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    if ($foto_name) {
        // Concatenate the '../fotos/' prefix with the image name
        $foto_path = "fotos/" . $foto_name;
        $stmt = $conn->prepare("UPDATE praatplaten SET foto_path=? WHERE id=?");
        $stmt->bind_param("si", $foto_path, $id);
    } else {
        // No new photo provided, update only the name fields if they are not empty
        $sql = "UPDATE praatplaten SET ";
        $params = array();
        $types = '';
        if (!empty($naam_nl)) {
            $sql .= "NaamNL=?, ";
            $params[] = $naam_nl;
            $types .= 's';
        }
        if (!empty($naam_fr)) {
            $sql .= "NaamFR=?, ";
            $params[] = $naam_fr;
            $types .= 's';
        }
        if (!empty($naam_en)) {
            $sql .= "NaamEN=?, ";
            $params[] = $naam_en;
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
    header("Location: praatplaat.php");
    exit();
}
?>
