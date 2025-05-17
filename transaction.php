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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="icon" type="image/png" href="JourneyMate-Logo.png">
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
            transition: background 0.2s ease-in-out;
        }
        .menu-item:hover {
            background: #f9f9f9;
        }
        .menu-text {
            display: flex;
            align-items: center;
            gap: 12px; /* Space between icon and text */
            font-size: 16px;
            font-weight: bold;
        }
        .menu-text i {
            width: 22px; /* Ensures all icons take same width */
            text-align: center;
            font-size: 18px;
            color: #ff7e5f;
            flex-shrink: 0; /* Prevents shrinking */
        }
        .icon-group {
            display: flex;
            align-items: center;
            gap: 5px;
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
            font-size: 20px;
        }
        .nav-btn.active {
            color: #ff7e5f;
        }
        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
    <script>
        function navigate(page) {
            window.location.href = page;
        }
    </script>
</head>
<body>
    <div class="header">MY TRANSACTIONS</div>
    <div class="container">
        <div class="menu-item" onclick="navigate('mybookings.php')">
            <div class="menu-text">
                <i class="fas fa-calendar-check"></i> My Bookings
            </div>
            <span>&#9654;</span>
        </div>
        <div class="menu-item" onclick="navigate('failed.php')">
            <div class="menu-text">
                <i class="fas fa-times-circle"></i> Failed Transactions
            </div>
            <span>&#9654;</span>
        </div>
        <div class="menu-item" onclick="navigate('cancel_ticket.php')">
            <div class="menu-text">
                <i class="fas fa-ticket-alt"></i> Cancelled Tickets
            </div>
            <span>&#9654;</span>
        </div>
        <div class="menu-item" onclick="navigate('tdr.html')">
            <div class="menu-text">
                <span class="icon-group">
                    <i class="fas fa-file-alt"></i>
                </span>
                TDR History
            </div>
            <span>&#9654;</span>
        </div>
        <div class="menu-item" onclick="navigate('refund.html')">
            <div class="menu-text">
               <span class="icon-group">
                <i class="fas fa-history"></i>
             </span>
             Ticket Refund History
            </div>
            <span>&#9654;</span>
        </div>
    </div>
    <div class="footer-nav">
        <button class="nav-btn active" onclick="navigate('index.php')">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </button>
        <button class="nav-btn" onclick="navigate('myaccount.php')">
            <i class="fas fa-user"></i>
            <span>Account</span>
        </button>
        <button class="nav-btn">
            <i class="fas fa-shopping-cart"></i>
            <span><a href="https://www.amazon.in/">Shop</a></span>
        </button>
        <button class="nav-btn" onclick="navigate('transaction.php')">
            <i class="fas fa-money-check-alt"></i>
            <span>Transaction</span>
        </button>
        <button class="nav-btn" onclick="navigate('more.php')">
            <i class="fas fa-ellipsis-h"></i>
            <span>More</span>
        </button>
    </div>
</body>
</html>
