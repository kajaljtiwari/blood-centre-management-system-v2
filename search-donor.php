<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('includes/header.php');?>
<style>
    /* General Styles */
body 
/* ========== Search Form Styling ========== */
.container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #d9534f;
    margin-bottom: 20px;
}

form {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.row {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.col-md-4 {
    width: 30%;
    margin-bottom: 15px;
}

label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

.form-control {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* ========== Search Button Styling ========== */
.btn-search {
    background: #d9534f;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.btn-search:hover {
    background: #c9302c;
}

/* ========== Search Results Table Styling ========== */
.table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

.table th, .table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

.table th {
    background: #d9534f;
    color: white;
}

.table tr:nth-child(even) {
    background: #f2f2f2;
}

/* No Donors Found Message */
.text-danger {
    color: red;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
}


    </style>

    </nav>
    <div class="container">
        <h2>Search Blood Donors</h2>
        <form method="POST">
            <div class="row">
                <div class="col-md-4">
                    <label>Blood Group:</label>
                    <select name="blood_group" class="form-control" required>
                        <option value="">Select Blood Group</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Blood Component:</label>
                    <select name="component" class="form-control">
                        <option value="">Select Component</option>
                        <option value="Whole Blood">Whole Blood</option>
                        <option value="Plasma">Plasma</option>
                        <option value="Platelets">Platelets</option>
                        <option value="Red Blood Cells">Red Blood Cells</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Location:</label>
                    <input type="text" name="location" class="form-control" placeholder="Enter Location">
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="submit" name="search" class="btn-search">Search</button>
            </div>
        </form>
    </div>
<?php
if (isset($_POST['search'])) 
    include 'db_connect.php';
    $blood_group = $_POST['blood_group'];
    $location = !empty($_POST['location']) ? '%' . $_POST['location'] . '%' : '';
    
    $sql = "SELECT * FROM tblblooddonars WHERE BloodGroup = :blood_group";
    if (!empty($location)) {
        $sql .= " AND Address LIKE :location";
    }
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':blood_group', $blood_group, PDO::PARAM_STR);
    if (!empty($location)) {
        $query->bindParam(':location', $location, PDO::PARAM_STR);
    }
    
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    ?>
    <div class="container mt-5">
        <h3>Search Results</h3>
        <?php if (!empty($results)) { ?>
            <table class="table table-bordered">
          
<tr>
    <th>Full Name</th>
    <th>Gender</th>
    <th>Age</th>
    <th>Blood Group</th>
    <th>Mobile Number</th>
    <th>Email</th>
    <th>Location</th>
    <th>Message</th>
    <th>Request</th>
</tr>

<?php foreach ($results as $result) { ?>
    <tr>
        <td><?= htmlentities($result->FullName) ?></td>
        <td><?= htmlentities($result->Gender) ?></td>
        <td><?= htmlentities($result->Age) ?></td>
        <td><?= htmlentities($result->BloodGroup) ?></td>
        <td><?= htmlentities($result->MobileNumber) ?></td>
        <td><?= htmlentities($result->EmailId) ?></td>
        <td><?= htmlentities($result->Address) ?></td>
        <td><?= htmlentities($result->Message) ?></td>
        <td>
           <!-- <a href="request.php?id=<?= $result->id ?>" class="btn-request">Request</a>-->
            <a class="btn" href="request.php?cid=<?php echo $result->id; ?>">Request</a>

        </td>
    </tr>
<?php } ?>

            </table>
        <?php } else { ?>
            <p class='text-danger text-center'>No Donors Found!</p>
        <?php } ?>
    </div>

<!-- Footer -->
<?php include('includes/footer.php');?>
</body>
</html>