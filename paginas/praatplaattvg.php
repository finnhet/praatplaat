<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "praatplaat";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, NaamNL FROM praatplaten";
$result = $conn->query($sql);


if ($result) {
    
    if ($result->num_rows > 0) {
       
        while ($row = $result->fetch_assoc()) {
          
            echo "<option value='" . $row["id"] . "'>" . $row["NaamNL"] . "</option>";
        }
    } else {
      
        echo "<option disabled>No praatplaten found</option>";
    }
} else {
  
    echo "Error: " . $conn->error;
}


$conn->close();
?>
