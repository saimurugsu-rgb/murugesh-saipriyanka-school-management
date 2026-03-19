<?php
// 1. Database connection link panrom
include 'db.php';

if (isset($_POST['signin'])) {
    
    // Form-la irunthu details-ai edukkuroam
    $user = $_POST['new_user'];
    $pass = $_POST['new_pass'];
    $role = $_POST['role'];

    // 2. Puthiya user-ai database-la save panna query
    $sql = "INSERT INTO users (username, password, role) VALUES ('$user', '$pass', '$role')";

    if ($conn->query($sql) === TRUE) {
        // Success aana login page-kku pogum
        echo "<script>alert('Registration Successful! Please Login.'); window.location='login.php';</script>";
    } else {
        // Error irunthaal kaattum
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>