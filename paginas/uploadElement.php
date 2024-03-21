<?php
include('../db.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['uploadEle'])){
    $NaamNL = $_POST['NaamNL'];
    $NaamFR = $_POST['NaamFR'];
    $NaamEN = $_POST['NaamEN'];
    $cat = $_POST['cat'];


    
    $stmt = $conn->prepare("SELECT ID_Platen FROM praatplaten WHERE ID_Platen = ?");
    $stmt->bind_param("i", $cat);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0){
        echo "<script>alert('Category does not exist in praatplaten.');</script>";
    } else {
        // The cat exists, proceed with insert
        $stmt = $conn->prepare("INSERT INTO elementen (NaamNL, NaamFR, NaamEN, cat) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $NaamNL, $NaamFR, $NaamEN, $cat);
        if ($stmt->execute()) {
            // Redirect only if the query was successful
            // header('Location: elementEdit.php');
            exit(0);
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>

<?php

if(isset($_POST['uploadEle'])){
    
    $FileName = $_FILES['File']['name'];
    $FileTmpName = $_FILES['File']['tmp_name'];
    $FileSize = $_FILES['File']['size'];
    $FileError = $_FILES['File']['error'];
    $FileType = $_FILES['File']['type'];

    $FileExt = explode('.', $FileName);
    $FileActualExt = strtolower(end($FileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($FileActualExt, $allowed)) {
        if ($FileError === 0) {
            if ($FileSize < 500000) {
                $FileNameNew = uniqid('', true).".".$FileActualExt;
                $FileDestination = 'fotos/'.$FileNameNew;
                 move_uploaded_file($FileTmpName, $FileDestination);

                 header('Location: elementEdit.php?uploadgoed');
            } else {
                echo "Je File is te groot.";
            }
        } else {
            echo "Er is een error met je upload.";
        }
    } else {
        echo "Kan niet File uploaden van deze type.";
    }
}

?>

    