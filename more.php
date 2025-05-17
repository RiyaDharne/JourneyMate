<?php
// Start session if needed
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JourneyMate</title>
    <link rel="stylesheet" href="more.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="header">MORE</div>
    <div class="container">
        <div class="menu-item" onclick="navigate('vikalp.php')">Vikalp for Counter Ticket <span>&#9654;</span></div>
        <div class="menu-item" onclick="navigate('counter_ticket.php')">Counter Ticket Cancellation/Boarding Point Change <span>&#9654;</span></div>
        <div class="menu-item" onclick="navigate('gallery.php')">Gallery <span>&#9654;</span></div>
        <div class="menu-item" onclick="navigate('about.php')">About Us <span>&#9654;</span></div>
        <div class="menu-item" onclick="navigate('contact.php')"><a href="contact-us.php"> Contact Us <span>&#9654;</a></span></div>
        <div class="menu-item" onclick="navigate('support.php')">Help & Support <span>&#9654;</span></div>
        <div class="menu-item" onclick="navigate('feedback.php')">Feedback <span>&#9654;</span></div>
        <div class="menu-item" onclick="navigate('rate.php')">Rate Us <span>&#9654;</span></div>
        <div class="menu-item">
            Biometric Authentication <input type="checkbox" id="biometricToggle">
        </div>
        <div class="menu-item" onclick="navigate('user_guide.php')">User Guide <span>&#9654;</span></div>
        <div class="menu-item" onclick="navigate('language.php')">Language | English <span>&#9654;</span></div>
    </div>
    
    <div class="footer emergency">
        For Medical Emergency/First Aid, Contact Ticket Checking Staff/Guard or Dial 139
    </div>
    
    <div class="footer-nav">
        <button class="nav-btn active">
          <i class="fas fa-home"></i> 
          <span><a href="index.php">Home</a></span>
        </button>
        <button class="nav-btn">
          <i class="fas fa-user"></i> 
          <span><a href="myaccount.php">Account</a></span>
        </button>
        <button class="nav-btn">
          <i class="fas fa-shopping-cart"></i> 
          <span><a href = "https://www.amazon.in/">Shop</a></span>
        </button>
        <button class="nav-btn">
          <i class="fas fa-money-check-alt"></i> 
          <span><a href="transaction.php">Transactions</a></span>
        </button>
        <button class="nav-btn">
          <i class="fas fa-ellipsis-h"></i> 
          <span><a href="more.php">More</a></span>
        </button>
    </div>

    <script>
        function navigate(page) {
            window.location.href = page;
        }

        document.getElementById("biometricToggle").addEventListener("change", function() {
            alert(this.checked ? "Biometric Authentication Enabled" : "Biometric Authentication Disabled");
        });
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .header {
            background: linear-gradient(to right, #ff7e5f, #ffb88c);
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
        }
        .container {
            width: 90%;
            margin: 20px auto;
            background: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .menu-item {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }
        .menu-item:hover {
            background: #f9f9f9;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: white;
            display: flex;
            justify-content: space-around;
            padding: 10px;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }
        .footer a {
            text-decoration: none;
            color: black;
            font-size: 14px;
        }
        .footer.emergency {
            text-align: center;
            font-size: 14px;
            padding: 10px;
            background: #ffe6e6;
            color: #d9534f;
        }
        .footer-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #fff;
            display: flex;
            justify-content: space-around;
            border-top: 1px solid #ddd;
            padding: 10px 0;
        }
        .nav-btn {
            background: none;
            border: none;
            color: #666;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }
        .nav-btn i {
            font-size: 18px;
        }
        .nav-btn.active {
            color: #ff7e5f;
        }
        .nav-item {
            background: none;
            border: none;
            color: #666;
            font-size: 14px;
            cursor: pointer;
        }
        .nav-item.active {
            color: #ff7e5f;
        }
    </style>

</body>
</html>
