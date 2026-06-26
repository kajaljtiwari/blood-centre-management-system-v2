<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us | Blood Bank Management System</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background:rgba(238, 192, 26, 0.84);
            margin: 0;
            padding: 0;
        }
        .section {
    padding: 40px 20px;
    max-width: 1100px;
    margin: auto;
    background: #fff5f5;
    margin-top: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}


            
       /* why-choose-us*/
       .why-choose-us {
    padding: 60px 10%;
    background-color: #fff5f5;
}

.section-title {
    text-align: center;
    font-size: 36px;
    margin-bottom: 50px;
    color: #111;
}
.section-title span {
    color: #d60000;
}

.choose-content {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 40px;
}

.choose-image img {
    width: 100%;
    max-width: 500px;
    border-radius: 20px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.choose-text {
    flex: 1;
    min-width: 300px;
}

.choose-text h3 {
    font-size: 28px;
    color: #d60000;
    margin-bottom: 20px;
}

.choose-text p {
    font-size: 16px;
    color: #333;
    line-height: 1.7;
    margin-bottom: 15px;
}

.btn-join {
    display: inline-block;
    margin-top: 20px;
    background-color: #d60000;
    color: #fff;
    padding: 12px 25px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: 0.3s ease;
}
.btn-join:hover {
    background-color: #a70000;
}








        /*vision-mission*/
        .vision-mission-section {
    padding: 50px 10%;
    background: #fff;
}

.vm-heading {
    text-align: center;
    font-size: 36px;
    color: #111;
}
.vm-heading span {
    color: #d60000;
}

.vm-container {
    display: flex;
    flex-direction: column;
    gap: 30px;
    margin-top: 30px;

}

.vm-box {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 30px;
    flex-wrap: wrap;
}

.vm-box.image-left .vm-image {
    order: 1;
}
.vm-box.image-left .vm-text {
    order: 2;
}

.vm-box.image-right .vm-image {
    order: 2;
}
.vm-box.image-right .vm-text {
    order: 1;
}

.vm-image img {
    width: 100%;
    max-width: 400px;
    border-radius: 20px;
    border: 5px solid #d60000;
    padding: 10px;
    background: #fbecec;
}

.vm-text {
    flex: 1;
    min-width: 300px;
}
.vm-text h3 {
    font-size: 26px;
    color: #d60000;
}
.vm-text p {
    font-size: 16px;
    color: #333;
    line-height: 1.7;
}
.vm-text ul {
    padding-left: 20px;
    margin-top: 10px;
    margin-bottom: 10px;
}
.vm-text ul li {
    margin-bottom: 8px;
    color: #444;
}

        /*our benefits*/
        .benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 30px;
}
.benefit-card {
    text-align: center;
    padding: 20px;
    background: #fff7f7;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    transition: 0.3s ease;
}
.benefit-card:hover {
    transform: translateY(-5px);
}
.benefit-card img {
    width: 60px;
    margin-bottom: 15px;
}
.benefit-card h3 {
    color: #a00000;
    margin-bottom: 10px;
}
.benefit-card p {
    font-size: 15px;
    color: #444;
    line-height: 1.6;
}

    </style>
</head>
<body>

<!-- HEADER INCLUDE -->
<?php include('includes/header.php'); ?>


<section class="why-choose-us">
    <div class="container">
        <h2 class="section-title"><span>Why</span> Choose Us</h2>

        <div class="choose-content">
            <div class="choose-image">
                <img src="images/3.jpg" alt="Join the Cause">
            </div>
            <div class="choose-text">
                <h3>Join the Cause</h3>
                <p>
                    Our Blood Bank Management System is designed to bridge the gap between donors and those in need. It simplifies the process of finding blood, donating, and ensuring it reaches the right hands on time.
                </p>
                <p>
                    Whether it's an emergency or a scheduled requirement, our platform supports real-time search, smart donor and request forms, instant alerts, and appointment scheduling — making blood donation more effective than ever.
                </p>
                <p>
                    For blood banks, hospitals, and clinics, our system streamlines inventory management, request tracking, and reporting — ensuring no unit goes to waste and every drop counts.
                </p>
                <p>
                    We invite individuals to become a part of this life-saving mission. A single donation can save up to three lives. Be the reason someone lives. Join us in this noble cause.
                </p>

                <a href="sign-up.php" class="btn-join">Register as Donor</a>
            </div>
        </div>
    </div>
</section>

<!--vision-mission-->
<div class="vision-mission-section">
    <h2 class="vm-heading"><span>Our</span> Vision <span>and</span> Mission</h2>
    
    <div class="vm-container">
        <div class="vm-box image-left">
            <div class="vm-image">
                <img src="images/vission.png" alt="Vision Image">
            </div>
            <div class="vm-text">
                <h3>Vision</h3>
                <p>
                    Our vision is to build a nation where the availability of blood is never a reason for loss of life. 
                    We aim to create a 24x7 digital ecosystem that ensures timely access to safe blood, regardless of location, urgency, or time. 
                    We believe that every drop counts and every donor matters.
                </p>
                <p>
                    Through technological innovation and community-driven initiatives, we seek to make blood donation a seamless and regular activity for every eligible citizen.
                    Our ultimate goal is to become a reliable bridge between donors and those in need — saving lives, one donation at a time.
                </p>
            </div>
        </div>

        <div class="vm-box image-right">
            <div class="vm-text">
                <h3>Mission</h3>
                <p>
                    Our mission is clear — <strong>Nobody should die waiting for blood after 31st December 2025.</strong>
                    To achieve this, we are committed to:
                </p>
                <ul>
                    <li>⏱️ Providing real-time blood availability status across hospitals and blood banks.</li>
                    <li>🧑‍🤝‍🧑 Creating a verified database of active and emergency donors.</li>
                    <li>📍 Notifying nearby donors instantly during emergencies using geo-location services.</li>
                    <li>📊 Ensuring transparent, data-driven reporting for government and medical authorities.</li>
                    <li>📢 Spreading awareness about blood donation through education and outreach programs.</li>
                </ul>
                <p>
                    We believe no family should experience the fear of losing a loved one due to unavailability of blood.
                    Our system is dedicated to ensuring that blood donations are efficient, fast, and always available when needed.
                </p>
            </div>
            <div class="vm-image">
                <img src="images/mission.png" alt="Mission Image">
            </div>
        </div>
    </div>
</div>

<!--our benefits-->
<div class="section">
    <h2 style="text-align: center; color: #b30000;">Our Benefits</h2>
    <div class="benefits-grid">
        <div class="benefit-card">
            <img src="images/peer-connection.png" alt="Peer-to-Peer Connect">
            <h3>Peer-to-Peer Connect</h3>
            <p>
                We link up people who provide blood donations with those who need it, so that the donor can witness the positive outcome of their contribution in someone's life.
            </p>
        </div>
        <div class="benefit-card">
            <img src="images/balance.png" alt="Demand Supply Balance">
            <h3>Demand Supply Balance</h3>
            <p>
                By directly providing blood to those in need, the donation will be used to fill an existing demand without being wasted.
            </p>
        </div>
        <div class="benefit-card">
            <img src="images/near-me.png" alt="Near By">
            <h3>Near By</h3>
            <p>
                We notify donors within a 5 km radius of a request, enhancing the chances of a quick and successful donation.
                This reduces the time taken and increases efficiency.
            </p>
        </div>
        <div class="benefit-card">
            <img src="images/on-time.png" alt="Real Time">
            <h3>Real Time</h3>
            <p>
                Our system quickly connects donors and recipients, saving precious time that could be critical in emergencies.
            </p>
        </div>
    </div>
</div>

<!--FOOTER INCLUDE-->
<?php include('includes/footer.php'); ?>

</body>
</html>
