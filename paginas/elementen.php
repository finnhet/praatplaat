<?php
// Start session
session_start();

// Include the appropriate header based on session status
if (isset($_SESSION['username'])) {
    include '../extra/adminheader.php'; // Include admin header if session started

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elementen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            padding-top: 100px; /* Adjust as needed */
        }
        .board {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            height: 100%; /* Make sure all cards have the same height */
            display: flex;
            flex-direction: column;
        }
        .board img {
            max-width: 100%;
            max-height: 150px; 
            width: auto;
            height: auto; 
            border-radius: 5px;
            align-self: center; 
        }
        .board-content {
            flex-grow: 1; /* Allow the content to grow within the card */
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Space evenly between elements */
        }
        .board h2 {
            margin-top: 0;
            font-size: 18px;
            text-align: center; /* Center the heading */
        }
        .board p {
            margin: 5px 0;
            font-size: 14px;
            text-align: center; /* Center the paragraph */
        }
        .board:hover {
            transform: translateY(-4px);
        }
        .board a {
            color: inherit;
            text-decoration-line: none;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.9);
        }
        .modal-content {
            margin: auto;
            display: flex;
            width: 80%;
            max-width: 700px;
            position: relative;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
        }
        .close {
            position: absolute;
            top: 15px;
            right: 15px;
            color: #f1f1f1;
            font-size: 33px;
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
        }
        .modal-content img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .speak-button {
            padding: 8px 16px;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            align-self: center; /* Center the buttons horizontally */
        }
        .speak-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php
        include '../db.php'; // Include your database connection file

        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM elementen WHERE cat = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col'>";
                    echo "<div class='board' onclick='openModal(\"../fotos/" . $row['Foto'] . "\", \"" . $row['NaamNL'] . "\", \"" . $row['NaamFR'] . "\", \"" . $row['NaamEN'] . "\")'>";
                    echo "<img src='../fotos/" . $row['Foto'] . "' alt='" . $row['NaamEN'] . "'>";
                    echo "<div class='board-content'>";
                    echo "<h2>" . $row['NaamNL'] . "</h2>";
                    echo "<p>" . $row['NaamEN'] . "</p>";
                    echo "<p>" . $row['NaamFR'] . "</p>";
                    echo "<button class='speak-button' onclick='event.stopPropagation(); speakText(\"" . $row['NaamNL'] . "\", \"" . $row['NaamFR'] . "\", \"" . $row['NaamEN'] . "\", \"nl-NL\")'>Nederlands</button>";
                    echo "<button class='speak-button' onclick='event.stopPropagation(); speakText(\"" . $row['NaamNL'] . "\", \"" . $row['NaamFR'] . "\", \"" . $row['NaamEN'] . "\", \"en-US\")'>Engels</button>";
                    echo "</div>"; // .board-content
                    echo "</div>"; // .board
                    echo "</div>"; // .col
                }
            } else {
                echo "Geen items gevonden.";
            }
        } else {
            echo "Geen ID gevonden.";
        }

        $conn->close();
        ?>
         <?php if(isset($_SESSION['username'])): ?> <!-- Only show if logged in -->
        <div class='col'> <!-- ELEMENT TOEVOEG -->
            <div style="background-color: #32cd32; color: white" class='board' onclick="window.location.href = 'elementEdit.php';">
                <div class='board-content'>
                    <img src="../fotos/plusplus.png">
                    <h2>Nieuw</h2>
                    <h2>New</h2>
                    <h2>Nij</h2>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class='col'> <!-- TERUG -->
            <div style="background-color: crimson; color: white" class='board' onclick="window.location.href = 'index.php';">
                <div class='board-content'>
                    <img src="../fotos/arrow.png">
                    <h2>Terug</h2>
                    <h2>Back</h2>
                    <h2>Werom</h2>
                </div>
            </div>
        </div>
    </div> <!-- .row -->
</div> <!-- .container -->

<div id="myModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <div class="modal-content">
        <img id="modalImg" src="" alt="">
        <p id="modalNameNL"></p>
        <p id="modalNameEN"></p>
        <p id="modalNameFR"></p>
        <button class="speak-button" onclick="speakText(document.getElementById('modalNameNL').textContent.substring(12), document.getElementById('modalNameFR').textContent.substring(7), document.getElementById('modalNameEN').textContent.substring(8), 'nl-NL')">Speak Dutch</button>
        <button class="speak-button" onclick="speakText(document.getElementById('modalNameNL').textContent.substring(12), document.getElementById('modalNameFR').textContent.substring(7), document.getElementById('modalNameEN').textContent.substring(8), 'en-US')">Speak English</button>
    </div>
</div>

<script src="https://code.responsivevoice.org/responsivevoice.js?key=N5rOBfS7"></script>
<script>
    function speakText(nlText, frText, enText, lang) {
        switch(lang) {
            case 'nl-NL':
                responsiveVoice.speak(nlText, 'Dutch Female');
                break;
            case 'fr-FR':
                responsiveVoice.speak(frText, 'Frisian Male');
                break;
            default:
                responsiveVoice.speak(enText, 'UK English Male');
        }
    }

    function openModal(imageSrc, naamNL, naamFR, naamEN) {
        var modal = document.getElementById('myModal');
        var modalImg = document.getElementById("modalImg");
        var modalNameNL = document.getElementById("modalNameNL");
        var modalNameEN = document.getElementById("modalNameEN");
        var modalNameFR = document.getElementById("modalNameFR");
        modal.style.display = "block";
        modalImg.src = imageSrc;
        modalNameNL.textContent = "Nederlands: " + naamNL;
        modalNameEN.textContent = "Engels: " + naamEN;
        modalNameFR.textContent = "Fries: " + naamFR;
    }

    function closeModal() {
        var modal = document.getElementById('myModal');
        modal.style.display = "none";
    }
   // Add this function to handle clicks outside the modal content
   window.onclick = function(event) {
        var modal = document.getElementById('myModal');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>
</body>
</html>
