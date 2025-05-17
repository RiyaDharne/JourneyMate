<?php 
    session_start();
    include('db.php');
    include('Details.php');

    // Taking input values from the form
    $src = isset($_POST['src']) ? ucwords($_POST['src']) : '';
    $dest = isset($_POST['dest']) ? ucwords($_POST['dest']) : '';
    $class = isset($_POST['class']) ? ucwords($_POST['class']) : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';

    // Query for fetching train details
    $sql = "SELECT t.train_no, t.train_name, s.source, s.arrival_time, s.destination, 
            s.depart_time, s.duration, t.seat_avail, t.class, s.station_no, s.fare 
            FROM train t, station s 
            WHERE s.source = '$src' AND s.destination = '$dest' 
            AND s.train_no = t.train_no";

    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>JourneyMate</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/png" href="JourneyMate-Logo.png">
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="asset/css/custom.css">

    <script src="asset/js/jquery-3.4.1.slim.min.js"></script>
    <script src="asset/js/popper.min.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>
</head>
<style>

         #bg-custom{
            background-color:rgba(2,2,2,0.8);
        }
        #m-cust{
            margin-right: 250px;
            margin-top: 60px; 
        }
        .bg-black{
            background-color:black;
        }
        .bg-img{
            background-image: url('asset/img/7.jpg');
            /*background-repeat: no-repeat;*/
            background-size: 100%;
            max-width: 1300px;
            min-height: 700px;
            /*opacity: 0.8;*/
        }
        @media(max-width: 400px){
            .bg-img{
                background-image: url('asset/img/5.jpg');
                background-size: auto;
                background-repeat: no-repeat;
                /*background-position: center*/

            }
        }

        .bg-img2{
            background-image:url('asset/img/5.jpg'); 
            background-size: 100%;
        }
        .pnr{
            background-color: white;
            color: black;
            /*width: 340px;*/
            padding-top: 10px;
            box-shadow: 2px 2px 18px 10px #222;
            border-radius: 2px;
        }
        
        .fs-1{
            font-size: 42px;
            font-family: Tempus Sans ITC;
            margin-top: 50px;
        }
        .fs-2{
            font-size: 18px;
            font-family: Yu Gothic Light;
            font-weight: lighter;
            margin-bottom: 50px; 
        }
        .form-control{
            width: 80px;
        }
        

    </style>

</head>
<body class="bg-light">
    
<!-- Search Form -->
<div class="container-fluid bg-light shadow">
    <div class="row">
        <div class="col-12 col-sm-1 mt-5 pt-4">
            <img src="asset/img/logo/rail_icon.png">
        </div>
        <div class="col-12 col-sm-11 pt-5 pb-5">
            <form action="" method="post" class="row">
                <div class="col-3">
                    <label class="text-bold">Origin</label>
                    <input class="form-control" type="text" name="src" value="<?php echo htmlspecialchars($src); ?>">
                </div>
                <div class="col-3">
                    <label class="text-bold">Destination</label>
                    <input class="form-control" type="text" name="dest" value="<?php echo htmlspecialchars($dest); ?>">
                </div>
                <div class="col-2">
                    <label class="text-bold">Journey Class</label>
                    <select class="custom-select" name="class">
                        <option value=""><?php echo htmlspecialchars($class); ?></option>
                        <option value="ALL">All Classes</option>
                        <option value="AC">AC</option>
                        <option value="SL">Sleeper (SL)</option>
                    </select>
                </div>
                <div class="col-2">
                    <label class="text-bold">Journey Date</label>
                    <input class="form-control" type="date" name="date" value="<?php echo htmlspecialchars($date); ?>">
                </div>
                <div class="col-2 mt-4 pt-2">
                    <input class="form-control btn btn-primary" type="submit" value="Modify Search">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Train List Section -->
<div class="container bg-light border mt-5">
    <div class="row border bg-white p-2 text-bold">
        <div class="col-md-3">Train Name & No</div>
        <div class="col-md-2">Departs</div>
        <div class="col-md-2">Arrival</div>
        <div class="col-md-2">Duration</div>
        <div class="col-md-2 text-center">Fare</div>
    </div>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($data = $result->fetch_assoc()): ?>
            <div class="card mb-2">
                <form action="psg_details.php" method="post" class="row">
                    <div class="col-md-3 pt-4 pl-5">
                        <h6>
                            <img src="asset/img/logo/rail_icon.png" width="25">
                            <span><?php echo htmlspecialchars($data["train_name"]); ?></span>
                            <span>(<?php echo htmlspecialchars($data["train_no"]); ?>)</span>
                        </h6>
                        <h6 class="text-bold">
                            <?php echo htmlspecialchars($data["source"]); ?>
                            <i class="fa fa-arrow-right"></i>
                            <?php echo htmlspecialchars($data["destination"]); ?>
                        </h6>
                        <h6 class="text-bold text-dark">Departs on: All Days</h6>
                    </div>

                    <div class="col-md-7">
                        <div class="card-body row">
                            <div class="col-3">
                                <img src="asset/img/logo/depar.png" width="30"><br>
                                <span><?php echo htmlspecialchars($data["depart_time"]); ?></span>
                                <input type="hidden" name="dep_time" value="<?php echo htmlspecialchars($data["depart_time"]); ?>">
                            </div>
                            <div class="col-3">
                                <img src="asset/img/logo/arrive.png" width="30"><br>
                                <span><?php echo htmlspecialchars($data["arrival_time"]); ?></span>
                                <input type="hidden" name="arr_time" value="<?php echo htmlspecialchars($data["arrival_time"]); ?>">
                            </div>
                            <div class="col-3">
                                <img src="asset/img/logo/time.png" width="30"><br>
                                <span><?php echo htmlspecialchars($data["duration"]); ?></span>
                                <input type="hidden" name="duration" value="<?php echo htmlspecialchars($data["duration"]); ?>">
                            </div>
                            <div class="col-3 text-center">
                                <h5 class="text-success">₹<?php echo htmlspecialchars($data["fare"]); ?></h5>
                                <input type="hidden" name="fare" value="<?php echo htmlspecialchars($data["fare"]); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 text-center mt-5">
                        <input type="hidden" name="src" value="<?php echo htmlspecialchars($src); ?>">
                        <input type="hidden" name="dest" value="<?php echo htmlspecialchars($dest); ?>">
                        <input type="hidden" name="class" value="<?php echo htmlspecialchars($class); ?>">
                        <input type="hidden" name="date" value="<?php echo htmlspecialchars($date); ?>">
                        <input type="hidden" name="train_name" value="<?php echo htmlspecialchars($data["train_name"]); ?>">
                        <input type="hidden" name="train_no" value="<?php echo htmlspecialchars($data["train_no"]); ?>">

                        <?php if ($data["seat_avail"] > 0): ?>
                            <input type="submit" value="Book Now" class="btn btn-primary">
                        <?php else: ?>
                            <button type="button" class="btn btn-secondary" disabled>Not Available</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="text-center text-danger mt-4">No Trains Available</p>
    <?php endif; ?>
</div>

<?php include('footer.html'); ?>

</body>
</html>