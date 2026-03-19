<?php
include 'db.php';
session_start();

// Teacher login-ai check seiyavum
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$selected_student = "";
$existing_marks = [];

// 1. Maanavar peyarai click seiyumpothu tharavugalai eduththal
if (isset($_GET['view_student'])) {
    $selected_student = $_GET['view_student'];
    $sql = "SELECT subject_name, marks FROM marks WHERE student_name = '$selected_student'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $existing_marks[$row['subject_name']] = $row['marks'];
    }
}

// 2. Mathippengalai semikkumpothu (Save/Update)
if (isset($_POST['submit_all_marks'])) {
    $student_name = $_POST['student_name'];
    $marks_array = $_POST['marks'];

    foreach ($marks_array as $subject => $mark) {
        if ($mark !== "") {
            // Grade calculation logic (35-54: S, 55-64: C, 65-74: B, 75-100: A)
            if ($mark >= 75) { $grade = "A"; }
            elseif ($mark >= 65) { $grade = "B"; }
            elseif ($mark >= 55) { $grade = "C"; }
            elseif ($mark >= 35) { $grade = "S"; }
            else { $grade = "W"; }

            // Unique Index irunthaal mattum ithu duplicate illamal update aagum
            $sql = "INSERT INTO marks (student_name, subject_name, marks, grade) 
                    VALUES ('$student_name', '$subject', '$mark', '$grade')
                    ON DUPLICATE KEY UPDATE marks = '$mark', grade = '$grade'";
            $conn->query($sql);
        }
    }
    echo "<script>alert('Marks Updated Successfully!'); window.location='teacher.php?view_student=$student_name';</script>";
}

$subjects = ["Mathematics", "Science", "History", "English", "Tamil", "ICT", "Geography", "Health"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Panel - School System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container { display: flex; gap: 20px; padding: 20px; align-items: flex-start; justify-content: center; }
        
        /* Student List Sidebar */
        .student-list { 
            width: 250px; 
            background: rgba(255, 255, 255, 0.1); 
            backdrop-filter: blur(15px);
            border-radius: 20px; 
            padding: 20px; 
            max-height: 85vh;
            overflow-y: auto;
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
        
        .student-item { 
            display: block; 
            padding: 12px; 
            margin-bottom: 8px; 
            background: rgba(255,255,255,0.1); 
            color: white; 
            text-decoration: none; 
            border-radius: 10px; 
            text-align: center;
            transition: 0.3s;
        }
        
        .student-item:hover, .active-student { 
            background: #4facfe; 
            font-weight: bold; 
            transform: scale(1.05); 
        }

        /* Marks Form Card */
        .marks-form { width: 450px; }
        .subject-row { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 10px; 
            background: rgba(255, 255, 255, 0.1); 
            padding: 10px; 
            border-radius: 10px; 
        }
        .mark-input { 
            width: 70px; 
            padding: 8px; 
            border-radius: 8px; 
            border: none; 
            text-align: center; 
            background: rgba(255, 255, 255, 0.2); 
            color: white; 
            outline: none;
        }
        .btn-glass {
            background: #4facfe;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="student-list">
        <h3 style="text-align: center;">Students List</h3>
        <hr style="opacity: 0.3;">
        <?php
        // ORDER BY LENGTH moolam student1, student2... student10 ena sariyaaga varum
        $query = "SELECT username FROM users WHERE role = 'student' ORDER BY LENGTH(username) ASC, username ASC";
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $name = $row['username'];
                $activeClass = ($selected_student == $name) ? "active-student" : "";
                echo "<a href='teacher.php?view_student=$name' class='student-item $activeClass'>$name</a>";
            }
        } else {
            echo "<p style='text-align:center;'>No students found.</p>";
        }
        ?>
        <div style="margin-top: 20px; text-align: center;">
            <a href="logout.php" style="color: #ff4d4d; text-decoration: none; font-size: 14px;">Logout</a>
        </div>
    </div>

    <div class="glass-card marks-form">
        <?php if ($selected_student == ""): ?>
            <h3>Teacher Panel</h3>
            <p>Please select a student from the list to view or edit marks.</p>
        <?php else: ?>
            <h3>Edit Marks</h3>
            <p>Student: <b><?php echo $selected_student; ?></b></p>
            <hr style="opacity: 0.3;">
            <form method="POST" action="">
                <input type="hidden" name="student_name" value="<?php echo $selected_student; ?>">
                
                <?php foreach ($subjects as $sub): ?>
                    <?php $val = isset($existing_marks[$sub]) ? $existing_marks[$sub] : ""; ?>
                    <div class="subject-row">
                        <span><?php echo $sub; ?></span>
                        <input type="number" name="marks[<?php echo $sub; ?>]" value="<?php echo $val; ?>" class="mark-input" placeholder="0-100" min="0" max="100">
                    </div>
                <?php endforeach; ?>
                
                <button type="submit" name="submit_all_marks" class="btn-glass">Save / Update Marks</button>
            </form>
        <?php endif; ?>
    </div>
</div>

</body>
</html>