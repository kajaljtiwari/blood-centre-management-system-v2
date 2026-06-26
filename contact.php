
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['send']))
  {
$name=$_POST['fullname'];
$email=$_POST['email'];
$contactno=$_POST['contactno'];
$message=$_POST['message'];
$sql="INSERT INTO  tblcontactusquery(name,EmailId,ContactNumber,Message) VALUES(:name,:email,:contactno,:message)";
$query = $dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{

echo '<script>alert("Query Sent. We will contact you shortly.")</script>';
}
else 
{
echo "<script>alert('Something went wrong. Please try again.');</script>";  
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('includes/header.php');?>

<style>
.contact-section {
    display: flex;
    justify-content: center;
    align-items: stretch;
    gap: 30px;
    max-width: 1200px;
    margin: 50px auto;
    padding: 30px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    flex-wrap: wrap;
}

/* Left Side (Image) */
.contact-left {
    flex: 1;
    min-width: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.contact-left img {
    width: 100%;
    max-width: 500px;
    border-radius: 10px;
    object-fit: cover;
}

/* Right Side (Form) */
.contact-right {
    flex: 1;
    min-width: 300px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.contact-right h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.contact-right form {
    display: flex;
    flex-direction: column;
}

.contact-right input,
.contact-right textarea {
    padding: 12px 15px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
    width: 100%;
    box-sizing: border-box;
}

.contact-right input[type="submit"] {
    background-color: #e53935;
    color: white;
    font-weight: bold;
    border: none;
    cursor: pointer;
    transition: 0.3s;
}

.contact-right input[type="submit"]:hover {
    background-color: #c62828;
}

/* Responsive for smaller screens */
@media screen and (max-width: 768px) {
    .contact-section {
        flex-direction: column;
        padding: 20px;
    }

    .contact-left,
    .contact-right {
        width: 100%;
    }

    .contact-left img {
        max-width: 100%;
    }
}
</style>


<div class="container mt-5">
    <div class="text-center">
    </div>

    <div class="row mt-4">
        <!-- Left Column: Address & Image                   <p class="lead">We are here to assist you. Feel free to reach out!</p>        <div class="col-md-6 d-flex flex-column align-items-center">
            <h4 class="text-dark">Our Address</h4>
            <p><strong>Blood Bank Center</strong></p>
            <p>Shivshirsh, Opposite To Gajanan Hospital, Ramnagar, Akola, Maharashtra - 444001, India</p>
            <p>Email: <a href="mailto:akolabloodbank@gmail.com" class="text-danger">akolabloodbank@gmail.com</a></p>
            <p>Phone: <a href="tel:+1234567890" class="text-danger">+123 456 7890</a></p>
            <p>Working Hours: Mon - Sat (9:00 AM - 6:00 PM)</p>

 -->
 


<div class="contact-section">
  <div class="contact-left">
    <img src="images/bb.jpeg" alt="Blood Donation Image">
  </div>
  <div class="contact-right">
    <h2>Get In Touch</h2>
    <form action="#" method="post">
      <input type="text" name="fullname" placeholder="Your Name">
      <input type="tel" name="contactno" placeholder="Phone Number">
      <input type="email" name="email" placeholder="Email Address" required>
      <textarea name="message" rows="6" placeholder="Your Message"></textarea>
      <input type="submit" value="Send Message" name="send">
    </form>
				</div>
			</div>
		</div>
	</div>
	<!-- //contact -->


    <!-- Google Map -->
    <div class="mt-5">
        <h4 class="text-center text-dark">Find Us on Google Maps</h4>
        <div class="text-center">
            <iframe 
                src="https://maps.google.com/maps?q=Shivshirsh, Opposite To Gajanan Hospital, Ramnagar, Akola, Maharashtra 444001, India&output=embed" 
                width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>
</div>
	


	<?php include('includes/footer.php');?>

</body>

</html>