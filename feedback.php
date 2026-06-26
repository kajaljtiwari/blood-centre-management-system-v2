<?php
$conn = new mysqli("localhost", "root", "", "bbdms");
$thankYou = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    if (isset($_POST['rating']) && in_array($_POST['rating'], ['1', '2', '3', '4', '5'])) {
        $rating = (int)$_POST['rating'];

        $stmt = $conn->prepare("INSERT INTO feedback (name, email, message, rating) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $name, $email, $message, $rating);

        if ($stmt->execute()) {
            // Use redirect to prevent form resubmission
            header("Location: " . $_SERVER['PHP_SELF'] . "?thanks=1");
            exit();
        }
    } else {
        $thankYou = "<div style='color:red;text-align:center;'>❌ Please select a valid rating between 1 and 5.</div>";
    }
}

// Show thank you if redirected back
if (isset($_GET['thanks'])) {
    $thankYou = "<div style='text-align:center;padding:20px;color:green;font-size:18px;'>⭐ Thank you for your feedback!</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback</title>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f5f5f5;
        }

        .main-content {
            flex: 1;
        }

        .contact-section {
            display: flex;
            justify-content: space-between;
            align-items: stretch;
            max-width: 1100px;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            overflow: hidden;
            flex-wrap: wrap;
        }

        .contact-left {
            flex: 1;
            min-width: 300px;
            padding-right: 15px;
            box-sizing: border-box;
        }

        .contact-left img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .contact-right {
            flex: 1;
            padding: 30px;
            margin-left: 15px;
            box-sizing: border-box;
        }

        .feedback-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #e60000;
        }

        .feedback-form input, .feedback-form textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .feedback-form button {
            width: 100%;
            background: #e60000;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .feedback-form button:hover {
            background: #cc0000;
        }

        .star-rating {
            direction: rtl;
            font-size: 24px;
            unicode-bidi: bidi-override;
            display: flex;
            justify-content: flex-start;
            gap: 5px;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: gold;
        }

        @media screen and (max-width: 768px) {
            .contact-section {
                flex-direction: column;
            }

            .contact-left, .contact-right {
                width: 100%;
            }

            .contact-left img {
                height: 300px;
            }
        }
    </style>
</head>
<body>

<?php include('includes/header.php'); ?>

<div class="main-content">
    <?= $thankYou ?>

    <div class="contact-section">
        <div class="contact-left">
            <img src="images/feedback4.jpeg" alt="Blood Donation Image">
        </div>
        <div class="contact-right">
            <form method="post" action="" class="feedback-form">
                <h2>Feedback Form</h2>
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Feedback" rows="4" required></textarea>

                <label style="margin-top:10px;">Rate Us:</label>
                <div class="star-rating">
                    <input type="radio" name="rating" value="5" id="star5" required><label for="star5">★</label>
                    <input type="radio" name="rating" value="4" id="star4"><label for="star4">★</label>
                    <input type="radio" name="rating" value="3" id="star3"><label for="star3">★</label>
                    <input type="radio" name="rating" value="2" id="star2"><label for="star2">★</label>
                    <input type="radio" name="rating" value="1" id="star1"><label for="star1">★</label>
                </div>

                <br>
                <button type="submit">Submit Feedback</button>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>