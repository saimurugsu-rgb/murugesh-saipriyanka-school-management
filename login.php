<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1546410531-bb4caa6b424d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1351&q=80');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        .glass-container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            color: white;
            width: 400px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            margin-bottom: 15px;
        }

        .form-control::placeholder { color: #ddd; }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            box-shadow: none;
        }

        .btn-glass {
            background: #4facfe;
            border: none;
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            color: white;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-glass:hover { background: #00f2fe; }
        
        hr { border-top: 1px solid rgba(255,255,255,0.3); }
    </style>
</head>
<body>

<div class="glass-container">
    <h2 class="text-center mb-4">Welcome</h2>
    
    <?php 
    if(isset($_GET['error'])) {
        echo '<p style="color: #ff4d4d; text-align: center; background: rgba(255,0,0,0.2); padding: 10px; border-radius: 10px; font-size: 14px;">
                Invalid Username or Password!
              </p>';
    }
    ?>

    <form action="login_process.php" method="POST">
        <h5 class="mb-3">Login</h5>
        <input type="text" name="username" class="form-control" placeholder="Username" required>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button type="submit" name="login" class="btn-glass">Login</button>
    </form>

    <hr class="my-4">

</div>

</body>
</html>