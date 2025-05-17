<?php 
session_start();
include('db.php'); 

$train_details = []; // Initialize train details array

if (isset($_GET['train_id']) && !empty($_GET['train_id'])) {
    $train_id = $_GET['train_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("
    SELECT trains.train_name, trains.train_number, stations.station_name, 
           stations.platform_number, stations.halt_duration
    FROM trains
    LEFT JOIN stations ON trains.train_id = stations.train_id
    WHERE trains.train_id = ?
    ORDER BY stations.station_order
");

    $stmt->bind_param("i", $train_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $train_details = $result->fetch_all(MYSQLI_ASSOC);
    }

    $stmt->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>JourneyMate </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="JourneyMate-Logo.png">
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="asset/css/custom.css">
    <script src="asset/js/jquery-3.4.1.min.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let stations = <?php echo json_encode($train_details); ?>;
            let currentStationIndex = 0;

            function updateStation() {
                if (currentStationIndex < stations.length) {
                    let station = stations[currentStationIndex];
                    document.getElementById('station-name').innerText = "Station: " + station.station_name;
                    document.getElementById('platform-number').innerText = "Platform: " + station.platform_number;
                    document.getElementById('halt-duration').innerText = "Halt Duration: " + station.halt_duration + " minutes";
                    currentStationIndex++;
                } else {
                    clearInterval(stationInterval);
                }
            }

            if (stations.length > 0) {
                setInterval(updateStation, 5000);
                updateStation(); // Show first station immediately
            }
        });
    </script>

    <style>
        .train-info {
            text-align: center;
            padding: 20px;
        }
        .train-stations {
            list-style-type: none;
            padding: 0;
            margin-top: 20px;
        }
        .train-stations li {
            margin-bottom: 15px;
            font-size: 18px;
        }
        .station-info {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
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
        .footer-nav .nav-btn {
            text-align: center;
            padding: 10px;
        }
        .footer-nav .nav-btn i {
            font-size: 20px;
        }
        .footer-nav .nav-btn a {
            text-decoration: none;
            color: #000;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h3>Enter Train Number to Track</h3>
        <form method="GET" action="">
            <div class="form-group">
                <label for="train_number">Train Number:</label>
                <input type="number" id="train_number" name="train_id" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Track Train</button>
        </form>
    </div>

    <?php if (!empty($train_details)): ?>
        <div class="train-info mt-5">
            <h3>Tracking Train: <?php echo htmlspecialchars($train_details[0]['train_name']); ?> 
                (Train Number: <?php echo htmlspecialchars($train_details[0]['train_number']); ?>)
            </h3>
            <ul class="train-stations">
                <?php foreach($train_details as $station): ?>
                    <li>
                        <strong>Station:</strong> <?php echo htmlspecialchars($station['station_name']); ?>
                        <br>
                        <strong>Platform:</strong> <?php echo htmlspecialchars($station['platform_number']); ?>
                        <br>
                        <strong>Halt Duration:</strong> <?php echo htmlspecialchars($station['halt_duration']); ?> minutes
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="station-info">
            <p id="station-name">Station: </p>
            <p id="platform-number">Platform: </p>
            <p id="halt-duration">Halt Duration: </p>
        </div>
    <?php elseif (isset($_GET['train_id'])): ?>
        <div class="alert alert-warning text-center mt-4">
            No train data found for Train ID: <?php echo htmlspecialchars($_GET['train_id']); ?>
        </div>
    <?php endif; ?>

    <div class="footer-nav">
        <div class="nav-btn active">
            <i class="fas fa-home"></i>
            <span><a href="index.php">Home</a></span>
        </div>
        <div class="nav-btn">
            <i class="fas fa-user"></i>
            <span><a href="myaccount.html">Account</a></span>
        </div>
        <div class="nav-btn">
            <i class="fas fa-shopping-cart"></i>
            <span>Shop</span>
        </div>
        <div class="nav-btn">
            <i class="fas fa-money-check-alt"></i>
            <span><a href="transaction.html">Transactions</a></span>
        </div>
        <div class="nav-btn">
            <i class="fas fa-ellipsis-h"></i>
            <span>More</span>
        </div>
    </div>

</body>
</html>
