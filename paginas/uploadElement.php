
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



<?php
if (isset($_POST['DeleteEle'])) {
    include '../db.php'; // Ensure database connection is included

    $id = $_POST['id'];

    // Using prepared statements for security
    $deleteQuery = "DELETE FROM elementen WHERE id = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, 'i', $id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
}
if (mysqli_stmt_execute($stmt)) {
    // Redirect or show a success message
    header('Location: elementEdit.php');
    exit();
} else {
    // Redirect or show an error message
    header('Location: elementEdit.php');
    exit();
}

?>
