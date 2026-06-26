<?php
session_start();
include('includes/config.php');
error_reporting(0);

if (!isset($_SESSION['bbmsdid'])) {
    echo "<script>alert('Login required to view history.');window.location.href='login.php';</script>";
    exit();
}

$donorId = $_SESSION['bbmsdid'];

// Fetch donor info
$sql = "SELECT FullName, EmailId, BloodGroup FROM tblblooddonars WHERE id = :id";
$query = $dbh->prepare($sql);
$query->bindParam(':id', $donorId, PDO::PARAM_INT);
$query->execute();
$donor = $query->fetch(PDO::FETCH_ASSOC);

// Fetch donation data based on blood request entries
$sql2 = "SELECT COUNT(*) AS total_donations, MAX(ApplyDate) AS last_donation FROM  `tblbloodrequirer`
 WHERE BloodDonarID = :donorid";
$query2 = $dbh->prepare($sql2);
$query2->bindParam(':donorid', $donorId, PDO::PARAM_INT);
$query2->execute();
$donation = $query2->fetch(PDO::FETCH_ASSOC);

// Calculate next eligible date (90 days after last donation)
$nextEligible = "N/A";
if ($donation['last_donation']) {
    $nextEligible = date('Y-m-d', strtotime($donation['last_donation'] . ' +90 days'));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Donation History</title>
    <style>
        .donation-history-container {
            max-width: 700px;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 0px 15px rgba(220, 53, 69, 0.2);
            font-family: 'Segoe UI', sans-serif;
        }

        .donation-history-container h2 {
            text-align: center;
            color: #d9534f;
            margin-bottom: 30px;
        }

        .donation-history-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .donation-history-container th, .donation-history-container td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .donation-history-container th {
            background-color: #f8f9fa;
            color: #333;
        }
    </style>
</head>
<body>

<?php include('includes/header.php'); ?>

<div class="donation-history-container">
    <h2> My Donation History</h2>

    <table>
        <tr>
            <th>Full Name</th>
            <td><?php echo htmlentities($donor['FullName']); ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo htmlentities($donor['EmailId']); ?></td>
        </tr>
        <tr>
            <th>Blood Group</th>
            <td><?php echo htmlentities($donor['BloodGroup']); ?></td>
        </tr>
        <tr>
            <th>Total Donations</th>
            <td><?php echo $donation['total_donations']; ?></td>
        </tr>
        <tr>
            <th>Last Donation Date</th>
            <td><?php echo $donation['last_donation'] ? date('d M Y', strtotime($donation['last_donation'])) : 'N/A'; ?></td>
        </tr>
        <tr>
            <th>Next Eligible Date</th>
            <td><?php echo $nextEligible; ?></td>
        </tr>
    </table>
</div>

<?php include('includes/footer.php'); ?>
</body>
</html>
