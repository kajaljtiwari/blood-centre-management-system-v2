<?php 
session_start();
error_reporting(E_ALL);  // Display all errors
ini_set('display_errors', 1); // Show errors on screen

include('includes/config.php');
if(isset($_POST['submit']))
{
    // Get form data
    $fullname = $_POST['fullname'];
    $mobile = $_POST['mobileno'];
    $email = $_POST['emailid'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $blodgroup = $_POST['bloodgroup'];
    $address = $_POST['address'];
    $message = $_POST['message'];
    $status = 1;
    $password = md5($_POST['password']);
    $weight = $_POST['weight'];  // Get weight input from the form
    
    // Check if the age is less than 18
    if ($age < 18) {
        echo "<script>alert('You are not eligible to donate blood due to insufficient age.');</script>";
    } 
    // Check if the weight is less than 50kg
    else if ($weight < 50) {
        echo "<script>alert('You are not eligible to donate blood due to insufficient weight.');</script>";
    } else {
        // Check if email already exists
        $ret = "SELECT EmailId FROM tblblooddonars WHERE EmailId=:email";
        $query = $dbh->prepare($ret);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        
        // If email does not exist, proceed with registration
        if ($query->rowCount() == 0) {
            $sql = "INSERT INTO tblblooddonars (FullName, MobileNumber, EmailId, Age, Gender, BloodGroup, Address, Message, status, Password, Weight) 
                    VALUES (:fullname, :mobile, :email, :age, :gender, :blodgroup, :address, :message, :status, :password, :weight)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
            $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':age', $age, PDO::PARAM_STR);
            $query->bindParam(':gender', $gender, PDO::PARAM_STR);
            $query->bindParam(':blodgroup', $blodgroup, PDO::PARAM_STR);
            $query->bindParam(':address', $address, PDO::PARAM_STR);
            $query->bindParam(':message', $message, PDO::PARAM_STR);
            $query->bindParam(':status', $status, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->bindParam(':weight', $weight, PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            
            if ($lastInsertId) {
                echo "<script>alert('You have successfully registered and added to the donor list.');</script>";
            } else {
                echo "<script>alert('Something went wrong. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Email-id already exists. Please try again');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Signup</title>
    <style>
        /* General Style */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .contact-container {
            display: flex;
            justify-content: center;
            padding: 50px;
        }
        .contact-image {
            width: 55%;
        }
        .contact-image img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        
        .register-form {
    width: 45%;
    max-width: 450px;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
    max-height: 500px; /* Fix max height */
    overflow-y: auto; /* Scroll if needed */
}

        .register-form h5 {
            text-align: center;
            color: #d9534f;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .btn {
            width: 100%;
            background-color: #d9534f;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #c9302c;
        }
        .account-w3ls {
            text-align: center;
            color: #000;
        }
        .account-w3ls a {
            color: #d9534f;
            font-weight: bold;
        }
        .account-w3ls a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact-container {
                flex-direction: column;
                text-align: center;
            }
            .contact-image, .register-form {
                width: 90%;
            }
        }

       
    </style>
</head>
<body>

<?php include('includes/header.php');?>

<div class="contact-container">

    <!-- Left Side - Image -->
    <div class="contact-image">
        <img src="images/k3.jpeg" alt="Blood Donation">
    </div>

    <!-- Right Side - Form -->
    <div class="register-form">
        <h5>Register Now</h5>
        <form action="#" method="post" name="signup" onsubmit="return checkpass();">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name" required>
            </div>
            <div class="form-group">
                <label>Mobile Number</label>
                <input type="text" class="form-control" name="mobileno" id="mobileno" placeholder="Mobile Number" maxlength="10" pattern="[0-9]+" required>
            </div>
            <div class="form-group">
                <label>Email Id</label>
                <input type="email" class="form-control" name="emailid" placeholder="Email Id" required>
            </div>
            <div class="form-group">
                <label>Age</label>
                <input type="number" class="form-control" name="age" id="age" placeholder="Age" required>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="form-control" required>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label>Blood Group</label>
                <select name="bloodgroup" class="form-control" required>
                    <?php 
                        $sql = "SELECT * from tblbloodgroup";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        if($query->rowCount() > 0) {
                            foreach($results as $result) { ?>  
                                <option value="<?php echo htmlentities($result->BloodGroup);?>">
                                    <?php echo htmlentities($result->BloodGroup);?>
                                </option>
                    <?php }} ?>
                </select>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" name="address" id="address" required>
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea class="form-control" name="message" required></textarea>
            </div>
            <div class="form-group">
                <label>Weight (kg)</label>
                <input type="number" class="form-control" name="weight" id="weight" placeholder="Weight" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn" name="submit">Register</button>
            <p class="account-w3ls">
                Already Registered? <a href="login.php">Sign In now</a>
            </p>
        </form>
    </div>

</div>

<!-- Scroll to Top Button -->
<button id="scrollToTopBtn" title="Go to top">↑</button>

<?php include('includes/footer.php');?>  

<script>
// Get the button
let mybutton = document.getElementById("scrollToTopBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
};

// When the user clicks on the button, scroll to the top of the document
mybutton.onclick = function() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>

</body>
</html>
