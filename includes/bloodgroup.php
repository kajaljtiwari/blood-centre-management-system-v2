<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    .contact-section {
      display: flex;
      justify-content: center;
      align-items: stretch;
      gap: 30px;
      max-width: 1200px;
      margin: 50px auto;
      padding: 30px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      flex-wrap: wrap;
    }

    .contact-left {
      flex: 1;
      min-width: 300px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .contact-left img {
      width: 100%;
      max-width: 500px;
      border-radius: 10px;
      object-fit: cover;
    }

    .blood-metro {
      flex: 1;
      padding: 20px;
      background: #f7f7f7;
      border-radius: 10px;
    }

    .blood-metro h2 {
      text-align: center;
      color: #cc0000;
      margin-bottom: 30px;
    }

    .metro-line {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    .station {
      position: relative;
      background: #ffeaea;
      padding: 15px 25px;
      border-radius: 8px;
      font-weight: bold;
      color: #cc0000;
      cursor: pointer;
      border: 2px solid #cc0000;
      transition: all 0.3s ease;
    }

    .station:hover {
      background: #cc0000;
      color: white;
    }

    .station .tooltip {
      display: none;
      position: absolute;
      top: 60px;
      left: 50%;
      transform: translateX(-50%);
      width: 220px;
      background: white;
      color: #333;
      padding: 10px;
      border-radius: 8px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      z-index: 100;
      font-weight: normal;
      text-align: center;
    }

    .station:hover .tooltip {
      display: block;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="contact-section">

    <!-- Left Side: Image -->
    <div class="contact-left">
      <img src="images/bloodgroup.jpg" alt="Blood Donation Image">
    </div>

    <!-- Right Side: Blood Compatibility Info -->
    <section class="blood-metro">
      <h2>Compatible Blood Type Donors</h2>

      <div class="metro-line">
        <div class="station"><span>A+</span>
          <div class="tooltip">Donate to: A+, AB+<br>Receive from: A+, A−, O+, O−</div>
        </div>

        <div class="station"><span>A−</span>
          <div class="tooltip">Donate to: A+, A−, AB+, AB−<br>Receive from: A−, O−</div>
        </div>

        <div class="station"><span>O+</span>
          <div class="tooltip">Donate to: A+, B+, AB+, O+<br>Receive from: O+, O−</div>
        </div>

        <div class="station"><span>O−</span>
          <div class="tooltip">Donate to: Everyone<br>Receive from: O−</div>
        </div>

        <div class="station"><span>B+</span>
          <div class="tooltip">Donate to: B+, AB+<br>Receive from: B+, B−, O+, O−</div>
        </div>

        <div class="station"><span>B−</span>
          <div class="tooltip">Donate to: B+, B−, AB+, AB−<br>Receive from: B−, O−</div>
        </div>

        <div class="station"><span>AB+</span>
          <div class="tooltip">Donate to: AB+<br>Receive from: Everyone</div>
        </div>

        <div class="station"><span>AB−</span>
          <div class="tooltip">Donate to: AB+, AB−<br>Receive from: AB−, A−, B−, O−</div>
        </div>
      </div>
    </section>

  </div>
</div>


</body>
</html>
