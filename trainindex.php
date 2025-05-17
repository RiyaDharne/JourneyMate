<?php
// train-index.php

// Optional: Add any PHP logic here (e.g., session, database connection, etc.)
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JourneyMate</title>
  <link rel="stylesheet" href="new-trainstyle.css">
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
  

  <main>
    <section class="icon-grid">
      <!-- Book Ticket Icon -->
      <div class="icon" onclick="navigate('Book Ticket')"> 
        <img src="book ticket.jpeg" alt="Book Ticket">
        <p><a href="train-search.php"> Book Ticket</a></p>
      </div>

      <!-- My Bookings Icon -->
      <div class="icon" onclick="navigate('My Bookings')">
        <img src="my bookings.jpeg" alt="My Bookings">
        <p><a href="mybookings.php">My Bookings</a></p>
      </div>

      <!-- PNR Enquiry Icon -->
      <div class="icon" onclick="navigate('PNR Enquiry')">
        <img src="pnr.jpeg" alt="PNR Enquiry">
        <p><a href="pnrenquiry.php">PNR Enquiry</a></p>
      </div>

      <!-- Last Transaction Icon -->
      <div class="icon" onclick="navigate('Last Transaction')">
        <img src="last transcation.jpeg" alt="Last Transaction">
        <p><a href="last-transaction.php">Last Transaction</a></p>
      </div>

      <!-- Upcoming Journey Icon -->
      <div class="icon" onclick="navigate('Upcoming Journey')">
        <img src="upcoming journey.jpeg" alt="Upcoming Journey">
        <p><a href="upcoming-journey.php">Upcoming Journey</a></p>
      </div>

      <!-- Cancel Ticket Icon -->
      <div class="icon" onclick="navigate('Cancel Ticket')">
        <img src="cancel ticket.jpeg" alt="Cancel Ticket">
        <p><a href="cancel_ticket.php">Cancel Ticket</a></p>
      </div>

      <!-- File TDR Icon -->
      <div class="icon" onclick="navigate('File TDR')">
        <img src="tdr.png" alt="File TDR">
        <p><a href="TDR.html">File TDR</a></p>
      </div>

      <!-- Refund History Icon -->
      <div class="icon" onclick="navigate('Refund History')">
        <img src="refund.jpeg" alt="Refund History">
        <p><a href="refund.html">Refund History</a></p>
      </div>

      <!-- FAQ Icon -->
      <div class="icon" onclick="navigate('FAQ')">
        <img src="faq.jpeg" alt="FAQ">
        <p><a href="faq.php">FAQ</a></p>
      </div>

      <!-- Chart Vacancy Icon -->
      <div class="icon" onclick="navigate('Chart Vacancy')">
        <img src="chart vacany.jpeg" alt="Chart Vacancy">
        <p><a href="reservation-chart.php">Train Chart</a></p>
      </div>

      <!-- Train Schedule Icon -->
      <div class="icon" onclick="navigate('Train Schedule')">
        <img src="train schedule.jpeg" alt="Train Schedule">
        <p><a href="train-schedule.html">Train Schedule</a></p>
      </div>

      <!-- Track your Train Icon -->
      <div class="icon" onclick="navigate('Track your Train')">
        <img src="track your train.jpeg" alt="Track your Train">
        <p><a href="train-tracking.php">Track your Train</a></p>
      </div>

      <!-- Ask Diksha 2.0 Icon -->
      <div class="icon" onclick="navigate('Ask Diksha 2.0')">
        <img src="ask diksha 2.0.png" alt="Ask Diksha 2.0">
        <p><a href="disha.php"> Disha 2.0</a></p>
      </div>
    </section>

    <!-- Info Section -->
    <section class="info-section">
      <p>
        Please check the arrival/departure time of booked trains from 
        <a href="https://www.indianrail.gov.in" target="_blank">www.indianrail.gov.in</a>, 
        NTES OR 139 for any changes.
      </p>
    </section>
  </main>
</div>
  <!-- <script>
    // Navigation Logic
    function navigate(page) {
        alert(`Navigating to ${page}`);
        // Redirect Logic - Example
        // window.location.href = `backend/${page}.php`;
    }
  </script> -->

</body>
</html>
