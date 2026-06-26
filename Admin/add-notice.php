
<?php
$conn = new mysqli("localhost", "root", "", "bbdms");

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $message = trim($_POST["message"]);

    if (!empty($title) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO notices (title, message, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $title, $message);
        $stmt->execute();
        $msg = "✅ Notice added successfully!";
    } else {
        $msg = "❌ Please fill in both Title and Message!";
    }
}
?>

<!-- Add Notice Form -->
<!DOCTYPE html>
<html>
<head>
    <title>Add Notice</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            padding: 30px;
            margin-top: 70px;
            margin-left: -30px; /* or whatever your sidebar width is */

        }
        .form-container {
            background: #fff;
            padding: 25px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .form-container h2 {
            margin-top: 0;
            color:rgba(0, 130, 230, 0.79);
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 12px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }
        input[type="submit"] {
            background-color:rgba(16, 74, 166, 0.78);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .message {
            margin-top: 15px;
            font-weight: bold;
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<?php include('includes/header.php');?>

<body>

<?php include('includes/leftbar.php');?>


    <div class="form-container">
        <h2>Add Notice</h2>
        <form method="post" action="">
            <label>Title:</label>
            <input type="text" name="title" required>

            <label>Message:</label>
            <textarea name="message" rows="4" required></textarea>

            <input type="submit" value="Add Notice">
        </form>

        <?php if ($msg): ?>
            <p class="message <?= strpos($msg, '❌') !== false ? 'error' : '' ?>"><?= $msg ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
