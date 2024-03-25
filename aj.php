<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["UpdateEle"])) {
    // Assuming `elementID` holds the ID of the element to be updated
    if (isset($_POST['id']) && isset($_POST['NaamNL']) && isset($_POST['NaamFR']) && isset($_POST['NaamEN']) && isset($_POST['cat'])) {

        $id = $_POST['id'];
        $NieuweNaamNL = $_POST['NaamNL'];
        $NieuweNaamFR = $_POST['NaamFR'];
        $NieuweNaamEN = $_POST['NaamEN'];
        $cat = $_POST['cat'];

        // Handle file upload if exists
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
        updateelementen($elementID, $NieuweNaamNL, $NieuweNaamFR, $NieuweNaamEN, $cat, $Foto);
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
} // else {
// Some required fields are missing
//echo "Please fill in all required fields.";
}
//}

function updateelementen($id, $NieuweNaamNL, $NieuweNaamFR, $NieuweNaamEN, $cat, $Foto) {
    include '../db.php';
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement with the provided element ID
    $stmt = $conn->prepare("UPDATE `elementen` SET `id`='[value-1]',`Foto`='[value-2]',`NaamNL`='[value-3]',`NaamFR`='[value-4]',`NaamEN`='[value-5]',`cat`='[value-6]' WHERE 1");
    $stmt->bind_param("sssss", $NieuweNaamNL, $NieuweNaamFR, $NieuweNaamEN, $cat, $Foto);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Praatplaat updated.";
    } else {
        echo "Error updating praatplaat: " . $conn->error;
    }

    //header("Location: ../paginas/elementEdit.php");   
    exit(); // Terminate script execution after redirection

    $stmt->close();
    $conn->close();
}
?>