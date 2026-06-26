<?php
include('includes/config.php'); 
// Blood Group Availability Count
$sql = "SELECT COUNT(*) as total FROM tblblooddonars";
$query = $dbh->prepare($sql);
$query->execute();
$totalDonors = $query->fetch(PDO::FETCH_OBJ)->total;

$sql = "SELECT BloodGroup, COUNT(*) as units FROM tblblooddonars GROUP BY BloodGroup";
$query = $dbh->prepare($sql);
$query->execute();
$bloodGroups = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>
<head>
<?php include('includes/header.php'); ?>

    <title>Blood Group Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin top: 300;
            padding: 20px;
            margin-left: -20px;        
           margin-top: 50px;


        }

        h2 {
            text-align: center;
            margin-bottom: 40px;
            color: #dc3545;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;

        }

        .card {
            width: 220px;
            padding: 20px 20px;
            border-radius: 12px;
            color: white;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            margin-left: 100px;        

        }

        .card:hover {
            transform: scale(1.05);
        }

        .card h1 {
            font-size: 48px;
            margin: 0;
        }

        .card h4 {
            margin: 10px 0;
            font-weight: 500;
        }

        .card a {
            display: inline-block;
            margin-top: 10px;
            padding: 6px 12px;
            background: rgba(255,255,255,0.2);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        /* Card colors */
        .bg-red { background: #e74c3c; }
        .bg-purple { background: #9b59b6; }
        .bg-blue { background: #3498db; }
        .bg-green { background: #28a745; }
        .bg-orange { background: #f39c12; }
        .bg-pink { background: #e83e8c; }
        .bg-teal { background: #20c997; }
        .bg-dark { background: #343a40; }

    </style>
</head>
<body>
<?php include('includes/leftbar.php'); ?>

<h2>🩸 Blood Group Availability Dashboard</h2>
<div class="card-container">
<?php
$colors = ['bg-red', 'bg-purple', 'bg-blue', 'bg-green', 'bg-orange', 'bg-pink', 'bg-teal', 'bg-dark'];

$sql = "SELECT BloodGroup, COUNT(*) as units FROM tblblooddonars GROUP BY BloodGroup ORDER BY BloodGroup ASC";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

$index = 0;
foreach ($results as $row) {
    $class = $colors[$index % count($colors)];
    echo "
    <div class='card $class'>
        <h1>{$row->units}</h1>
        <h4>{$row->BloodGroup} Group</h4>
        <a href='blood-donorlist.php?group=" . urlencode($row->BloodGroup) . "'>Full Detail</a>
    </div>";
    $index++;
}
?>
</div>

</body>
</html>
