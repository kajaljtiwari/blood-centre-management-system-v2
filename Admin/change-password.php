<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
// Code for change password	
if(isset($_POST['submit']))
	{
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$username=$_SESSION['alogin'];
$sql ="SELECT Password FROM tbladmin WHERE UserName=:username and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tbladmin set Password=:newpassword where UserName=:username";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Your Password succesfully changed";
}
else {
$error="Your current password is not valid.";	
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
	<meta name="theme-color" content="#3e454c">

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
	body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin top: 300;
            padding: 20px;
            margin-left: -20px;        
           margin-top: 55px;


        }

/* Success and Error Alert Styles */
.errorWrap,
.succWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    border-left: 4px solid;
    background: #f2f2f2;
    box-shadow: 0 1px 1px rgba(0,0,0,.1);
    font-size: 16px;
    font-weight: 500;
}

.errorWrap {
    border-color: #d9534f;
    color: #d9534f;
    background: #f9e2e2;
}

.succWrap {
    border-color: #5cb85c;
    color: #3c763d;
    background: #e2f9e2;
}

/* Page Title */
.page-title {
    font-size: 26px;
    font-weight: bold;
    color:rgb(96, 24, 184);
    margin-bottom: 20px;
	margin-top: 20px;

}

/* Panel Styles */
.panel {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 0 15px rgba(0,0,0,0.05);
}

.panel-heading {
    font-size: 18px;
    font-weight: 600;
    background-color: #f5f5f5;
    padding: 12px 20px;
    border-bottom: 1px solid #ddd;
    color: #333;
}

/* Form Labels */
.control-label {
    font-weight: bold;
    color: #333;
}

/* Form Inputs */
.form-control {
    border-radius: 4px;
    border: 1px solid #ccc;
    padding: 10px;
    font-size: 15px;
    transition: border 0.3s;
}

.form-control:focus {
    border-color:rgba(12, 226, 250, 0.94);
    outline: none;
    box-shadow: 0 0 5px rgba(217, 83, 79, 0.4);
}

/* Submit Button */
.btn-primary {
    background-color:rgb(8, 164, 191);
    border-color:rgb(9, 56, 224);
    font-weight: bold;
    padding: 10px 20px;
    transition: background-color 0.3s;
    font-size: 16px;
    border-radius: 4px;
}

.btn-primary:hover {
    background-color:rgb(13, 17, 125);
    border-color:rgb(37, 138, 172);
}

/* Divider */
.hr-dashed {
    border-top: 1px dashed #ccc;
    margin: 20px 0;
}

/* Responsive Panel */
@media (max-width: 768px) {
    .col-md-10 {
        padding: 0 15px;
    }
}
</style>


</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Change Password</h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Form fields</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
											<div class="form-group">
												<label class="col-sm-4 control-label">Current Password</label>
												<div class="col-sm-8">
													<input type="password" class="form-control" name="password" id="password" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
											
											<div class="form-group">
												<label class="col-sm-4 control-label">New Password</label>
												<div class="col-sm-8">
													<input type="password" class="form-control" name="newpassword" id="newpassword" required>
												</div>
											</div>
											<div class="hr-dashed"></div>

											<div class="form-group">
												<label class="col-sm-4 control-label">Confirm Password</label>
												<div class="col-sm-8">
													<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
										
								
											
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
								
													<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
												</div>
											</div>

										</form>

									</div>
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
<?php } ?>