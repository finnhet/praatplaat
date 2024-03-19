<?php

include('extra\database.con.php');

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if (isset($_POST['uploadEle'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : null; // Handle the case where 'id' is not set
    $NaamNL = $_POST['NaamNL'];
    $NaamFR = $_POST['NaamFR'];
    $NaamEN = $_POST['NaamEN'];

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO elementen (id, NaamNL, NaamFR, NaamEN) VALUES (?, ?, ?, ?)");
    // Bind parameters to the SQL query
    $stmt->bind_param("isss", $id, $NaamNL, $NaamFR, $NaamEN);

    if ($stmt->execute()) {
        // Redirect only if the query was successful
        header('Location: elementEdit.php');
        exit(0);
    }
}

?>
