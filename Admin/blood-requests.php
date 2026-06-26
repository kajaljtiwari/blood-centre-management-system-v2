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
  <style>
/* General Styling */
body  {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin top: 300;
            padding: 20px;
            margin-left: -20px;        
           margin-top: 55px;


        }


/* Page Title */
h2.page-title {
    background: #0462c1;
    color: white;
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
    color: white;
}

.errorWrap {
    background: #dc3545;
    color: white;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

table thead {
    background: #0462c1;
    color: white;
    font-weight: bold;
}

table th, table td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

table tbody tr:nth-child(even) {
    background: #f9f9f9;
}

table tbody tr:hover {
    background: #f1f1f1;
}

/* Panel Box */
.panel {
    background: white;
    border-radius: 5px;
    padding: 15px;
    margin: 15px 0;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.panel-heading {
    background: #0462c1;
    color: white;
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
}

		
		</style>

</head>
<?php include('includes/header.php'); ?>

<body>
<div class="ts-main-content">
        <?php include('includes/leftbar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="col-md-12">
                    <h3>Blood Requests Received</h3>
                    <hr />
                    <div class="panel panel-default">
                        <div class="panel-heading">Blood Info</div>
                        <div class="panel-body">
                            <table border="1" class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name of Donor</th>
                                        <th>Contact Number of Donor</th>
                                        <th>Name of Requirer</th>
                                        <th>Mobile Number of Requirer</th>
                                        <th>Email of Requirer</th>
                                        <th>Blood Require For</th>
                                        <th>Message of Requirer</th>
                                        <th>Apply Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT 
                                                r.BloodDonarID,
                                                r.name,
                                                r.EmailId,
                                                r.ContactNumber,
                                                r.BloodRequirefor,
                                                r.Message,
                                                r.ApplyDate,
                                                d.FullName,
                                                d.MobileNumber 
                                            FROM tblbloodrequirer r
                                            LEFT JOIN tblblooddonars d 
                                            ON d.id = r.BloodDonarID";

                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;

                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) {
                                    ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($row->FullName ?? 'N/A'); ?></td>
                                                <td><?php echo htmlentities($row->MobileNumber ?? 'N/A'); ?></td>
                                                <td><?php echo htmlentities($row->name); ?></td>
                                                <td><?php echo htmlentities($row->ContactNumber); ?></td>
                                                <td><?php echo htmlentities($row->EmailId); ?></td>
                                                <td><?php echo htmlentities($row->BloodRequirefor); ?></td>
                                                <td><?php echo htmlentities($row->Message); ?></td>
                                                <td><?php echo htmlentities($row->ApplyDate); ?></td>
                                            </tr>
                                    <?php
                                            $cnt++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>No blood requests found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>

<?php } ?>
