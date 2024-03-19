<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Plaatplaten Management</title>
<?php
include '../extra/adminheader.php'
?>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .container {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        margin-bottom: 30px;
    }
    .button {
        display: block;
        width: 100%;
        max-width: 200px;
        margin: 0 auto 20px;
        padding: 12px 24px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        text-align: center;
        transition: background-color 0.3s;
    }
    .button:hover {
        background-color: #0056b3;
    }
    form {
        text-align: center;
        margin-top: 30px;
    }
    label {
        font-weight: bold;
    }
    select {
        display: block;
        width: 100%;
        max-width: 300px;
        margin: 0 auto 20px;
        padding: 12px;
        border-radius: 5px;
        border: 1px solid #ccc;
        text-align-last: center;
    }
    input[type="submit"] {
        display: block;
        width: 100%;
        max-width: 200px;
        margin: 0 auto;
        padding: 12px 24px;
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
    
    <a href="praatplaattvg.php" class="button">Add Plaatplaat</a>
    <a href="change_plaatplaat.php" class="button">Change Plaatplaat</a>

    <form id="removeForm" method="post">
        <label for="plaatplaat">Select Plaatplaat to Remove:</label>
        <?php
      
        include '../extra/adminheader.php';

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

        // Fetch data from the database
        $sql = "SELECT id, NaamNL FROM praatplaten";
        $result = $conn->query($sql);

        // Check if there are rows returned
        if ($result->num_rows > 0) {
            // Output data of each row
            echo '<select name="plaatplaat" id="plaatplaat">';
            while($row = $result->fetch_assoc()) {
                echo '<option value="' . $row["id"] . '">' . $row["NaamNL"] . '</option>';
            }
            echo '</select>';
        } else {
            echo "0 results";
        }

        // Close connection
        $conn->close();
        ?>

        <input type="button" id="removeButton" value="Remove">
    </form>
</div>

<script>
document.getElementById("removeButton").addEventListener("click", function() {
    var plaatplaatId = document.getElementById("plaatplaat").value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../extra/vwdpraatplaat.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert(xhr.responseText);
        }
    };
    xhr.send("plaatplaat=" + plaatplaatId);
});
</script>

</body>
</html>
