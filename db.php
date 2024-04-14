<?php
$servername = "localhost"; // of het IP-adres van je MySQL-server
$username = "deb85590_p32k1tb"; // je MySQL-gebruikersnaam
$password = "7v5UgRa9DGXdRRtn4tGN"; // je MySQL-wachtwoord
$dbname = "deb85590_p32k1tb"; // de naam van je database

// Maak een verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}
