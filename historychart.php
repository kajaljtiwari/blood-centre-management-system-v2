<?php
session_start();
include('includes/config.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT ID FROM tbladmin WHERE UserName = :username AND Password = :password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $_SESSION['bbmsaid'] = $result['ID']; // ✅ Use consistent session name
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - BloodBank</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f4f4f4;
        }

        .login-page {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('img/banner.png');
            background-size: cover;
            background-position: center;
        }

        .form-content {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            font-size: 22px;
            color: #d9534f;
            margin-bottom: 25px;
            text-align: center;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
            text-align: left;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background: #f7fbff;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #d9534f;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #c9302c;
        }

        a {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        .back-home {
            margin-top: 25px;
            text-align: center;
        }

        .back-home a {
            background: #28a745;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
        }

        .back-home a:hover {
            background: #218838;
        }
    </style>
</head>
<body>
<div class="login-page">
    <div class="form-content">
        <h1>🩸 BloodBank Admin Login</h1>
        <form method="post">
            <label>Username</label>
            <input type="text" name="username" placeholder="Enter Username" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter Password" required>

            <button name="login" type="submit">LOGIN</button>
        </form>
        <a href="forgot-password.php">Forgot Password?</a>
        <div class="back-home">
            <a href="../index.php">Back to Home</a>
        </div>
    </div>
</div>
</body>
</html>
