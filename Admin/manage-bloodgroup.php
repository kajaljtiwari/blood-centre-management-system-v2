<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from tblbloodgroup  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$msg="Data Deleted successfully";

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
           margin-top: 55px;


        }

/* Success and Error Messages */
.succWrap, .errorWrap {
    padding: 10px;
    margin: 10px 0;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 500;
	
}
.succWrap {
    background:rgb(23, 231, 72);
    color: #155724;
    border-left: 5px solid #28a745;
	margin-top: 100px;

}
.errorWrap {
    background:rgb(221, 20, 37);
    color: #721c24;
    border-left: 5px solid #dc3545;

}

/* Table Styling */
table.dataTable {
    width: 100% !important;
    border-collapse: collapse;
    font-size: 15px;
	

}
table th, table td {
    padding: 12px 15px;
    text-align: left;
}
table thead {
    background-color: #007bff;
    color: #fff;
}
table tbody tr:nth-child(even) {
    background-color:rgba(245, 14, 14, 0.53);
}
table tbody tr:hover {
    background-color:rgba(162, 2, 119, 0.43);
}

/* Delete Icon Styling */
.fa-close {
    color:rgba(26, 216, 111, 0.81);
    font-size: 18px;
    transition: 0.2s ease-in-out;
}
.fa-close:hover {
    color:rgba(221, 199, 28, 0.69);
    transform: scale(1.2);
}

/* Panel Box */
.panel-heading {

    background-color: #007bff;
    color: white;
    font-weight: bold;
    padding: 10px 15px;
	border-bottom: 2px solid #0056b3;
}
.panel-default {
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 8px rgba(17, 149, 220, 0.68);
}

/* Responsive Page Title */
.page-title {
    margin-top: 10px;
    font-size: 28px;
    font-weight: bold;
    text-align: center;
    color: #333;
}

.delete-btn {
    background-color: #e53935;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 500;
    transition: background-color 0.3s ease;
}

.delete-btn:hover {
    background-color:rgba(231, 144, 64, 0.9);
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

						<h2 class="page-title">Manage Blood Groups</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Listed  Blood Groups</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
												<th>Blood Groups</th>
											<th>Creation Date</th>
										
										
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
											<th>Blood Groups</th>
											<th>Creation Date</th><th>Action</th>
										</tr>
										</tr>
									</tfoot>
									<tbody>

<?php $sql = "SELECT * from  tblbloodgroup ";
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
											<td><?php echo htmlentities($result->BloodGroup);?></td>
											<td><?php echo htmlentities($result->PostingDate);?></td>
<td>
<a href="manage-bloodgroup.php?del=<?php echo $result->id;?>" onclick="return confirm('Do you want to delete');">
    <button class="delete-btn">Delete</button>
</a>										<?php $cnt=$cnt+1; }} ?>
										
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
