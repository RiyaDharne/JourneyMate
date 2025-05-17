<?php 
    session_start();
    include('Details.php');
    include('db.php'); 

    if(isset($_SESSION['update'])){
         unset($_SESSION['update']);
    }

    if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo "<script> alert('You are logged in'); </script>";
    } else if (isset($_GET['logout']) && $_GET['logout'] == 1) {
            echo "<script> alert('You are logged out'); </script>";
    }

    if(isset($_SESSION["uname"])){
        $uname = $_SESSION["uname"];
    }
?>

<!doctype html>
<html lang="en">
<head>
    <title>JourneyMate</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="icon" type="image/png" href="JourneyMate-Logo.png">
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="asset/css/animate.css">
    <link rel="stylesheet" href="asset/css/hover-min.css">
    <link rel="stylesheet" href="asset/css/custom.css">

    <script src="asset/js/jquery-3.4.1.min.js"></script>
    <script src="asset/js/popper.min.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>
    <script src="asset/js/validation.js"></script>

    <script>
        function updateDateTime() {
            var today = new Date();
            document.getElementById('current-date-time').innerHTML = `Date: ${today.toLocaleDateString()} | Time: ${today.toLocaleTimeString()}`;
        }
        setInterval(updateDateTime, 1000);

        function swapStations() {
            let from = document.getElementById("from");
            let to = document.getElementById("to");
            [from.value, to.value] = [to.value, from.value];
        }
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f5f7;
            margin: 0;
            padding-bottom: 60px;
        }

        .search-header {
            background: linear-gradient(to right, #ff7e5f, #ffbb00);
            color: white;
            text-align: center;
            padding: 15px;
            position: relative;
            font-weight: bold;
        }

        .search-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            max-width: 500px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            font-weight: bold;
            display: block;
        }

        .input-group input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .swap-icon {
            text-align: center;
            font-size: 22px;
            margin: 10px 0;
            color: #ff7e5f;
            cursor: pointer;
        }

        .search-btn {
            width: 100%;
            background: #ff7e5f;
            color: white;
            border: none;
            padding: 12px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .search-btn:hover {
            background: #ff6243;
        }
    </style>
</head>

<body onload="updateDateTime();">
    <div class="search-header">
        <h2>TRAIN SEARCH</h2>
        <p id="current-date-time"></p>
    </div>

    <div class="search-container">
        <form action="./train-available.php" method="post">
            <div class="input-group">
                <label>From</label>
                <input type="text" id="from" name="src" placeholder="Enter Source Station" required>
            </div>

            <div class="swap-icon" onclick="swapStations()">
                <i class="fas fa-exchange-alt"></i>
            </div>

            <div class="input-group">
                <label>To</label>
                <input type="text" id="to" name="dest" placeholder="Enter Destination Station" required>
            </div>

            <div class="input-group">
                <label>Class</label>
                <select name="class">
                    <option>All Classes</option>
                    <option>AC </option>
                    <option>Sleeper (SL)</option>
                </select>
            </div>

            <div class="input-group">
                <label>Quota</label>
                <select name="quota">
                    <option>GENERAL</option>
                    <option>TATKAL</option>
                </select>
            </div>

            <div class="input-group">
                <label>Departure Date</label>
                <input type="date" name="date" required>
            </div>

            <button type="submit" class="search-btn">SEARCH TRAINS</button>
        </form>
    </div>
</body>
</html>
