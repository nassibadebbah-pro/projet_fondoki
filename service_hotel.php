<?php
// 1. Connection with lowercase matched database name
$conn = mysqli_connect('localhost', 'root', '', 'fondouki_system');

if (!$conn) {
    die("<div style='color:red; text-align:center; padding:20px;'>Critical System Error: Database connection failure.</div>");
}

$date_today = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" href="../icons/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet" />

    <title>Reception Dashboard</title>
</head>

<body dir="ltr">
    <section class="home1" id="home">
        <nav>
            <h2>Fondoki <span>Your Hotel Guide</span></h2>
            <ul id="actions">
                <li><a href="../pagFondoki.php">Home</a></li>
                <li><a href="#home">Register Hotel</a></li>
                <li><a href="#home">Settings</a></li>
            </ul>
            <span id="date"></span>
            
            <a href="list_ch.php" class="btn">Rooms Inventory</a>
            
            <button id="menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav>
    </section>

    <h2 class="text-center" style="margin-top: 30px;">Kerdada Hotel Reception Desk</h2>
    
    <section class="services">
        <div class="box">
            
            <div class="card">
                <div class="container-images">
                    <img src="img/chambre-1.jpg" alt="Single Room">
                </div>
                <h3>Available Units: 
                <?php
                $sql_f1 = "SELECT COUNT(*) AS F1 FROM chambre WHERE type='Single'
                           AND nbrCH NOT IN (SELECT DISTINCT nbrCH FROM reservations WHERE (datR <= '$date_today' AND datS >= '$date_today'))";
                $result_f1 = mysqli_query($conn, $sql_f1);
                if ($result_f1 && $row_f1 = $result_f1->fetch_assoc()) {
                    echo htmlspecialchars($row_f1["F1"]);
                } else {
                    echo "0";
                }
                ?>
                </h3>
                <h5>Single Occupancy Room</h5>
                <a href="../chambre.php" class="btn">View Bookings</a>
            </div>

            <div class="card">
                <div class="container-images">
                    <img src="../img/chambre-2.jpg" alt="Double Room">
                </div>
                <h3>Available Units: 
                <?php
                $sql_f2 = "SELECT COUNT(*) AS F2 FROM chambre WHERE type='Double'
                           AND nbrCH NOT IN (SELECT DISTINCT nbrCH FROM reservations WHERE (datR <= '$date_today' AND datS >= '$date_today'))";
                $result_f2 = mysqli_query($conn, $sql_f2);
                if ($result_f2 && $row_f2 = $result_f2->fetch_assoc()) {
                    echo htmlspecialchars($row_f2["F2"]);
                } else {
                    echo "0";
                }
                ?>
                </h3>
                <h5>Double Occupancy Room</h5>
                <a href="../chambr2.php" class="btn">View Bookings</a>
            </div>

            <div class="card">
                <div class="container-images">
                    <img src="../img/Chambre-3.jpg" alt="Triple Room">
                </div>
                <h3>Available Units: 
                <?php
                $sql_f3 = "SELECT COUNT(*) AS F3 FROM chambre WHERE type='Triple'
                           AND nbrCH NOT IN (SELECT DISTINCT nbrCH FROM reservations WHERE (datR <= '$date_today' AND datS >= '$date_today'))";
                $result_f3 = mysqli_query($conn, $sql_f3);
                if ($result_f3 && $row_f3 = $result_f3->fetch_assoc()) {
                    echo htmlspecialchars($row_f3["F3"]);
                } else {
                    echo "0";
                }
                ?>
                </h3>
                <h5>Triple Occupancy Room</h5>
                <a href="../chambr3.php" class="btn">View Bookings</a>
            </div>

        </div>
    </section>

    <section class="skills">
        <div>
            <h2>Support Desk <span>At Your</span> Service</h2>
            <div class="tel">
                <div class="tel1"><img src="../icons/tel2.png" alt="Phone"><h3>06.76.04.76.23</h3></div>
                <div class="tel1"><img src="../icons/gmail.png" alt="Email"><h3>Fondouki.com</h3></div>
                <div class="tel1"><img src="../icons/instag.png" alt="Instagram"><h3>@fondouki_reserve</h3></div>
                <div class="tel1"><img src="../icons/facbook.png" alt="Facebook"><h3>facebook.com/fondouki</h3></div>
            </div>
        </div>
    </section>

    <footer>
        <div class="content-footer">
            <p>Copyright © Fondoki <?php echo date('Y'); ?> <img src="../icons/copyright_16px.png" alt="Copyright"> All Rights Reserved.</p>
        </div>
    </footer>

    <script src="../JS/date.js"></script>
</body>
</html>
<?php 
mysqli_close($conn); 
?>