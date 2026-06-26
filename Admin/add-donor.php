<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit']))
  {
    $fullname=$_POST['fullname'];
$mobile=$_POST['mobileno'];
$email=$_POST['emailid'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$blodgroup=$_POST['bloodgroup'];
$address=$_POST['address'];
$message=$_POST['message'];
$status=1;
    $password=md5($_POST['password']);
    $ret="select EmailId from tblblooddonars where EmailId=:email";
    $query= $dbh -> prepare($ret);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() == 0)
{
$sql="INSERT INTO  tblblooddonars(FullName,MobileNumber,EmailId,Age,Gender,BloodGroup,Address,Message,status,Password) VALUES(:fullname,:mobile,:email,:age,:gender,:blodgroup,:address,:message,:status,:password)";
$query = $dbh->prepare($sql);
$query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':age',$age,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':blodgroup',$blodgroup,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{

echo "<script>alert('You have signup  Scuccessfully');</script>";
}
else
{

echo "<script>alert('Something went wrong.Please try again');</script>";
}
}
 else
{

echo "<script>alert('Email-id already exist. Please try again');</script>";
}
}

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
</head>

<body>
<?php include('includes/header.php');?>

<style>
body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin top: 300;
            padding: 20px;
            margin-left: -20px;        
           margin-top: 55px;


        }

/* Right Side - Form */
.register-form {
    width: 45%;
    margin-left: 300px; /* Adjust for sidebar if needed */
    max-width: 450px;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
    max-height: 500px; /* Fix max height */
    overflow-y: auto; /* Scroll if needed */
    margin-top: 70px;

}

/* Form Heading */
.register-form h5 {
    text-align: center;
    font-size: 22px;
    font-weight: bold;
    color:rgb(11, 162, 218);
}

/* Input Fields */
.register-form input, 
.register-form select, 
.register-form textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px;
    font-size: 14px;
}

/* Register Button */
.register-form button {
    width: 100%;
    padding: 10px;
    background:rgba(8, 167, 164, 0.85);
    color: white;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

/* Button Hover */
.register-form button:hover {
    background:rgb(20, 160, 247);
}

/* Sign-in Link */
.account-w3ls a {
    color:rgb(6, 156, 242);
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
    .contact-image, .register-form {
        width: 90%;
        max-height: unset;
    }
}

</style>
<?php include('includes/leftbar.php');?>


<!-- Parent Container -->
<div class="contact-container">

    <!-- Right Side - Form -->
    <div class="register-form px-4 mx-auto mw-100">
        <h5 class="text-center mb-4">Register Now</h5>
        <form action="#" method="post" name="signup" onsubmit="return checkpass();">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name">
            </div>
            <div class="form-group">
                <label>Mobile Number</label>
                <input type="text" class="form-control" name="mobileno" id="mobileno" required="true" placeholder="Mobile Number" maxlength="10" pattern="[0-9]+">
            </div>
            <div class="form-group">
                <label class="mb-2">Email Id</label>
                <input type="email" name="emailid" class="form-control" placeholder="Email Id">
            </div>
            <div class="form-group">
                <label class="mb-2">Age</label>
                <input type="text" class="form-control" name="age" id="age" placeholder="Age" required="">
            </div>
            <div class="form-group">
                <label class="mb-2">Gender</label>
                <select name="gender" class="form-control" required>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label class="mb-2">Blood Group</label>
                <select name="bloodgroup" class="form-control" required>
                    <?php 
                        $sql = "SELECT * from tblbloodgroup";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        if($query->rowCount() > 0) {
                            foreach($results as $result) { ?>  
                                <option value="<?php echo htmlentities($result->BloodGroup);?>">
                                    <?php echo htmlentities($result->BloodGroup);?>
                                </option>
                    <?php }} ?>
                </select>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" name="address" id="address" required="true" placeholder="Address">
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea class="form-control" name="message" required></textarea>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" required="">
            </div>
            <button type="submit" class="btn btn-primary submit mb-4" name="submit">Register</button>
            <p class="account-w3ls text-center pb-4" style="color:#000">
            </p>
        </form>
    </div>


</div>

<!-- Footer -->
                            </body>
</html>

