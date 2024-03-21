<?php
include('extra\database.con.php');

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['uploadEle'])){
    $NaamNL = $_POST['NaamNL'];
    $NaamFR = $_POST['NaamFR'];
    $NaamEN = $_POST['NaamEN'];
    $cat = $_POST['cat'];

    // Check if the cat exists in praatplaten
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
        if($stmt->execute()){
            echo "<script>alert('wel');</script>";
        } else {
            echo "<script>alert('niet');</script>";
        }
    }
}
?>