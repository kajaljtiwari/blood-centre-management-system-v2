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
    $adminid=$_SESSION['alogin'];
    $AName=$_POST['adminname'];
  $mobno=$_POST['mobilenumber'];
  $email=$_POST['email'];
  $sql="update tbladmin set AdminName=:adminname,MobileNumber=:mobilenumber,Email=:email where UserName=:aid";
     $query = $dbh->prepare($sql);
     $query->bindParam(':adminname',$AName,PDO::PARAM_STR);
     $query->bindParam(':email',$email,PDO::PARAM_STR);
     $query->bindParam(':mobilenumber',$mobno,PDO::PARAM_STR);
     $query->bindParam(':aid',$adminid,PDO::PARAM_STR);
$query->execute();

    echo '<script>alert("Your profile has been updated")</script>';
    echo "<script>window.location.href ='profile.php'</script>";

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

  <style>
	body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin top: 300;
            padding: 20px;
            margin-left: -20px;        
           margin-top: 0px;


        }
		/* Ensure content-wrapper has enough left margin to avoid being hidden behind the sidebar */
.content-wrapper {
    margin-left: 220px; /* Match your sidebar width */
    padding: 30px;
    background-color: #f8f9fa;
    min-height: 100vh;
	margin-top: 100px; /* Match your sidebar width */

}

/* Center the form panel inside the page */
.col-md-10 {
    margin: 0 auto;
    float: none;
}

/* Page Title Styling */
.page-title {
    text-align: center;
    font-size: 26px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
}

/* Panel Custom Style */
.panel {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-left: 5px solid #007bff;
    padding: 15px;
}

/* Panel Heading */
.panel-heading {
    background-color: #007bff;
    color: white;
    padding: 15px;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
    border-radius: 6px 6px 0 0;
}

/* Input field styling */
.form-control {
    border-radius: 6px;
    padding: 10px;
    font-size: 15px;
    border: 1.8px solid #ccc;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    background: #f8f9fa;
    outline: none;
}

/* Button styling */
.btn-primary {
    background: #007bff;
    border: none;
    padding: 10px 20px;
    font-weight: bold;
    border-radius: 5px;
    transition: 0.3s;
    text-transform: uppercase;
}

.btn-primary:hover {
    background: #0056b3;
}

/* Responsive fix */
@media (max-width: 768px) {
    .content-wrapper {
        margin-left: 0;
        padding: 20px;
    }

    .col-md-10 {
        width: 100%;
    }

    .form-horizontal .form-group {
        display: block;
        text-align: left;
    }

    .form-horizontal .control-label,
    .form-horizontal .col-sm-8 {
        width: 100%;
        text-align: left;
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
					
						<h2 class="page-title">Admin Profile</h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Form fields</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal" onSubmit="return valid();">
										
											
  	        	 <?php

$sql="SELECT * from  tbladmin";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
											
											<div class="hr-dashed"></div>
											
											<div class="form-group">
												<label class="col-sm-4 control-label">Admin Name</label>
												<div class="col-sm-8">
													<input type="text" name="adminname" value="<?php  echo $row->AdminName;?>" class="form-control" required='true'>
												</div>
											</div>
											<div class="hr-dashed"></div>

											<div class="form-group">
												<label class="col-sm-4 control-label">User Name</label>
												<div class="col-sm-8">
													<input type="text" name="username" value="<?php  echo $row->UserName;?>" class="form-control" readonly="">
												</div>
											</div>
											<div class="hr-dashed"></div>
										<div class="form-group">
												<label class="col-sm-4 control-label">Contact Number</label>
												<div class="col-sm-8">
													<input type="text" name="mobilenumber" value="<?php  echo $row->MobileNumber;?>"  class="form-control" maxlength='10' required='true' pattern="[0-9]+">
												</div>
											</div>
											<div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Email</label>
												<div class="col-sm-8">
													<input type="email" name="email" value="<?php  echo $row->Email;?>" class="form-control" required='true'>
												</div>
											</div>
											<div class="hr-dashed"></div>
								<div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Admin Registration Date</label>
												<div class="col-sm-8">
													 <input type="text" name="" value="<?php  echo $row->AdminRegdate;?>" readonly="" class="form-control">
												</div>
											</div>
											<div class="hr-dashed"></div>
											<?php $cnt=$cnt+1;}} ?>
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