<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
$username=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT UserName,Password FROM tbladmin WHERE UserName=:username and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

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

	
</head>

<body>
	<style>

		/* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body */
body {
    font-family: 'Arial', sans-serif;
    background: #f4f4f4;
}

/* Background Image */
.login-page {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-size: cover;
    background-position: center;
}

/* Login Form Container */
.form-content {
    background: rgba(255, 255, 255, 0.9);
    padding: 50px;
    border-radius: 30px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
    text-align: center;
}

/* Headings */
h1 {
    font-size: 20px;
    color: #333;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Label Styling */
label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
	text-align: left; /* Text moves to right */

}

/* Input Box Styling */
input[type="text"], 
input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    background: #f0f6ff; /* Light Blue Background */
    padding-right: 15px; /* Add space from right */
}


/* Button Styling */
button {
    width: 100%;
    padding: 10px;
    background: #007bff;
    border: none;
    color: white;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    transition: 0.3s;
}

button:hover {
    background: #0056b3;
}

/* Forgot Password Link */
a {
    display: block;
    margin-top: 10px;
    text-decoration: none;
    color: #007bff;
    font-size: 14px;
}

a:hover {
    color: #0056b3;
}

/* Footer Link */
.card-footer {
    margin-top: 20px;
}

.card-footer a {
    display: inline-block;
    padding: 10px 15px;
    background: #28a745;
    color: white;
    border-radius: 5px;
    font-size: 14px;
}

.card-footer a:hover {
    background: #218838;
}

/* Responsive */
@media (max-width: 768px) {
    .form-content {
        width: 90%;
        max-width: 350px;
    }
}

		</style>

	<div class="login-page bk-img" style="background-image: url(img/banner.png);">
		<div class="form-content">
			<div class="container">
				<div class="row">
				<h1 class="text-center text-bold text-light mt-4x">BloodBank Management System Sign in</h1>

					<div class="col-md-6 col-md-offset-3">
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<form method="post">
								
									<label for="" class="text-uppercase text-sm">Your Username </label>
									<input type="text" placeholder="Username" name="username" class="form-control mb">

									<label for="" class="text-uppercase text-sm">Password</label>
									<input type="password" placeholder="Password" name="password" class="form-control mb">

								

									<button class="btn btn-primary btn-block" name="login" type="submit">LOGIN</button>
<a href="forgot-password.php" >Forgot Password</a>
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