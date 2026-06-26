<?php 
error_reporting(0);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood centre Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #fff0f0;
}

/* HEADER */
header {
    background-color: rgb(255, 8, 0);
    padding: 20px;
    text-align: center;
    color: white;
    position: relative;
}
header img.logo {
    position: absolute;
    left: 20px;
    top: 15px;
    width: 90px;
}
header h1 {
    margin: 0;
}

/* NAVIGATION */
nav {
    background: #fff;
    padding: 10px 0;
    display: flex;
    justify-content: center;
    gap: 15px;
    align-items: center;
}
nav a {
    color: black;
    text-decoration: none;
    padding: 10px 15px;
    font-size: 18px;
    transition: 0.3s;
}
nav a:hover {
    color: blue;
    font-size: 19px;
}

/* DROPDOWN MENU */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 150px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    z-index: 1;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown-content a {
    padding: 10px;
    display: block;
    text-align: left;
    color: black;
}
.dropdown-content a:hover {
    background: #f5f5f5;
}

/* FOOTER */
footer {
    background: #333;
    color: white;
    text-align: center;
    padding: 15px;
    position: fixed;
    bottom: 0;
    width: 100%;
}
</style>

<header>
    <img src="images/Bloodlogo.png" alt="Blood Bank Logo" class="logo">
    <h1>Blood Centre Management System</h1>
    <p>Donate Blood, Save Lives</p>
</header>

<!-- NAVIGATION MENU -->
<nav>
    <a href="index.php">Home</a>
    <a href="about.php">About Us</a>
    <a href="search-donor.php">Search Donor</a>
    <a href="contact.php">Contact</a>
    <a href="donor-list.php">Donor List</a>
    <a href="feedback.php">Feedback</a>
    <a href="admin/index.php">Admin</a>

    <?php 
    // Agar user logged in hai to "My Account" dikhayega
    if(isset($_SESSION['bbmsdid']) && !empty($_SESSION['bbmsdid'])) { ?>
        <div class="dropdown">
            <a href="#">My Account ▼</a>
            <div class="dropdown-content">
                <a href="profile.php">Profile</a>
                <a href="change-password.php">Change Password</a>
                <a href="request-received.php">Request Received</a>
                <a href="myhistory.php">My History</a>

                <a href="logout.php">Logout</a>
            </div>
        </div>
    <?php } else { ?>
        <!-- Agar user logged in nahi hai to Login button dikhayega -->
        <a href="login.php">Login</a>
    <?php } ?>

    <!-- Admin ka link hamesha dikhna chahiye -->

</nav>

</body>
</html>
