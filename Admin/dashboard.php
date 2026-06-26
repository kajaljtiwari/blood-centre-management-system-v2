<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
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
</head>

<body>	
	<?php include('includes/header.php');?>
	<?php include('includes/leftbar.php');?>

<style>
  
/* Horizontal Layout for Dashboard Boxes */
.dashboard-row {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 100px;
}

/* Individual Box Styling */
.panel {
    width: 250px;
    min-height: 160px;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: 0.3s ease;
}

.panel:hover {
    transform: scale(1.03);
}

/* Color Variants (reuse these) */
.bk-primary { background:rgba(162, 3, 248, 0.83); color: #fff; }
.bk-success { background: #28a745; color: #fff; }
.bk-info { background: #17a2b8; color: #fff; }
.panel-danger { background: #dc3545; color: #fff; }

/* Content Inside Box */
.panel-body {
    padding: 20px;
    text-align: center;
    font-weight: bold;
}

.stat-panel-number {
    font-size: 36px;
    font-weight: bold;
    margin-bottom: 10px;
}

.panel-footer {
    text-align: center;
    padding: 10px;
    background: rgba(255,255,255,0.1);
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    display: block;
}

</style>
<div class="dashboard-row">

<!-- Blood Groups Panel -->
<div class="panel bk-primary">
  <div class="panel-body">
	<?php 
	  $sql ="SELECT id from tblbloodgroup ";
	  $query = $dbh -> prepare($sql);
	  $query->execute();
	  $bg=$query->rowCount();
	?>
	<div class="stat-panel-number"><?php echo htmlentities($bg);?></div>
	<div class="stat-panel-title text-uppercase">Listed Blood Groups</div>
  </div>
  <a href="manage-bloodgroup.php" class="panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
</div>

<!-- Registered Donors Panel -->
<div class="panel bk-success">
  <div class="panel-body">
	<?php 
	  $sql1 ="SELECT id from tblblooddonars ";
	  $query1 = $dbh -> prepare($sql1);
	  $query1->execute();
	  $regbd=$query1->rowCount();
	?>
	<div class="stat-panel-number"><?php echo htmlentities($regbd);?></div>
	<div class="stat-panel-title text-uppercase">Registered Donors</div>
  </div>
  <a href="donor-list.php" class="panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
</div>

<!-- Contact Queries Panel -->
<div class="panel bk-info">
  <div class="panel-body">
	<?php 
	  $sql2 ="SELECT id from tblcontactusquery ";
	  $query2 = $dbh -> prepare($sql2);
	  $query2->execute();
	  $queries=$query2->rowCount();
	?>
	<div class="stat-panel-number"><?php echo htmlentities($queries);?></div>
	<div class="stat-panel-title text-uppercase">Total Queries</div>
  </div>
  <a href="manage-conactusquery.php" class="panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
</div>

<!-- Blood Requests Panel -->

<!-- Blood Requests Panel -->
<div class="panel panel-danger">
  <div class="panel-body">
    <?php 
    $sql3 = "SELECT id FROM tblbloodrequirer";
    $query3 = $dbh->prepare($sql3);
    $query3->execute();
    $totalRequests = $query3->rowCount();
    ?>
    <div class="stat-panel-number"><?php echo htmlentities($totalRequests); ?></div>
    <div class="stat-panel-title text-uppercase">Total Blood Requests</div>
  </div>
  <a href="requests-received.php" class="panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
</div>


</body>
</html>
<?php } ?>                    