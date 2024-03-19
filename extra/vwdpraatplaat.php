<?php
// Assuming you already have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "praatplaat";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the plaatplaat ID is received from the client-side JavaScript
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["plaatplaat"])) {
    $plaatplaat_id = $_POST["plaatplaat"];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("DELETE FROM praatplaten WHERE id = ?");
    $stmt->bind_param("i", $plaatplaat_id);

    // Execute statement
    if ($stmt->execute()) {
        echo "Plaatplaat with ID $plaatplaat_id has been removed successfully.";
    } else {
        echo "Error removing plaatplaat: " . $conn->error;
    }

    // Close statement
    $stmt->close();
} else {
    // If the plaatplaat ID is not received, return an error message
    echo "Error: Plaatplaat ID not provided.";
}

// Close connection
$conn->close();
?>
