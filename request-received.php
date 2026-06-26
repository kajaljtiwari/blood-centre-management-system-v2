
<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['bbmsdid']==0)) {
  header('location:logout.php');
  } else{



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
    /* General Styles */
body 
/* ========== Search Form Styling ========== */
.appointment {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.appointment.h2 {
    text-align: center;
    color: #d9534f;
    margin-bottom: 20px;
}

.appointment.form {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.appointment .row {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.appointment.col-md-4 {
    width: 30%;
    margin-bottom: 15px;
}

.appointment.label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

.appointment.form-control {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* ========== Search Button Styling ========== */


/* ========== Search Results Table Styling ========== */
.table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

.table th, .table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

.table th {
    background: #d9534f;
    color: white;
}

.table tr:nth-child(even) {
    background: #f2f2f2;
}

/* No Donors Found Message */
.text-danger {
    color: red;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
}


    </style>



	<!-- contact -->
	<div class="appointment py-5">
		<div class="py-xl-5 py-lg-3">
			<div class="w3ls-titles text-center mb-5">
				<h1 class="title">Request Received</h1>
				<span>
					<i class="fas fa-user-md"></i>
				</span>
			</div>
			<div class="d-flex">
				
				<div class="contact-right-w3l appoint-form" style="width:100% !important;">
					<h5 class="title-w3 text-center mb-5">Below is the detail of Blood Requirer.</h5>
					<table border="1" class="table table-bordered">
                                    <thead>
                                         <tr>
                                         	<th>S.No</th>
                                          
                                            <th>Name</th>
                                            <th>Mobile Number</th>
                                            <th>Email</th>
                                            <th>Blood Require For</th>
                                            <th>Message</th>
                                            <th>Apply Date</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                       
                                        <tr><?php
                                          $uid=$_SESSION['bbmsdid'];
$sql="SELECT tblbloodrequirer.BloodDonarID,tblbloodrequirer.name,tblbloodrequirer.EmailId,tblbloodrequirer.ContactNumber,tblbloodrequirer.BloodRequirefor,tblbloodrequirer.Message,tblbloodrequirer.ApplyDate,tblblooddonars.id as donid from  tblbloodrequirer join tblblooddonars on tblblooddonars.id=tblbloodrequirer.BloodDonarID where tblbloodrequirer.BloodDonarID=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                            <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php  echo htmlentities($row->name);?></td>
                                             <td><?php  echo htmlentities($row->ContactNumber);?></td>
                                             <td><?php  echo htmlentities($row->EmailId);?></td>
                                          <td><?php  echo htmlentities($row->BloodRequirefor);?></td>
                                          
                     
                 <td><?php  echo htmlentities($row->Message);?> 
                  </td>
                               
                                            <td>
                                              <?php  echo htmlentities($row->ApplyDate);?>  
                                            </td>
                                        </tr>
                                    <?php $cnt=$cnt+1;}} else {?>
                                        <tr>
                                            <th colspan="8" style="color:red;"> No Record found</th>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
				</div>
				<div class="clerafix"></div>
			</div>
		</div>
	</div>
	<!-- //contact -->

	<?php include('includes/footer.php');?>
	
</body>

</html><?php } ?>