<?php
$conn = new mysqli("localhost", "root", "", "bbdms");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userMsg = strtolower(trim($_POST['message']));
    $likeMsg = "%" . $userMsg . "%";

    // Improved fuzzy matching: LIKE and SOUNDEX
    $stmt = $conn->prepare("SELECT answer FROM faq WHERE LOWER(question) LIKE ? OR SOUNDEX(question) = SOUNDEX(?) LIMIT 1");
    $stmt->bind_param("ss", $likeMsg, $userMsg);
    $stmt->execute();
    $stmt->bind_result($reply);

    if ($stmt->fetch()) {
        echo $reply;
    } else {
        echo "Sorry, I don’t have an answer for that.";
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>



