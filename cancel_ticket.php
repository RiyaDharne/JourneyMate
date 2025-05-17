<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "train_db"; 

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch ticket number from URL
$ticket_no = isset($_GET['ticket_no']) ? intval($_GET['ticket_no']) : 0;

// Fetch ticket details
$sql = "SELECT t.ticket_no, t.status, t.date, tr.train_name, t.departure_time, t.platform_no 
        FROM ticket t
        JOIN train tr ON t.train_no = tr.train_no
        WHERE t.ticket_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ticket_no);
$stmt->execute();
$result = $stmt->get_result();
$ticket = $result->fetch_assoc();

// Cancel ticket logic
if ($ticket && isset($_POST['cancel_ticket']) && $ticket['status'] !== 'CANCELLED') {
    $cancel_sql = "UPDATE ticket SET status='CANCELLED' WHERE ticket_no=?";
    $cancel_stmt = $conn->prepare($cancel_sql);
    $cancel_stmt->bind_param("i", $ticket_no);
    if ($cancel_stmt->execute()) {
        echo "<script>alert('Ticket Cancelled Successfully!'); window.location.href='cancel_ticket.php?ticket_no=$ticket_no';</script>";
    } else {
        echo "<script>alert('Cancellation Failed!');</script>";
    }
}

// Fetch all cancelled tickets
$cancelled_tickets_sql = "SELECT ticket_no, train_name, departure_time, platform_no 
                          FROM ticket t 
                          JOIN train tr ON t.train_no = tr.train_no
                          WHERE t.status='CANCELLED'";
$cancelled_tickets_result = $conn->query($cancelled_tickets_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Cancel Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            background: white;
            padding: 20px;
            margin: auto;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
        h2 {
            color: #004080;
        }
        p {
            font-size: 16px;
            color: #333;
            margin: 10px 0;
        }
        .cancel-btn {
            width: 100%;
            background-color: red;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
        .cancel-btn:hover {
            background-color: darkred;
        }
        .cancelled-section {
            margin-top: 20px;
            padding: 10px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .cancelled-list {
            list-style-type: none;
            padding: 0;
        }
        .cancelled-list li {
            background: #ffdddd;
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
        }      .footer-nav {
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
    <h2>Cancel Ticket Details</h2>
    <?php if ($ticket): ?>
        <p><strong>Train Name:</strong> <?php echo htmlspecialchars($ticket['train_name']); ?></p>
        <p><strong>Departure:</strong> <?php echo htmlspecialchars($ticket['departure_time']); ?></p>
        <p><strong>Platform:</strong> <?php echo htmlspecialchars($ticket['platform_no']); ?></p>
        <p><strong>Status:</strong> <?php echo strtoupper($ticket['status']); ?></p>

        <?php if ($ticket['status'] !== 'CANCELLED'): ?>
            <form method="POST" onsubmit="return confirm('Are you sure you want to cancel this ticket?');">
                <button type="submit" name="cancel_ticket" class="cancel-btn">Cancel Ticket</button>
            </form>
        <?php else: ?>
            <p style="color:red; font-weight:bold;">Ticket is already cancelled</p>
        <?php endif; ?>
    <?php else: ?>
        <p style="color:red;">Invalid Ticket Number!</p>
    <?php endif; ?>
</div>

<!-- Cancelled Tickets Section -->
<div class="cancelled-section">
    <h3>Cancelled Tickets</h3>
    <ul class="cancelled-list">
        <?php while ($row = $cancelled_tickets_result->fetch_assoc()): ?>
            <li>
                <strong>Train:</strong> <?php echo htmlspecialchars($row['train_name']); ?> |
                <strong>Departure:</strong> <?php echo htmlspecialchars($row['departure_time']); ?> |
                <strong>Platform:</strong> <?php echo htmlspecialchars($row['platform_no']); ?>
            </li>
        <?php endwhile; ?>
    </ul>
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
    <script>
    function navigate(page) {
    window.location.href = page;
}

// Prevent anchor tags from causing navigation issues
document.querySelectorAll(".nav-btn a").forEach(link => {
    link.addEventListener("click", (event) => {
        event.stopPropagation(); // Stop the event from bubbling up
    });
});
</script>
</body>
</html>
