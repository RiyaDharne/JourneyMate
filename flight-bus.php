<?php
$servername = "localhost";
$username = "root";  // Change this if needed
$password = "";      // Change if needed
$dbname = "flight";  // Updated database name

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle search
$type = isset($_GET['type']) ? $_GET['type'] : "";
$search_departure = isset($_GET['departure']) ? $_GET['departure'] : "";
$search_destination = isset($_GET['destination']) ? $_GET['destination'] : "";

$result = null;
if ($type && $search_departure && $search_destination) {
    if ($type == "flight") {
        $query = "SELECT * FROM flights WHERE departure='$search_departure' AND destination='$search_destination'";
    } elseif ($type == "bus") {
        $query = "SELECT * FROM buses WHERE departure='$search_departure' AND destination='$search_destination'";
    }
    $result = $conn->query($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight & Bus Booking</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 0; padding: 0; }
        .navbar { background: #007bff; padding: 15px; color: white; font-size: 22px; }
        .container { max-width: 800px; margin: auto; padding: 20px; }
        .section { margin: 20px 0; padding: 20px; border: 1px solid #ddd; background: #f9f9f9; }
        .options { display: flex; justify-content: space-around; margin-bottom: 20px; }
        .option-btn { padding: 15px; width: 40%; font-size: 18px; border: none; cursor: pointer; color: white; }
        .flight-btn { background: #007bff; }
        .bus-btn { background: #28a745; }
        input, button { padding: 10px; margin: 10px; width: 45%; }
        button { background: #007bff; color: white; border: none; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #007bff; color: white; }
    </style>
</head>
<body>

    <div class="navbar">🚆 Flight & Bus Booking</div>

    <div class="container">

        <!-- Selection Window -->
        <div class="section">
            <h2>Choose Your Travel Mode</h2>
            <div class="options">
                <button class="option-btn flight-btn" onclick="showSearch('flight')">✈️ Flights</button>
                <button class="option-btn bus-btn" onclick="showSearch('bus')">🚌 Buses</button>
            </div>
        </div>

        <!-- Search Form (Initially Hidden) -->
        <div class="section" id="searchSection" style="display: none;">
            <h2 id="searchTitle">🔍 Search</h2>
            <form method="GET">
                <input type="hidden" name="type" id="travelType">
                <input type="text" name="departure" placeholder="Enter Departure" value="<?= htmlspecialchars($search_departure) ?>" required>
                <input type="text" name="destination" placeholder="Enter Destination" value="<?= htmlspecialchars($search_destination) ?>" required>
                <button type="submit">Search</button>
            </form>
        </div>

        <?php if ($type && $search_departure && $search_destination): ?>
            <!-- Display Search Results Only After Searching -->
            <div class="section">
                <h2><?= ($type == "flight") ? "✈️ Available Flights" : "🚌 Available Buses" ?></h2>
                <?php if ($result->num_rows > 0): ?>
                    <table>
                        <tr>
                            <th><?= ($type == "flight") ? "Airline" : "Operator" ?></th>
                            <th><?= ($type == "flight") ? "Flight No." : "Bus No." ?></th>
                            <th>Departure</th>
                            <th>Destination</th>
                            <th>Time</th>
                            <th>Price</th>
                        </tr>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($type == "flight" ? $row['airline'] : $row['operator']) ?></td>
                                <td><?= htmlspecialchars($type == "flight" ? $row['flight_number'] : $row['bus_number']) ?></td>
                                <td><?= htmlspecialchars($row['departure']) ?></td>
                                <td><?= htmlspecialchars($row['destination']) ?></td>
                                <td><?= htmlspecialchars($row['departure_time']) ?></td>
                                <td>₹<?= htmlspecialchars($row['price']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                <?php else: ?>
                    <p>No <?= ($type == "flight") ? "flights" : "buses" ?> found for this route.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>

    <script>
        function showSearch(type) {
            document.getElementById("searchSection").style.display = "block";
            document.getElementById("travelType").value = type;
            document.getElementById("searchTitle").innerText = type === "flight" ? "🔍 Search Flights" : "🔍 Search Buses";
        }
    </script>

</body>
</html>

<?php
$conn->close();
?>
