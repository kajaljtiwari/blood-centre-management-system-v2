<?php
include('includes/config.php');

if (!isset($_GET['group']) || empty($_GET['group'])) {
    echo "<h2 style='color:red; text-align:center; margin-top:50px;'>Blood group not specified!</h2>";
    exit;
}

$bloodGroup = $_GET['group'];

// Expired blood components ki quantity zero kar do automatically
$today = date('Y-m-d');
$updateExpired = "UPDATE tblbloodcomponents SET Quantity = 0 WHERE ExpiryDate < :today AND BloodGroup = :group";
$stmt = $dbh->prepare($updateExpired);
$stmt->bindParam(':today', $today);
$stmt->bindParam(':group', $bloodGroup);
$stmt->execute();

// Donors fetch karo
$sqlDonors = "SELECT FullName, Gender, Age, MobileNumber, EmailId, Address FROM tblblooddonars WHERE BloodGroup = :group";
$queryDonors = $dbh->prepare($sqlDonors);
$queryDonors->bindParam(':group', $bloodGroup, PDO::PARAM_STR);
$queryDonors->execute();
$donors = $queryDonors->fetchAll(PDO::FETCH_OBJ);

// Blood components fetch karo
$sqlComp = "SELECT ComponentType, Quantity, ExpiryDate FROM tblbloodcomponents WHERE BloodGroup = :group";
$queryComp = $dbh->prepare($sqlComp);
$queryComp->bindParam(':group', $bloodGroup, PDO::PARAM_STR);
$queryComp->execute();
$components = $queryComp->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html>
<head>
<?php include('includes/header.php'); ?>
<title>Details for Blood Group: <?php echo htmlentities($bloodGroup); ?></title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f4f4;
        padding: 20px;
    }
    h2 {
        text-align: center;
        color: #d10000;
    }
    table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
    .expired {
        background-color: #ffdddd;
        color: #b30000;
        font-weight: bold;
    }
    .low-stock {
        background-color: #fff8e1;
        color: #a67c00;
        font-weight: bold;
    }
    .back-btn {
        display: block;
        text-align: center;
        margin-top: 30px;
    }
    .back-btn a {
        padding: 10px 20px;
        background: #dc3545;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    }
    .section-title {
        margin-top: 40px;
        text-align: center;
        color: #a00;
    }
</style>
</head>
<body>

<h2>Donors with Blood Group <?php echo htmlentities($bloodGroup); ?></h2>

<table>
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($donors) > 0) {
            foreach ($donors as $donor) {
                echo "<tr>
                        <td>" . htmlentities($donor->FullName) . "</td>
                        <td>" . htmlentities($donor->Gender) . "</td>
                        <td>" . htmlentities($donor->Age) . "</td>
                        <td>" . htmlentities($donor->MobileNumber) . "</td>
                        <td>" . htmlentities($donor->EmailId) . "</td>
                        <td>" . htmlentities($donor->Address) . "</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No donors found for " . htmlentities($bloodGroup) . "</td></tr>";
        }
        ?>
    </tbody>
</table>

<h2 class="section-title">Blood Components Availability for <?php echo htmlentities($bloodGroup); ?></h2>

<table>
    <thead>
        <tr>
            <th>Component Type</th>
            <th>Quantity</th>
            <th>Expiry Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $today = date('Y-m-d');
        if (count($components) > 0) {
            foreach ($components as $comp) {
                $rowClass = '';
                if ($comp->ExpiryDate < $today) {
                    $rowClass = 'expired';
                } elseif ($comp->Quantity <= 3) {
                    $rowClass = 'low-stock';
                }
                echo "<tr class='$rowClass'>
                        <td>" . htmlentities($comp->ComponentType) . "</td>
                        <td>" . htmlentities($comp->Quantity) . "</td>
                        <td>" . htmlentities($comp->ExpiryDate) . "</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No blood components found for " . htmlentities($bloodGroup) . "</td></tr>";
        }
        ?>
    </tbody>
</table>

<div class="back-btn">
    <a href="index.php">🔙 Back to Home</a>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
