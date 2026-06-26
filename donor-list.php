
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank Management System</title>
   
    <style>
body

{
        margin: 0;
    font-family: Arial, sans-serif;
    background: #fff0f0;
}

        /* Container styling */
        .donor-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }
        
        /* Donor card */
        .donor-card {
            width: 300px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            border: 1px solid #ddd;
        }

        /* Donor image */
        .donor-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: #ffffff;
        }

        /* Name label */
        .donor-card h3 {
            background: #2a5dad;
            color: white;
            padding: 10px;
            margin: 0;
            text-transform: capitalize;
        }

        /* Donor details table */
        .donor-card table {
            width: 100%;
            text-align: left;
            border-collapse: collapse;
            padding: 10px;
        }

        .donor-card table th {
            padding: 5px;
            background: #f9f9f9;
            text-align: left;
            font-weight: bold;
        }

        .donor-card table td {
            padding: 5px;
            color: #333;
        }

        /* Request button */
        .donor-card .btn {
            display: block;
            text-decoration: none;
            background: #ff3b3b;
            color: white;
            padding: 10px;
            font-weight: bold;
            margin: 10px;
            border-radius: 5px;
            transition: 0.3s;
        }
/* Apply pop-up effect on hover */
.donor-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.donor-card:hover {
    transform: scale(1.05); /* Slightly enlarge the card */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3); /* Add a shadow */
}

        .donor-card .btn:hover {
            background: #c93030;
        }
  
</head>
<body>
<?php include('includes/header.php');?>

<div class="container">
<h4 style="text-align: center;">Available Blood Donors</h4>

    <div class="donor-list">
        <?php
        include 'db_connect.php';

        $status = 1;
        $sql = "SELECT * FROM tblblooddonars WHERE status = :status";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status', $status, PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            foreach ($results as $result) {
                ?>
                <div class="donor-card">
                    <img src="images/blood-donor.jpg" alt="Blood Donor">
                    <h3><?php echo htmlentities($result->FullName); ?></h3>
                    <table>
                        <tr><th>Gender:</th><td><?php echo htmlentities($result->Gender); ?></td></tr>
                        <tr><th>Blood Group:</th><td><?php echo htmlentities($result->BloodGroup); ?></td></tr>
                        <tr><th>Mobile No.:</th><td><?php echo htmlentities($result->MobileNumber); ?></td></tr>
                        <tr><th>Email ID:</th><td><?php echo htmlentities($result->EmailId); ?></td></tr>
                        <tr><th>Age:</th><td><?php echo htmlentities($result->Age); ?></td></tr>
                        <tr><th>Address:</th><td><?php echo htmlentities($result->Address); ?></td></tr>
                    </table>
                    <a class="btn" href="request.php?cid=<?php echo $result->id; ?>">Request</a>
                </div>
                <?php
            }
        } else {
            echo "<p>No donors found.</p>";
        }
        ?>
    </div>
</div>

<!-- Footer -->
<?php include('includes/footer.php');?>

</body>
</html>
