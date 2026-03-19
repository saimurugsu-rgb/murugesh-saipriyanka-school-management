<?php
session_start(); // Intha line-ai mela add pannunga
include 'db.php';

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Session-la username-ai save panrom
        $_SESSION['username'] = $row['username'];
        $role = $row['role'];

        if ($role == 'teacher') {
            header("Location: teacher.php");
        } else {
            header("Location: student.php");
        }
        exit();
    } else {
        header("Location: login.php?error=1");
        exit();
    }
}
?>

<?php
include 'db.php';

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Database check logic
    $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $role = $row['role'];

        if ($role == 'teacher') {
            header("Location: teacher.php");
        } else {
            header("Location: student.php");
        }
        exit();
    } else {
        // Redirection to same page with error parameter
        header("Location: login.php?error=1");
        exit();
    }
}
?>