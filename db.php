<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_db";

// Connection create panrom
$conn = new mysqli($servername, $username, $password, $dbname);

// Connection success-ah nu check panrom
if ($conn->connect_error) {
    // Connection fail aana error message kaattum
    die("Connection failed: " . $conn->connect_error);
}

// Inga ethuvum print panna thevai illai, success aana blank page thaan varum
?>