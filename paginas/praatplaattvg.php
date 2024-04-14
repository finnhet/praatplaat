
<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_submit"])) {
    // Get form data
    $naam_nl = $_POST['naam_nl'];
    $naam_fr = $_POST['naam_fr'];
    $naam_en = $_POST['naam_en'];

    // Check if a new photo is uploaded
    if ($_FILES['foto']['size'] > 0) {
        $target_dir = "../fotos/"; 
        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check !== false) {     
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            } else {
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    $foto_name = basename($_FILES["foto"]["name"]);
                    $foto_path = $target_file; // Store the file path in the database
                    addPraatplaat($naam_nl, $naam_fr, $naam_en, $foto_path);
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

function addPraatplaat($naam_nl, $naam_fr, $naam_en, $foto_path) {
    include '../db.php';
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO praatplaten (NaamNL, NaamFR, NaamEN, foto_path) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $naam_nl, $naam_fr, $naam_en, $foto_path);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Praatplaat toegevoegd.";
    } else {
        echo "Fout bij toevoegen van praatplaat: " . $conn->error;
    }

   header("Location: ../paginas/praatplaat.php");   

    $stmt->close();
    $conn->close();
}
?>
