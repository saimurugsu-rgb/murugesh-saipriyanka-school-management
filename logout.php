<?php
session_start();
// Session-ai azhikkavum
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout - School System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .logout-card {
            text-align: center;
            padding: 40px;
        }
        .logout-btn {
            background: #ff4d4d;
            border: none;
            padding: 12px 25px;
            color: white;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="glass-card logout-card">
    <h2 style="color: white;">Logout Successful</h2>
    <p>You have been safely logged out of your account.</p>
    
    <a href="login.php" class="logout-btn">Return to Login</a>
</div>

</body>
</html>