<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$database = "train_db";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch upcoming journeys
$sql = "SELECT train_name, train_number, departure_from, departure_to, 
               departure_time, platform_number, booking_status 
        FROM bookings 
        WHERE booking_status = 'Upcoming' 
        ORDER BY departure_time ASC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Journeys</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <link rel="icon" type="image/png" href="JourneyMate-Logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #003366;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #003366;
            color: white;
            font-size: 14px;
        }
        td {
            font-size: 14px;
            background-color: #f9f9f9;
        }
        tr:nth-child(even) td {
            background-color: #f1f1f1;
        }
        .no-data {
            color: red;
            font-size: 18px;
            margin-top: 20px;
            font-weight: bold;
        }
        .train-icon {
            color: #003366;
            font-size: 20px;
            margin-right: 5px;
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
</head>
<body>

<div class="container">
    <h2><i class="fa-solid fa-train train-icon"></i> Upcoming Journeys</h2>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Train Name</th>
                <th>Train No</th>
                <th>From</th>
                <th>To</th>
                <th>Departure</th>
                <th>Platform</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['train_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['train_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['departure_from']); ?></td>
                    <td><?php echo htmlspecialchars($row['departure_to']); ?></td>
                    <td><?php echo date("d M Y, h:i A", strtotime($row['departure_time'])); ?></td>
                    <td><?php echo htmlspecialchars($row['platform_number']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p class="no-data">No upcoming journeys found.</p>
    <?php endif; ?>
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
<script>function navigate(page) {
    window.location.href = page;
}

// Prevent anchor tags from causing navigation issues
document.querySelectorAll(".nav-btn a").forEach(link => {
    link.addEventListener("click", (event) => {
        event.stopPropagation(); // Stop the event from bubbling up
    });
});
</script>
<?php
$conn->close();
?>
