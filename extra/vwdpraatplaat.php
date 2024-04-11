<?php
include '../db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["praatplaat_id"])) {
    $praatplaat_id = $_POST["praatplaat_id"];

    $sql = "DELETE FROM praatplaten WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $praatplaat_id);

    if ($stmt->execute()) {
        
        echo "Praatplaat succesvol verwijderd.";

       
        header("Location: ../praatplaat.php");
        exit(); 
    } else {
        
        echo "Fout bij het verwijderen van praatplaat: " . $conn->error;
    }

    
    $stmt->close();
    $conn->close();
} else {
  
    echo "Ongeldige aanvraag.";
}
?>
