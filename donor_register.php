<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $blood_group = $_POST["blood_group"];
    $age = $_POST["age"];
    $address = $_POST["address"];
    $donation_date = $_POST["donation_date"];

    // Insert donor data into the database
    $sql = "INSERT INTO donors (name, email, phone, blood_group, age, address, donation_date) 
            VALUES ('$name', '$email', '$phone', '$blood_group', '$age', '$address', '$donation_date')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Donor registered successfully!'); window.location.href='admin_dashboard.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Registration</title>
</head>
<body>
    <h2>Donor Registration Form</h2>
    <form method="post">
        Name: <input type="text" name="name" required><br>
        Email: <input type="email" name="email" required><br>
        Phone: <input type="text" name="phone" required><br>
        Blood Group:
        <select name="blood_group" required>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
        </select><br>
        Age: <input type="number" name="age" required><br>
        Address: <textarea name="address" required></textarea><br>
        Donation Date: <input type="date" name="donation_date" required><br>
        City:<input type="text" name="city" required><br>
        <button type="submit">Register</button>
    </form>
</body>

<!-- Footer -->
<?php include('includes/footer.php');?>

</html>