<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin']) == 0) {	
    header('location:index.php');
} else {
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#3e454c">
    <title>Blood Requests Received</title>

    <style>
        
    body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin top: 300;
            padding: 20px;
            margin-left: -20px;        
           margin-top: 50px;


        }
        .content-wrapper {
            padding: 20px;
            background: #f5f5f5;
        }

        h3 {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .panel {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .panel-heading {
            background: #007bff;
            color: #fff;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: #fff;
            border-radius: 8px;
        }

        .table th {
            background: #007bff;
            color: #fff;
            padding: 12px;
            text-align: left;
            font-size: 15px;
        }

        .table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        .table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        .table tbody tr:hover {
            background: #e9f3ff;
        }

        @media (max-width: 768px) {
            .table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>

<body>
    <?php include('includes/header.php'); ?>

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
