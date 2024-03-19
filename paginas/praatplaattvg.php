<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
    $username = "root"; // Replace with your MySQL username
    $password = ""; // Replace with your MySQL password
    $database = "praatplaat"; 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if file is uploaded successfully
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $targetDir = '../fotos/';
        $targetFile = $targetDir . basename($_FILES['foto']['name']);

        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile)) {
            // Prepare and bind parameters
            $stmt = $conn->prepare("INSERT INTO praatplaten (Foto, NaamNL, NaamFR, NaamEN) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $foto, $naam_nl, $naam_fr, $naam_en);

            // Set parameters and execute
            $foto = file_get_contents($targetFile); // Read file content
            $naam_nl = $_POST['naam_nl'];
            $naam_fr = $_POST['naam_fr'];
            $naam_en = $_POST['naam_en'];

            if ($stmt->execute()) {
                // Redirect back to praatplaat.php
                header("Location: praatplaat.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No file uploaded or an error occurred.";
    }

    // Close connection
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item to Praatplaten Database</title>
    <?php
    include '../extra/adminheader.php';
    ?>
    <style>
      
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    width: 50%;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 30px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 10px;
}

input[type="file"],
input[type="text"],
input[type="submit"] {
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

input[type="submit"] {
    background-color: #4caf50;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>

<div class="container">
    <h2>Add Item to Praatplaten Database</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <label for="foto">Foto:</label><br>
        <input type="file" id="foto" name="foto"><br>
        <label for="naam_nl">Naam (NL):</label><br>
        <input type="text" id="naam_nl" name="naam_nl"><br>
        <label for="naam_fr">Naam (FR):</label><br>
        <input type="text" id="naam_fr" name="naam_fr"><br>
        <label for="naam_en">Naam (EN):</label><br>
        <input type="text" id="naam_en" name="naam_en"><br><br>
        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
