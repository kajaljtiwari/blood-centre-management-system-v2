<?php
include('includes/config.php');

// Correct variable usage
$bloodGroup = $_GET['group'];

$sql = "SELECT id,FullName, Gender, Age, MobileNumber, EmailId, Address FROM tblblooddonars WHERE BloodGroup = :group";
$query = $dbh->prepare($sql);
$query->bindParam(':group', $bloodGroup, PDO::PARAM_STR);
$query->execute();
$donors = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html>
<head>
<?php include('includes/header.php'); ?>
<?php include('includes/leftbar.php'); ?>

    <title>Donors of <?php echo htmlentities($bloodGroup); ?> Group</title>
    <style>
        body 
     {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            padding: 20px;
            margin-left: -15px;        
           margin-top: 80px;


        }
        h2 {
            text-align: center;
            color: #d10000;
        }
        table {
    margin-left: auto;
    margin-right: auto;
            width: 60%;
            margin: auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            justify-content: center;  /* horizontal */
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background: #dc3545;
            color: white;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .back-btn {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
        .back-btn a {
            padding: 10px 20px;
            background: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h2>🩸 Donors with Blood Group <?php echo htmlentities($bloodGroup); ?></h2>

<table>
    <thead>
       
    <th>Full Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Mobile Number</th>
            <th>Email</th>
            <th>Location</th>
            <th>Request</th>
        </tr>
    </thead>
    <tbody>
    <?php
if ($query->rowCount() > 0) {
    foreach ($donors as $donor) {
        ?>
        <tr>
            <td><?= htmlentities($donor->FullName) ?></td>
            <td><?= htmlentities($donor->Gender) ?></td>
            <td><?= htmlentities($donor->Age) ?></td>
            <td><?= htmlentities($donor->MobileNumber) ?></td>
            <td><?= htmlentities($donor->EmailId) ?></td>
            <td><?= htmlentities($donor->Address) ?></td>
            <td><a class="btn" href="request.php?cid=<?= $donor->id ?>">Request</a></td>
            </tr>
        <?php
    }
} else {
    echo "<tr><td colspan='9'>No donors found for " . htmlentities($bloodGroup) . "</td></tr>";
}
?>

    </tbody>
</table>

<div class="back-btn">
    <a href="dashboard.php">🔙 Back to Dashboard</a>
</div>

</body>
</html>
