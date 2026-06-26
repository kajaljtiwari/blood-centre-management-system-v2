<?php session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['login'])) 
  {
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $sql ="SELECT id FROM tblblooddonars WHERE EmailId=:email and Password=:password";
    $query=$dbh->prepare($sql);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
{
foreach ($results as $result) {
$_SESSION['bbmsdid']=$result->id;
}
$_SESSION['login']=$_POST['email'];
echo "<script type='text/javascript'> document.location ='index.php'; </script>";
} else{
echo "<script>alert('Invalid Details');</script>";
}
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>

</head>

<body>
<style>
/* Parent Container for Image & Form */
.contact-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 30px;
    padding: 50px;
}

/* Left Side - Image */
.contact-image {
    width: 45%;
}

.contact-image img {
    width: 100%;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

/* Right Side - Form */
.login {
    width: 45%;
    max-width: 400px;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
}

/* Form Heading */
.login h5 {
    text-align: center;
    font-size: 22px;
    font-weight: bold;
    color: #d9534f;
}

/* Input Fields */
.login input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 15px;
    font-size: 16px;
}

/* Login Button */
.login button {
    width: 100%;
    padding: 12px;
    background: #d9534f;
    color: white;
    font-size: 18px;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

/* Button Hover */
.login button:hover {
    background: #c9302c;
}

/* Sign-up Link */
.account-w3ls a {
    color: #d9534f;
    font-weight: bold;
    text-decoration: none;
}

.account-w3ls a:hover {
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 768px) {
    .contact-container {
        flex-direction: column;
        text-align: center;
    }
    .contact-image, .login {
        width: 90%;
    }
}
</style>



	<?php include('includes/header.php');?>

	<!-- Parent Container -->
<div class="contact-container">

<!-- Left Side - Image -->
<div class="contact-image">
    <img src="images/loginimg2.png" alt="Blood Donation">
</div>

<!-- Right Side - Form -->
<div class="login px-4 mx-auto mw-100">
    <h5 class="text-center mb-4">Login Now</h5>
    <form action="#" method="post" name="login">
        <div class="form-group">
            <label>Email ID</label>
            <input type="email" class="form-control" name="email" placeholder="Enter your email" required="">
        </div>
        <div class="form-group">
            <label class="mb-2">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required="">
        </div>
        <button type="submit" class="btn submit mb-4" name="login">Login</button>
        <p class="account-w3ls text-center pb-4" style="color:#000">
            Don't have an account? <a href="sign-up.php">Create one now</a>
        </p>
    </form>
</div>

</div>



<!-- Footer -->
<?php include('includes/footer.php');?>


</body>

</html>