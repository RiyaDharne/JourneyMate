<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JourneyMate</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="JourneyMate-Logo.png">
</head>

<body>
    <div class="container">
        <!-- Header Section -->
        <header>
            <img src="JourneyMate-Logo.png" class="logo" alt="JourneyMate Logo">
            <div class="auth-buttons">
                <?php if (!isset($_SESSION['username'])) { ?>
                    <a href="login.php"><button class="login-btn">Login</button></a>
                    <a href="register.php"><button class="register-btn">Register</button></a>
                    <a href="admin-login.php"><button class="admin-btn">Admin</button></a>
                <?php } else { ?>
                    <a href="logout.php"><button class="logout-btn">Logout</button></a>
                <?php } ?>
            </div>
        </header>

        <!-- Main Content Section -->
        <div class="main-content">

            <!-- Top Section with Services -->
            <div class="top-section">
                <?php 
                $services = [
                    ['src' => 'train.jpeg', 'alt' => 'Train', 'link' => 'trainindex.php', 'name' => 'Train'],
                    ['src' => 'flight.png', 'alt' => 'Flights', 'link' => 'flight-bus.php', 'name' => 'Flights'],
                    ['src' => 'bus.jpeg', 'alt' => 'Bus', 'link' => 'flight-bus.php', 'name' => 'Bus'],
                    ['src' => 'hotel.png', 'alt' => 'Hotel', 'link' => 'stays.php', 'name' => 'Hotel'],
                    ['src' => 'order food.jpeg', 'alt' => 'Order Food In Train', 'link' => 'Food-Website-main\Website.html', 'name' => 'Order Food']
                ];

                foreach ($services as $service) {
                    echo "<div class='service'>
                            <img src='{$service['src']}' alt='{$service['alt']}' class='service-icon'>
                            <p><a href='{$service['link']}'>" . $service['name'] . "</a></p>
                          </div>";
                }
                ?>
            </div>

            <!-- Middle Section with Extra Services -->
            <div class="middle-section">
                <?php 
                $extra_services = [
                    ['src' => 'tourism.jpeg', 'alt' => 'Tourism', 'link' => 'tourism.php', 'name' => 'Tourism'],
                    ['src' => 'retiring room.png', 'alt' => 'Retiring Room', 'link' => '#', 'name' => 'Retiring Room'],
                    ['src' => 'daily deals.jpeg', 'alt' => 'Daily Deals', 'link' => 'https://www.amazon.in/', 'name' => 'Daily Deals'],
                    ['src' => 'yatri mall.jpeg', 'alt' => 'Yatri Mall', 'link' => 'yatrimall.php', 'name' => 'Yatri Mall']
                ];
                

                foreach ($extra_services as $service) {
                    echo "<div class='service'>
                            <img src='{$service['src']}' alt='{$service['alt']}' class='service-icon'>
                            <p><a href='{$service['link']}'>" . $service['name'] . "</a></p>
                          </div>";
                }
                ?>
            </div>

            <!-- Bottom Section with Bills & Shop -->
            <div class="bottom-section">
                <?php 
                $shop_services = [
                    ['src' => 'recharge and bill.png', 'alt' => 'Recharge & Bills', 'link' => 'https://www.amazon.in/apay/bills-and-offers', 'name' => 'Recharge & Bills'],
                    ['src' => 'grocery.jpeg', 'alt' => 'Grocery', 'link' => '#', 'name' => 'Grocery'],
                    ['src' => 'kitchen.jpeg', 'alt' => 'Kitchen', 'link' => '#', 'name' => 'Kitchen'],
                    ['src' => 'contact.png', 'alt' => 'Contact us', 'link' => 'contact-us.php', 'name' => 'Contact us'],
                    ['src' => 'ask diksha 2.0.png', 'alt' => 'Ask Disha 2.0', 'link' => 'disha.php', 'name' => 'Ask Disha 2.0'],
                
                ];

                foreach ($shop_services as $service) {
                    echo "<div class='service'>
                            <img src='{$service['src']}' alt='{$service['alt']}' class='service-icon'>
                            <p><a href='{$service['link']}'>" . $service['name'] . "</a></p>
                          </div>";
                }
                ?>
                </div>
                
            </div>
        </div>

        <!-- Footer Navigation -->
        
        <div class="footer-nav">
            <div class="nav-btn active">
                <img src="home.jpeg" height="20px">
                <!-- <i class="home.jpeg" ></i> -->
                <span><a href="index.php">Home</a></span>
            </div>
            <div class="nav-btn">
            <img src="account.png" height="20px">
                <!-- <i class="fas fa-user"></i> -->
                <span><a href="myaccount.php">Account</a></span>
            </div>
            <div class="nav-btn">
            <img src="shop.png" height="20px">
                <!-- <i class="fas fa-shopping-cart"></i> -->
                <span>Shop</span>
            </div>
            <div class="nav-btn">
            <img src="transaction.png" height="20px">
                <!-- <i class="fas fa-money-check-alt"></i> -->
                <span><a href="transaction.html">Transactions</a></span>
            </div>
            <div class="nav-btn">
            <img src="more.png" height="20px">
                <!-- <i class="fas fa-ellipsis-h"></i> -->
                <span><a href="more.php">More</a></span>
            </div>
        </div>
                
    </div>
    <style>
    .footer-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: #fff;
        display: flex;
        justify-content: space-around;
        border-top: 1px solid #ddd;
        padding: 5px 0;
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
        <script src="homepage.js"></script>
</body>
</html>
