<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Plaatplaten Management</title>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }
    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        margin-bottom: 20px;
    }
    .button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        margin-right: 10px;
        transition: background-color 0.3s;
    }
    .button:hover {
        background-color: #0056b3;
    }
    form {
        text-align: center;
        margin-top: 20px;
    }
    label {
        font-weight: bold;
    }
    select {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-right: 10px;
    }
    input[type="submit"] {
        padding: 10px 20px;
        background-color: #ff3d00;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    input[type="submit"]:hover {
        background-color: #d32f00;
    }
</style>
</head>
<body>

<div class="container">
    <h1>Plaatplaten Management</h1>
    
    <a href="add_plaatplaat.php" class="button">Add Plaatplaat</a>
    <a href="change_plaatplaat.php" class="button">Change Plaatplaat</a>

   
        <label for="plaatplaat">Select Plaatplaat to Remove:</label>
        <select name="plaatplaat" id="plaatplaat">
            <?php
            // Your PHP code to fetch plaatplaten from the database and populate the dropdown
            // Example:
            $plaatplaten = ["Plaatplaat 1", "Plaatplaat 2", "Plaatplaat 3"]; // Dummy data
            foreach ($plaatplaten as $plaatplaat) {
                echo "<option value='$plaatplaat'>$plaatplaat</option>";
            }
            ?>
        </select>
        <input type="submit" value="Remove">
    </form>
</div>
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

// Check if a plaatplaat has been selected for removal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["plaatplaat"])) {
    $plaatplaat_id = $_POST["plaatplaat"];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("DELETE FROM praatplaten WHERE id = ?");
    $stmt->bind_param("i", $plaatplaat_id);

    // Execute statement
    if ($stmt->execute()) {
        echo "Plaatplaat with ID '$plaatplaat_id' has been removed successfully.";
    } else {
        echo "Error removing plaatplaat: " . $conn->error;
    }

    // Close statement
    $stmt->close();
} else {
}

// Close connection
$conn->close();
?>



</body>
</html>
