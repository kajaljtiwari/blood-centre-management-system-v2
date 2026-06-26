<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_REQUEST['hidden']))
	{
$eid=intval($_GET['hidden']);
$status="0";
$sql = "UPDATE tblblooddonars SET Status=:status WHERE  id=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();

$msg="Donor details hidden Successfully";
}


if(isset($_REQUEST['public']))
	{
$aeid=intval($_GET['public']);
$status=1;

$sql = "UPDATE tblblooddonars SET Status=:status WHERE  id=:aeid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
$query -> execute();

$msg="Donor details public";
}
//Code for Deletion
if(isset($_REQUEST['del']))
	{
$did=intval($_GET['del']);
$sql = "delete from tblblooddonars WHERE  id=:did";
$query = $dbh->prepare($sql);
$query-> bindParam(':did',$did, PDO::PARAM_STR);
$query -> execute();

$msg="Record deleted Successfully ";
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
	/* General Page Styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
	margin-top: 100px;

}

/* Page Title */
h2.page-title {
    background: rgb(4, 98, 193);
    color: #fff;
    padding: 12px 15px;
    border-radius: 5px;
}

/* Success & Error Message Styling */
.succWrap, .errorWrap {
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    font-size: 16px;
    text-align: center;
}

.succWrap {
    background: #28a745;
    color: #fff;
}

.errorWrap {
    background: #dc3545;
    color: #fff;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

table thead {
    background: #0462c1;
    color: #fff;
    font-weight: bold;
}

table th, table td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

table tbody tr:hover {
    background: #f1f1f1;
}

/* Button Styling */
.btn {
    display: inline-block;
    padding: 8px 15px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s;
}

.btn-info {
    background: #17a2b8;
    color: #fff;
}

.btn-primary {
    background: #007bff;
    color: #fff;
}

.btn-danger {
    background: #dc3545;
    color: #fff;
}

.btn:hover {
    opacity: 0.8;
}

/* Panel Box */
.panel {
    background: #fff;
    border-radius: 5px;
    padding: 15px;
    margin: 15px 0;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.panel-heading {
    background: rgb(4, 98, 193);
    color: #fff;
    padding: 10px;
    font-size: 18px;
    border-radius: 5px 5px 0 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    table th, table td {
        padding: 8px;
        font-size: 14px;
    }
    
    .btn {
        padding: 6px 10px;
        font-size: 14px;
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

						<h2 class="page-title">Donors List</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Donors Info</div>
								<a href="download-records.php" style="font-size:16px;" class="btn btn-info">Download Donor List</a>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
			

								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Name</th>
											<th>Mobile No</th>
											<th>Email</th>
											<th>Age</th>
											<th>Gender</th>
											<th>Blood Group</th>
											<th>address</th>
											<th>Message </th>
											<th>action </th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
										<th>Name</th>
											<th>Mobile No</th>
											<th>Email</th>
											<th>Age</th>
											<th>Gender</th>
											<th>Blood Group</th>
											<th>address</th>
											<th>Message </th>
											<th>action </th>
										</tr>
									</tfoot>
									<tbody>

<?php $sql = "SELECT * from  tblblooddonars ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->FullName);?></td>
											<td><?php echo htmlentities($result->MobileNumber);?></td>
											<td><?php echo htmlentities($result->EmailId);?></td>
											<td><?php echo htmlentities($result->Gender);?></td>
											<td><?php echo htmlentities($result->Age);?></td>
											<td><?php echo htmlentities($result->BloodGroup);?></td>
											<td><?php echo htmlentities($result->Address);?></td>
											<td><?php echo htmlentities($result->Message);?></td>
										
										
										<td>
<?php if($result->status==1)
{?>
<a href="donor-list.php?hidden=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to hiidden this detail')" class="btn btn-primary"> Make it Hidden</a> 
<?php } else {?>

<a href="donor-list.php?public=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Public this detail')" class="btn btn-primary"> Make it Public</a>

<?php } ?>
<a href="donor-list.php?del=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to delete this record')" class="btn btn-danger" style="margin-top:1%;"> Delete</a>
</td>

										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>

						

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
