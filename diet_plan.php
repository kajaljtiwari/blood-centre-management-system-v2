<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Donor Diet Plan</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f2f6fc;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #0056b3;
      color: white;
      text-align: center;
      padding: 1rem 0;
    }
    .container {
      width: 90%;
      max-width: 1100px;
      margin: 20px auto;
    }
    .card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      margin-bottom: 20px;
      padding: 20px;
      transition: 0.3s;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }
    .card h2 {
      color: #0056b3;
      margin-bottom: 10px;
    }
    .card ul {
      list-style: none;
      padding-left: 20px;
    }
    .card ul li::before {
      content: "✅";
      margin-right: 10px;
      color: green;
    }
    footer {
      text-align: center;
      background-color: #0056b3;
      color: white;
      padding: 1rem 0;
      margin-top: 30px;
    }
  </style>
</head>
<body>
<?php include('includes/header.php');?>

  <h1>Donor Diet Plan & Health Tips</h1>


<div class="container">

  <div class="card">
    <h2>Foods to Increase Hemoglobin</h2>
    <ul>
      <li>Leafy greens (Spinach, Kale, Methi)</li>
      <li>Red meat (Beef, Lamb) and chicken liver</li>
      <li>Beans and lentils (Rajma, Chana, Masoor)</li>
      <li>Iron-fortified cereals and breads</li>
      <li>Vitamin C foods (Orange, Lemon, Guava) to improve iron absorption</li>
      <li>Dry fruits (Dates, Raisins, Figs)</li>
    </ul>
  </div>

  <div class="card">
    <h2>Foods for Healthy Weight</h2>
    <ul>
      <li>High protein foods (Eggs, Milk, Paneer)</li>
      <li>Healthy fats (Nuts, Seeds, Avocados)</li>
      <li>Whole grains (Brown Rice, Oats, Quinoa)</li>
      <li>Frequent small meals (every 3-4 hours)</li>
      <li>Stay hydrated with fresh juices and smoothies</li>
    </ul>
  </div>

  <div class="card">
    <h2>Before Donation Diet Tips</h2>
    <ul>
      <li>Drink 2-3 glasses of water within 2 hours of donating</li>
      <li>Eat a balanced meal 3 hours before donation</li>
      <li>Avoid heavy oily or fatty foods before donation</li>
      <li>Get enough sleep the night before</li>
    </ul>
  </div>

  <div class="card">
    <h2>After Donation Diet Tips</h2>
    <ul>
      <li>Drink extra fluids for 24 hours (Water, ORS, Juices)</li>
      <li>Eat iron-rich foods to replenish blood loss</li>
      <li>Have light healthy snacks immediately after donation</li>
      <li>Avoid intense physical activities for the next 24 hours</li>
    </ul>
  </div>

  <div class="card">
    <h2>General Healthy Tips for Donors</h2>
    <ul>
      <li>Donate only if feeling healthy and well</li>
      <li>Maintain a nutritious diet daily (not just during donation)</li>
      <li>Avoid alcohol 24 hours before and after donation</li>
      <li>Consult doctor if you feel dizziness, weakness, or discomfort</li>
    </ul>
  </div>

</div>


<?php include('includes/footer.php');?>

</body>
</html>
