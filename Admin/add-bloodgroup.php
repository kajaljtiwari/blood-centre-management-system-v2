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
$bloodgroup=$_POST['bloodgroup'];
$sql="INSERT INTO  tblbloodgroup(BloodGroup) VALUES(:bloodgroup)";
$query = $dbh->prepare($sql);
$query->bindParam(':bloodgroup',$bloodgroup,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Blood Group Created successfully";
}
else 
{
$error="Something went wrong. Please try again";
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
	

  <style>
    body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin top: 300;
            padding: 20px;
            margin-left: -20px;        
           margin-top: 1px;


        }

/* Main Content Wrapper */
.content-wrapper {
    margin-left: 250px; /* Adjusting for sidebar */
    padding: 20px;
    background: #f4f4f4;
    min-height: 100vh;
    margin-top: 80px;

}

/* Page Title */
.page-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Panel Styling */
.panel {
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    background: white;
    margin-bottom: 20px;
}

.panel-heading {
    background: #007bff;
    color: white;
    font-size: 18px;
    font-weight: bold;
    padding: 10px;
    border-bottom: 2px solid #0056b3;
}

/* Form Styling */
.form-horizontal {
    padding: 20px;
}

.form-group {
    margin-bottom: 15px;
}

/* Form Labels */
.control-label {
    font-weight: bold;
    color: #333;
}

/* Form Inputs */
.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    background: #f8f9fa;
}

.form-control:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Button */
.btn-primary {
    background: #007bff;
    border: none;
    padding: 10px 15px;
    font-size: 16px;
    border-radius: 5px;
    color: white;
    transition: 0.3s;
}

.btn-primary:hover {
    background: #0056b3;
}

/* Success & Error Messages */
.succWrap, .errorWrap {
    padding: 10px;
    border-radius: 5px;
    font-size: 14px;
    margin-bottom: 15px;
}

.succWrap {
    background: #d4edda;
    color: #155724;
    border-left: 5px solid #28a745;
}

.errorWrap {
    background: #f8d7da;
    color: #721c24;
    border-left: 5px solid #dc3545;
}

/* Responsive Fix */
@media (max-width: 768px) {
    .content-wrapper {
        margin-left: 0;
    }

    .panel {
        width: 100%;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .btn-primary {
        width: 100%;
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
					
						<h2 class="page-title">Add Blood Group </h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Form fields</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
											<div class="form-group">
												<label class="col-sm-4 control-label">Blood Group</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="bloodgroup" id="bloodgroup" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
											
										
								
											
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
								
													<button class="btn btn-primary" name="submit" type="submit">Submit</button>
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