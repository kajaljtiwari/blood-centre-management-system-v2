<?php
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">       
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood centre Management System</title>
    <link rel="stylesheet" href="style.css">
    
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fff0f0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: rgb(255, 8, 0);
            padding: 20px;
            text-align: center;
            color: white;
            position: relative;
        }

        .slider {
            position: relative;
            width: 100%;
            height: 60vh;
            overflow: hidden;
        }

        .slides {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .slide {
            display: none;
            width: 100%;
            height: 100%;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .prev, .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: black;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 24px;
        }

        .prev { left: 10px; }
        .next { right: 10px; }

        .content {
            flex: 1;
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 40px;
        }

        .box {
            background: white;
            padding: 20px;
            text-align: center;
            width: 30%;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <?php include('includes/header.php'); ?>

    <!-- IMAGE SLIDER -->
    <div class="slider">
        <div class="slides">
            <div class="slide"><img src="images/banner211.jpg" alt="Donate Blood"></div>
            <div class="slide"><img src="images/s1.jpeg" alt="Blood Donation Camp"></div>
            <div class="slide"><img src="images/banner2.jpg" alt="Save Lives"></div>
        </div>
        <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
        <button class="next" onclick="changeSlide(1)">&#10095;</button>
    </div>


    
    <?php include('includes/bloodunits.php'); ?>
    <?php include('includes/chatbot.php'); ?>
    <?php include('includes/bloodgroup.php'); ?>
    <?php include('includes/notice-board.php'); ?>

    <?php include('includes/footer.php'); ?>


    <!-- JavaScript -->
    <script>
        let slideIndex = 0;
        showSlides(slideIndex);

        function changeSlide(n) {
            showSlides(slideIndex += n);
        }

        function autoSlide() {
            showSlides(slideIndex += 1);
            setTimeout(autoSlide, 3000);
        }

        function showSlides(n) {
            let slides = document.querySelectorAll(".slide");
            if (n >= slides.length) slideIndex = 0;
            if (n < 0) slideIndex = slides.length - 1;

            slides.forEach(slide => slide.style.display = "none");
            slides[slideIndex].style.display = "block";
        }

        autoSlide();
    </script>

</body>
</html>
