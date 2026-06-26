<?php
session_start();
include('includes/config.php');
if(isset($_POST['submit']))
  {
    $email=$_POST['email'];
$mobile=$_POST['mobile'];
$newpassword=md5($_POST['newpassword']);
  $sql ="SELECT Email FROM tbladmin WHERE Email=:email and MobileNumber=:mobile";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tbladmin set Password=:newpassword where Email=:email and MobileNumber=:mobile";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Your Password succesfully changed');</script>";
}
else {
echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
}
}

?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	
	<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
	<style>
        
/* Background image styling */
.login-page {
    background-size: cover;
    background-position: center;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Container styling */
.form-content {
    background-color: rgba(255, 255, 255, 0.95);
    padding: 40px 30px;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    max-width: 500px;
    width: 100%;
    margin: auto;
}

/* Heading */
h1.text-center {
    color:rgb(164, 79, 217); /* Blood red tone */
    margin-bottom: 30px;
    font-weight: 700;
    font-size: 24px;
}

/* Form input fields */
.form-control {
    border-radius: 5px;
    border: 1px solid #ccc;
    padding: 12px 15px;
    font-size: 15px;
    margin-bottom: 15px;
    transition: border 0.3s;
}

.form-control:focus {
    border-color:rgb(181, 128, 126);
    box-shadow: 0 0 5px rgba(217, 83, 79, 0.5);
    outline: none;
}

/* Labels */
label {
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
    display: block;
}

/* Reset Button */
.btn-primary {
    background-color:rgba(30, 164, 63, 0.91);
    border: none;
    padding: 12px;
    font-weight: bold;
    border-radius: 5px;
    font-size: 16px;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color:rgba(169, 19, 14, 0.65);
}

/* Links */
a {
    display: inline-block;
    margin-top: 10px;
    color:rgba(195, 2, 216, 0.6);
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Footer */
.card-footer {
    text-align: center;
}

.card-footer .btn {
    background-color:rgba(40, 148, 243, 0.74);
    border: none;
    margin-top: 10px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .form-content {
        padding: 30px 20px;
        margin: 10px;
    }

    h1.text-center {
        font-size: 20px;
    }
}
</style>

</head>

<body>
	
	<div class="login-page bk-img" style="background-image: url(img/banner.png);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold text-light mt-4x">BloodBank Management System Forgot Password</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<form method="post" name="chngpwd" onsubmit="return checkpass();">

									<label for="" class="text-uppercase text-sm">Email </label>
									
									<input type="email" class="form-control mb" placeholder="Email Address" required="true" name="email">

									<label for="" class="text-uppercase text-sm">Mobile Number</label>
								<input type="text" class="form-control mb"  name="mobile" placeholder="Mobile Number" required="true" maxlength="10" pattern="[0-9]+">

								<label for="" class="text-uppercase text-sm">New Password</label>
								<input class="form-control mb" type="password" name="newpassword" placeholder="New Password" required="true"/>

								<label for="" class="text-uppercase text-sm">Confirm Password</label>
								<input class="form-control mb" type="password" name="confirmpassword" placeholder="Confirm Password" required="true" />

									<button class="btn btn-primary btn-block" name="submit" type="submit">Reset</button>
<a href="index.php" >signin</a>
								</form>
								<div class="card-footer text-center" style="padding-top: 30px;">
                                        <div class="small"><a href="../index.php" class="btn btn-primary">Back to Home</a></div>
                                    </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	

</body>

</html>