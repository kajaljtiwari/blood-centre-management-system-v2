<?php
include('includes/config.php');

$successMsg = $errorMsg = "";

if(isset($_POST['submit'])) {
    // Recipient info from form
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $bloodgroup = $_POST['bloodgroup'];
    $bagtype = $_POST['bagtype'];
    $component = $_POST['component'];
    $quantity = $_POST['quantity'];

    try {
        $sql = "INSERT INTO tblrecipientslist (FullName, Gender, Age, Contact, Address, BloodType, BagType, ComponentTaken, Quantity, CreatedAt) 
                VALUES (:fullname, :gender, :age, :contact, :address, :bloodgroup, :bagtype, :component, :quantity, NOW())";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fullname', $fullname);
        $query->bindParam(':gender', $gender);
        $query->bindParam(':age', $age);
        $query->bindParam(':contact', $contact);
        $query->bindParam(':address', $address);
        $query->bindParam(':bloodgroup', $bloodgroup);
        $query->bindParam(':bagtype', $bagtype);
        $query->bindParam(':component', $component);
        $query->bindParam(':quantity', $quantity);
        $query->execute();

        $successMsg = "Recipient information saved successfully!";
    } catch (Exception $e) {
        $errorMsg = "Error saving data: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Recipient Information</title>
<style>
* {
    box-sizing: border-box;
}
body {
    font-family: Arial, sans-serif;
    background: #f8f9fa;
    margin-top: 10px;
    padding: 20px;
    margin-left: -20px;
    margin-top: 89px;

}
h2 {
    text-align: center;
    color: rgb(35, 169, 247);
    margin-bottom: 25px;
    font-weight: 700;
}
form {
    max-width: 600px;
    margin: 0 auto;
    background: #fff;
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(183, 28, 28, 0.2);
    margin-top: 100px;

}
label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #333;
}
input[type="text"],
input[type="number"],
select,
textarea {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 18px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 16px;
    transition: border-color 0.3s ease;
    resize: vertical;
}
input[type="text"]:focus,
input[type="number"]:focus,
select:focus,
textarea:focus {
    border-color: rgba(7, 162, 239, 0.91);
    outline: none;
}
textarea {
    min-height: 80px;
}
button {
    background-color: rgba(98, 163, 207, 0.84);
    color: white;
    font-weight: 700;
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s ease;
    width: 100%;
}
button:hover {
    background-color: #7f0000;
}
.msg {
    max-width: 600px;
    margin: 20px auto;
    text-align: center;
    padding: 12px 18px;
    border-radius: 8px;
    font-weight: 600;
}
.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}
.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
</style>
<script>
function updateComponentOptions() {
    const bagType = document.getElementById('bagtype').value;
    const componentSelect = document.getElementById('component');
    const componentsByBag = {
        "Single": ["Whole Blood"],
        "Double": ["Red Blood Cells", "Plasma"],
        "Triple": ["Red Blood Cells", "Plasma", "Platelets"]
    };
    componentSelect.innerHTML = '';
    if (componentsByBag[bagType]) {
        componentsByBag[bagType].forEach(function(comp) {
            const option = document.createElement('option');
            option.value = comp;
            option.text = comp;
            componentSelect.appendChild(option);
        });
    } else {
        const option = document.createElement('option');
        option.value = '';
        option.text = 'Select Bag Type First';
        componentSelect.appendChild(option);
    }
}
window.onload = function() {
    updateComponentOptions();
}
</script>
</head>

<?php include('includes/header.php'); ?>
<?php include('includes/leftbar.php'); ?>
<body>


<h2>Add Recipient Information</h2>
<?php if($successMsg) { ?>
    <div class="msg success"><?php echo htmlentities($successMsg); ?></div>
<?php } elseif($errorMsg) { ?>
    <div class="msg error"><?php echo htmlentities($errorMsg); ?></div>
<?php } ?>

<form method="POST" action="">
    <label>Full Name:</label>
    <input type="text" name="fullname" required>

    <label>Gender:</label>
    <select name="gender" required>
        <option value="">Select Gender</option>
        <option>Male</option>
        <option>Female</option>
        <option>Other</option>
    </select>

    <label>Age:</label>
    <input type="number" name="age" min="0" required>

    <label>Contact:</label>
    <input type="text" name="contact" required>

    <label>Address:</label>
    <textarea name="address" required></textarea>

    <label>Blood Group:</label>
    <select name="bloodgroup" required>
        <option value="">Select Blood Group</option>
        <option>A+</option><option>A-</option>
        <option>B+</option><option>B-</option>
        <option>AB+</option><option>AB-</option>
        <option>O+</option><option>O-</option>
    </select>

    <label>Bag Type:</label>
    <select id="bagtype" name="bagtype" onchange="updateComponentOptions()" required>
        <option value="">Select Bag Type</option>
        <option value="Single">Single</option>
        <option value="Double">Double</option>
        <option value="Triple">Triple</option>
    </select>

    <label>Blood Component:</label>
    <select id="component" name="component" required>
        <!-- JS will dynamically fill -->
    </select>

    <label>Quantity (units):</label>
    <input type="number" name="quantity" min="1" required>

    <button type="submit" name="submit">Save Recipient Info</button>
</form>

</body>
</html>





