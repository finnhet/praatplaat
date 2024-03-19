<?php
$servername = "localhost"; // of het IP-adres van je MySQL-server
$username = "root"; // je MySQL-gebruikersnaam
$password = ""; // je MySQL-wachtwoord
$dbname = "praatplaat"; // de naam van je database

// Maak een verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}
