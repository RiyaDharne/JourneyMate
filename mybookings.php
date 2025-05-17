<?php
// Database connection
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "train_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch upcoming bookings
$upcoming_query = "SELECT * FROM bookings WHERE booking_status = 'Upcoming' ORDER BY departure_time ASC";
$upcoming_result = $conn->query($upcoming_query);

// Fetch completed bookings
$completed_query = "SELECT * FROM bookings WHERE booking_status = 'Completed' ORDER BY departure_time DESC";
$completed_result = $conn->query($completed_query);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JourneyMate</title>
    <link rel="stylesheet" href="mybookings.css">
    
    <link rel="icon" type="image/png" href="JourneyMate-Logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hidden { display: none; }
        .active { font-weight: bold; }
        .booking { padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
        .status.upcoming { color: green; }
        .status.completed { color: gray; }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <div class="tabs">
            <button class="tab-btn active" data-tab="upcoming">Upcoming</button>
            <button class="tab-btn" data-tab="completed">Completed</button>
        </div>
        <div class="sort">
            <p>Sort By: <span class="sort-option">Departure Date</span></p>
            <p>Last Updated: <span id="last-updated"></span></p>
        </div>
    </div>

    <!-- Note Section -->
    <div class="note">
        <p>
            <strong>Note:</strong> Departure and Arrival Times are subject to change. 
            Please verify with Railway Station Enquiry. Dial 139 or SMS RAIL to 139.
        </p>
    </div>

    <!-- Upcoming Bookings -->
    <div class="content" id="upcoming">
        <?php if ($upcoming_result->num_rows > 0): ?>
            <?php while ($row = $upcoming_result->fetch_assoc()): ?>
                <div class="booking">
                    <p><strong>Train:</strong> <?php echo $row['train_name']; ?> (<?php echo $row['train_number']; ?>)</p>
                    <p><strong>From:</strong> <?php echo $row['departure_from']; ?> → <strong>To:</strong> <?php echo $row['departure_to']; ?></p>
                    <p><strong>Departure:</strong> <?php echo date("d M, Y h:i A", strtotime($row['departure_time'])); ?></p>
                    <p><strong>Platform:</strong> <?php echo $row['platform_number']; ?></p>
                    <p class="status upcoming">Upcoming</p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No upcoming bookings found.</p>
        <?php endif; ?>
    </div>

    <!-- Completed Bookings -->
    <div class="content hidden" id="completed">
        <?php if ($completed_result->num_rows > 0): ?>
            <?php while ($row = $completed_result->fetch_assoc()): ?>
                <div class="booking">
                    <p><strong>Train:</strong> <?php echo $row['train_name']; ?> (<?php echo $row['train_number']; ?>)</p>
                    <p><strong>From:</strong> <?php echo $row['departure_from']; ?> → <strong>To:</strong> <?php echo $row['departure_to']; ?></p>
                    <p><strong>Departure:</strong> <?php echo date("d M, Y h:i A", strtotime($row['departure_time'])); ?></p>
                    <p class="status completed">Completed</p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No completed bookings found.</p>
        <?php endif; ?>
    </div>

    <!-- Bottom Navigation -->
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

    <script>
        // Function to navigate to different pages
function navigate(page) {
    window.location.href = page;
}

// Prevent anchor tags from causing navigation issues
document.querySelectorAll(".nav-btn a").forEach(link => {
    link.addEventListener("click", (event) => {
        event.stopPropagation(); // Stop the event from bubbling up
    });
});

        // Tab Switching Functionality
        document.addEventListener("DOMContentLoaded", () => {
            const tabButtons = document.querySelectorAll(".tab-btn");
            const contents = document.querySelectorAll(".content");

            tabButtons.forEach((btn) => {
                btn.addEventListener("click", () => {
                    tabButtons.forEach((btn) => btn.classList.remove("active"));
                    contents.forEach((content) => content.classList.add("hidden"));
                    btn.classList.add("active");
                    document.getElementById(btn.getAttribute("data-tab")).classList.remove("hidden");
                });
            });
        });

        // Function to update "Last Updated" time
        function updateTime() {
            const now = new Date();
            const time = now.toLocaleTimeString('en-US', { hour12: false });
            const date = now.toLocaleDateString('en-US', { day: '2-digit', month: 'short', year: 'numeric' });
            document.getElementById('last-updated').textContent = `${time} ${date}`;
        }

        setInterval(updateTime, 1000);
        updateTime();
    </script>

</body>
</html>
