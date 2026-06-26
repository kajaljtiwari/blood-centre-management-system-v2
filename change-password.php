
<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['bbmsdid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['change']))
{
$uid=$_SESSION['bbmsdid'];
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$sql ="SELECT ID FROM tblblooddonars WHERE id=:uid and Password=:cpassword";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uid', $uid, PDO::PARAM_STR);
$query-> bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);

if($query -> rowCount() > 0)
{
$con="update tblblooddonars set Password=:newpassword where id=:uid";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':uid', $uid, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();

echo '<script>alert("Your password successully changed")</script>';
} else {
echo '<script>alert("Your current password is wrong")</script>';

}
}

  ?>
<!DOCTYPE html>
<html lang="zxx">

<head>

	<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
}   

</script>

	
</head>

<body>
	<?php include('includes/header.php');?>


    <style>

        

/* Change Password Page Styling */

        /* Right Side: Form 
        .appoint-form {
            flex: 1;
            max-width: 550px;
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }*/
        .appoint-form {
    max-width: 1000px;
    margin: 50px auto;
    padding: 20px;
    background: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}
        .appoint-form h5 {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: #d9534f;
        }

        .appoint-form input, 
        .appoint-form select, 
        .appoint-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        /* Button Styling */
        .btn_apt {
            background: #dc3545;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .btn_apt:hover {
            background: #c82333;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-container {
                flex-direction: column;
                text-align: center;
            }
            .contact-image, .appoint-form {
                width: 100%;
            }
        }



    </style>












	<!-- contact -->
	<div class="appointment py-5">
		<div class="py-xl-5 py-lg-3">
			<div class="w3ls-titles text-center mb-5">
				<span>
					<i class="fas fa-user-md"></i>
				</span>
			</div>
			<div class="d-flex">
				<div class="appoint-img">

				</div>
				<div class="contact-right-w3l appoint-form">
                <h1 class="title">Change Password</h1>

					<h5 class="title-w3 text-center mb-5">Reset your password if needed</h5>
					<form action="#" method="post" onsubmit="return checkpass();" name="changepassword">
						
						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Current Password</label>
							<input type="password" class="form-control" name="currentpassword" id="currentpassword"required='true'>
						</div>
						<div class="form-group">
							<label for="recipient-phone" class="col-form-label">New Password</label>
							<input type="password" name="newpassword"  class="form-control" required="true">
						</div>
						<div class="form-group">
							<label for="recipient-phone" class="col-form-label">Confirm Password</label>
							<input type="password" class="form-control" name="confirmpassword" id="confirmpassword"  required='true'>
						</div>
						
						<input type="submit" value="Update" name="change" class="btn_apt">
					</form>
				</div>
				<div class="clerafix"></div>
			</div>
		</div>
	</div>
	<!-- //contact -->

	<?php include('includes/footer.php');?>

	
</body>

</html><?php } ?>

























