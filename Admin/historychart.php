<?php
session_start();
include('includes/config.php');
error_reporting(0);

// Admin check
if (strlen($_SESSION['bbmsaid']) == 0) {
    header('location:logout.php');
}

// Get donor ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Donor ID missing.'); window.location='donorlist.php';</script>";
    exit();
}

$donorId = intval($_GET['id']);

// Fetch donor info
$sql = "SELECT FullName, EmailId, BloodGroup FROM tblblooddonars WHERE id = :id";
$query = $dbh->prepare($sql);
$query->bindParam(':id', $donorId, PDO::PARAM_INT);
$query->execute();
$donor = $query->fetch(PDO::FETCH_ASSOC);

// Fetch donation data
$sql2 = "SELECT COUNT(*) AS total_donations, MAX(ApplyDate) AS last_donation 
         FROM blood_request_table WHERE BloodDonarID = :donorid";
$query2 = $dbh->prepare($sql2);
$query2->bindParam(':donorid', $donorId, PDO::PARAM_INT);
$query2->execute();
$donation = $query2->fetch(PDO::FETCH_ASSOC);

// Next Eligible
$nextEligible = "N/A";
if ($donation['last_donation']) {
    $nextEligible = date('Y-m-d', strtotime($donation['last_donation'] . ' +90 days'));
}

// Monthly Trend
$trendSQL = "SELECT DATE_FORMAT(ApplyDate, '%Y-%m') as month, COUNT(*) as count 
             FROM blood_request_table 
             WHERE BloodDonarID = :donorid 
             GROUP BY month ORDER BY month ASC";
$trendQuery = $dbh->prepare($trendSQL);
$trendQuery->bindParam(':donorid', $donorId, PDO::PARAM_INT);
$trendQuery->execute();
$trendData = $trendQuery->fetchAll(PDO::FETCH_ASSOC);

$months = [];
$counts = [];
foreach ($trendData as $row) {
    $months[] = $row['month'];
    $counts[] = $row['count'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Donor History</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .container {
            max-width: 850px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.1);
        }
        h2, h3 { text-align: center; color: #d9534f; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f2f2f2; }
        .chart-container { margin-top: 40px; }
    </style>
</head>
<body>

<?php include('includes/header.php'); ?>

<div class="container">
    <h2>🧾 Donor Donation History (Admin View)</h2>

    <table>
        <tr><th>Full Name</th><td><?= htmlentities($donor['FullName']); ?></td></tr>
        <tr><th>Email</th><td><?= htmlentities($donor['EmailId']); ?></td></tr>
        <tr><th>Blood Group</th><td><?= htmlentities($donor['BloodGroup']); ?></td></tr>
        <tr><th>Total Donations</th><td><?= $donation['total_donations']; ?></td></tr>
        <tr><th>Last Donation Date</th><td><?= $donation['last_donation'] ? date('d M Y', strtotime($donation['last_donation'])) : 'N/A'; ?></td></tr>
        <tr><th>Next Eligible Date</th><td><?= $nextEligible; ?></td></tr>
    </table>

    <div class="chart-container">
        <h3>📊 Monthly Donation Trend</h3>
        <canvas id="donationChart" height="150"></canvas>
    </div>
</div>

<script>
    const ctx = document.getElementById('donationChart').getContext('2d');
    const donationChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($months); ?>,
            datasets: [{
                label: 'Donations',
                data: <?= json_encode($counts); ?>,
                backgroundColor: '#d9534f'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            },
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Donations' } },
                x: { title: { display: true, text: 'Month' } }
            }
        }
    });
</script>

<?php include('includes/footer.php'); ?>
</body>
</html>
