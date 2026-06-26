<?php
// Database Connection
$conn = new mysqli('localhost', 'root', '', 'bbdms');
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tblrecipientslist ORDER BY CreatedAt DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Recipient List</title>
    <style>
        body { font-family: Arial;
             background: #f4f4f4; 
          margin-left: -1px;        
        }
        .container { width: 80%; 
            margin: 30px auto;  
            margin-left: 250px;        
           margin-top: 80px;


 }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background: #007bff; color: white; }
        tr:nth-child(even) { background: #f2f2f2; }
        a.button { padding: 8px 12px; background: #28a745; color: white; text-decoration: none; border-radius: 5px; }
        a.button:hover { background: #218838; }
    </style>
</head>
<body>
    
<?php include('includes/header.php'); ?>
<?php include('includes/leftbar.php'); ?>

<div class="container">
    <h2>Recipient List</h2>
    <a class="button" href="add_recipient.php">Add New Recipient</a>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Contact</th>
                <th>Blood Type</th>
                <th>Component Taken</th>
                <th>Bag Type</th>
                <th>Quantity</th>
                <th>Issued On</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['FullName']}</td>
                        <td>{$row['Gender']}</td>
                        <td>{$row['Age']}</td>
                        <td>{$row['Contact']}</td>
                        <td>{$row['BloodType']}</td>
                        <td>{$row['ComponentTaken']}</td>
                        <td>{$row['BagType']}</td>
                        <td>{$row['Quantity']}</td>
                        <td>{$row['CreatedAt']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No Records Found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
