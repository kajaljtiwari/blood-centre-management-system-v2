<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['bbmsdid']==0)) {
  header('location:logout.php');
} else {
  if(isset($_POST['update'])) {
    $uid=$_SESSION['bbmsdid'];
    $name=$_POST['fullname'];
    $mno=$_POST['mobileno']; 
    $age=$_POST['age']; 
    $gender=$_POST['gender'];
    $bloodgroup=$_POST['bloodgroup']; 
    $address=$_POST['address'];
    $message=$_POST['message']; 

    $sql="UPDATE tblblooddonars SET FullName=:name, MobileNumber=:mno, Age=:age, Gender=:gender, BloodGroup=:bloodgroup, Address=:address, Message=:message WHERE id=:uid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name',$name,PDO::PARAM_STR);
    $query->bindParam(':mno',$mno,PDO::PARAM_STR);
    $query->bindParam(':age',$age,PDO::PARAM_STR);
    $query->bindParam(':gender',$gender,PDO::PARAM_STR);
    $query->bindParam(':bloodgroup',$bloodgroup,PDO::PARAM_STR);
    $query->bindParam(':address',$address,PDO::PARAM_STR);
    $query->bindParam(':message',$message,PDO::PARAM_STR);
    $query->bindParam(':uid',$uid,PDO::PARAM_STR);
    $query->execute();
    echo '<script>alert("Profile has been updated")</script>';
  }
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <style>



        /* Main container */
        .contact-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 100px;
            padding: 100px;
			margin-top: -30px; /* Move both form and image up */

        }

        /* Left Side: Image */
        .contact-image {
            flex: 1;
            text-align: center;
			margin-top: -30px; /* Move image slightly up */

        }

        .contact-image img {
            width: 200%;
            max-width: 600px;
            height: auto;
            border-radius: 10px;

		
        }

        /* Right Side: Form */
        .appoint-form {
            flex: 1;
            max-width: 550px;
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        .appoint-form h5 {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: #d9534f;
        }

        .appoint-form input, 
        .appoint-form select, 
        .appoint-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        /* Button Styling */
        .btn_apt {
            background: #dc3545;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .btn_apt:hover {
            background: #c82333;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-container {
                flex-direction: column;
                text-align: center;
            }
            .contact-image, .appoint-form {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>

    <!-- Parent Container -->
    <div class="contact-container">
        <!-- Left Side - Image -->
        <div class="contact-image">
            <img src="images/profileimg.jpg" alt="Blood Donation">
        </div>

        <!-- Right Side - Form -->
        <div class="appoint-form">
            <h3 class="title">Donor Profile</h3>
            <h5 class="title-w3 text-center mb-5">Detail of Your Profile</h5>
            <form action="#" method="post">
                <?php
                $uid=$_SESSION['bbmsdid'];
                $sql="SELECT * FROM tblblooddonars WHERE id=:uid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':uid',$uid,PDO::PARAM_STR);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                if($query->rowCount() > 0) {
                    foreach($results as $row) {               
                ?>
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" class="form-control" name="fullname" value="<?php echo $row->FullName; ?>">
                </div>

                <div class="form-group">
                    <label for="mobileno">Mobile Number</label>
                    <input type="text" class="form-control" name="mobileno" required maxlength="10" pattern="[0-9]+" value="<?php echo $row->MobileNumber; ?>">
                </div>

                <div class="form-group">
                    <label for="emailid">Email Id <span style="color:red; font-size:10px;">(Can't be changed)</span></label>
                    <input type="email" name="emailid" class="form-control" value="<?php echo $row->EmailId; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" name="age" required value="<?php echo $row->Age; ?>">
                </div>

                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select required class="form-control" name="gender">
                        <option value="<?php echo $row->Gender; ?>"><?php echo $row->Gender; ?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="bloodgroup">Blood Group</label>
                    <select name="bloodgroup" class="form-control" required>
                        <option value="<?php echo $row->BloodGroup; ?>"><?php echo $row->BloodGroup; ?></option>
                        <?php 
                        $sql = "SELECT * FROM tblbloodgroup";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        if($query->rowCount() > 0) {
                            foreach($results as $result) { ?>  
                                <option value="<?php echo htmlentities($result->BloodGroup); ?>"><?php echo htmlentities($result->BloodGroup); ?></option>
                        <?php }} ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" required value="<?php echo $row->Address; ?>">
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" name="message" required><?php echo $row->Message; ?></textarea>
                </div>

                <input type="submit" value="Update" name="update" class="btn_apt">
                <?php }} ?>
            </form>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
</body>
</html>
<?php } ?>