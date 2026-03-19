<?php
// Session matrum Database-ai ore murai mattum start pannuvom
session_start();
include 'db.php';

// Login check
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$student_name = $_SESSION['username']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Panel - School System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container { width: 90%; max-width: 800px; margin: auto; padding-top: 50px; }
        .glass-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
            background: rgba(255, 255, 255, 0.1); 
            color: white;
            border-radius: 10px;
            overflow: hidden;
        }
        .glass-table th, .glass-table td { 
            padding: 15px; 
            text-align: center; 
            border-bottom: 1px solid rgba(255, 255, 255, 0.2); 
        }
        .logout-link { color: #ff4d4d; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <div class="glass-card" style="width: 100%;">
        <h2>My Examination Results</h2>
        <p>Welcome, <b><?php echo $student_name; ?></b>!</p>
        <hr>

        <table class="glass-table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Marks</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Marks fetch panna logic
                $sql = "SELECT subject_name, marks, grade FROM marks WHERE student_name='$student_name'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['subject_name'] . "</td>
                                <td>" . $row['marks'] . "</td>
                                <td>" . $row['grade'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No marks found yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <br>
        <div style="text-align: center;">
            <a href="logout.php" class="logout-link">Logout</a>
        </div>
    </div>
</div>

</body>
</html>