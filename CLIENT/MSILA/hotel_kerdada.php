<?php
$count = 0;

// Initialize messaging variables to prevent notice warnings
$success_message = "";
$error = [];

// Unified Database Connection to fondouki_system
$conn = mysqli_connect('localhost', 'root', '', 'fondouki_system');

if (!$conn) {
    die("Database context routing connectivity failure: " . mysqli_connect_error());
}

// Set target hotel ID for "Hotel Kerdada" context
$current_hotel_id = 1; 

// Action 1: Handle Review Submission Pipeline
if (isset($_POST['submit2'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $com = mysqli_real_escape_string($conn, $_POST['com']);
    
    // Validate user authentication via new users table
    $select = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";
    $result = mysqli_query($conn, $select);
    
    if ($result && mysqli_num_rows($result) > 0) {
        // Insert review pinned to current hotel context
        $insert = "INSERT INTO commentaires (hotel_id, user_email, com) VALUES ('$current_hotel_id', '$email', '$com')";
        if (mysqli_query($conn, $insert)) {
            $success_message = "Your review has been successfully submitted!";
        } else {
            $error[] = "Failed to submit comment.";
        }
    } else {
        $success_message = "Authentication failure: You are not registered on this platform.";
    }
}

// Action 2: Handle Room Booking Submission Transaction Matrix
$show_receipt = false;
$receipt_data = null;

if (isset($_POST['submit1'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);
    $adrss = mysqli_real_escape_string($conn, $_POST['adrss']);
    $datres = mysqli_real_escape_string($conn, $_POST['datres']);
    $datsort = mysqli_real_escape_string($conn, $_POST['datsort']);
    $tcart = isset($_POST['Tcart']) ? mysqli_real_escape_string($conn, $_POST['Tcart']) : '';
    $nbrpymt = mysqli_real_escape_string($conn, $_POST['nbrPymt']);
    $Tchambr = mysqli_real_escape_string($conn, $_POST['Tchambr']);
    $date_today = date("Y-m-d");

    // Try to find a user ID dynamically if they are registered
    $user_id_query = mysqli_query($conn, "SELECT id FROM users WHERE email='$email' LIMIT 1");
    $user_id = ($user_id_query && mysqli_num_rows($user_id_query) > 0) ? mysqli_fetch_assoc($user_id_query)['id'] : "NULL";

    // Room Allocation Engine Lookup Query Mapping via unified 'chambres' table
    $sql = "SELECT nbrCH, prix FROM chambres 
            WHERE hotel_id = '$current_hotel_id' 
            AND type = '$Tchambr' 
            AND status = 'available'
            AND nbrCH NOT IN (
                SELECT DISTINCT nbrCH FROM reservations 
                WHERE hotel_id = '$current_hotel_id' 
                AND (DatR <= '$datsort' AND DatS >= '$datres')
            ) LIMIT 1";
            
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nbrCH = $row['nbrCH'];
        $prix = $row['prix'];
        
        $time_diff = strtotime($datsort) - strtotime($datres);
        $NBRjour = max(1, round($time_diff / (60 * 60 * 24)));
        $Ptotal = $NBRjour * $prix;

        $insertSql = "INSERT INTO reservations (hotel_id, user_id, NOM, Email, nbrCH, TEL, ADRS, DatR, DatS, NBRjour, Tcart, Ncart, Tchambr, RES, prix, Ptotal, date) 
                      VALUES ('$current_hotel_id', $user_id, '$nom', '$email', '$nbrCH', '$tel', '$adrss', '$datres', '$datsort', '$NBRjour', '$tcart', '$nbrpymt', '$Tchambr', 'YES', '$prix', '$Ptotal', '$date_today')";

        if ($conn->query($insertSql) === TRUE) {
            $show_receipt = true;
            $receipt_data = [
                "NOM" => $nom, "TEL" => $tel, "nbrCH" => $nbrCH, "Tchambr" => $Tchambr,
                "DatR" => $datres, "DatS" => $datsort, "prix" => $prix, "NBRjour" => $NBRjour, "Ptotal" => $Ptotal
            ];
        } else {
            $error[] = "Database ingestion error metadata profile code: " . $conn->error;
        }
    } else {
        $error[] = "No available inventory matches specified tracking timelines.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Book your stay at the historic Kerdada Hotel.">
    <meta name="keywords" content="hotel, rooms, booking, dashboard, kerdada, bou saada">
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="icon" href="/icons/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet"/>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Kerdada Hotel Portfolio</title>
</head>
<body dir="ltr">

    <?php if (!empty($success_message)): ?>
    <div id="myPopup" class="popup-box" style="padding: 15px; background: #f4f4f5; border: 1px solid #d4d4d8; margin: 10px 0;">
        <h3>System Notification Channel</h3>
        <p><?php echo htmlspecialchars($success_message); ?></p>
    </div>
    <?php endif; ?>

    <nav>
        <h2>Fondoki <span>Your Hotel Guide</span></h2>
        <ul id="actions">
            <li><a href="/pagFondoki.php">Home</a></li>
        </ul>
        <span id="date"></span>
        <a href="login.php" class="btn">User Sign-In</a>
        <button id="menu">
            <span></span><span></span><span></span>
        </button>
    </nav> 

    <section class="about">
        <h2>Kerdada Hotel Rooms Overview</h2>
    </section>

    <section class="services">
        <div class="dof">
            
            <div class="hotel">
                <div><img src="/images/chambre-1.jfif" alt="Single Room Layout"></div>
                <p class="fas fa-mobile-alt"></p>
                <div>
                    <h3>Single Occupancy Room</h3>
                    <p><span>Available Units Left:</span>
                    <?php
                    $date_check = date("Y-m-d");
                    $sql_f1 = "SELECT COUNT(*) AS F1 FROM chambres WHERE hotel_id = '$current_hotel_id' AND type='Single Room' AND status='available' AND nbrCH NOT IN (SELECT DISTINCT nbrCH FROM reservations WHERE hotel_id = '$current_hotel_id' AND (DatR <= '$date_check' AND DatS >= '$date_check'))";
                    $res_f1 = mysqli_query($conn, $sql_f1);
                    $row_f1 = $res_f1->fetch_assoc();
                    echo htmlspecialchars($row_f1["F1"]);
                    ?>
                    </p>
                    <a class="btn myBtnTrigger" style="cursor:pointer">Book Room</a>
                </div>
                <div class="prix">
                    <h5>Base Nightly Cost</h5>
                    <p style="color:blue">
                    <?php
                    $sql_p1 = "SELECT prix FROM chambres WHERE hotel_id = '$current_hotel_id' AND type='Single Room' LIMIT 1";
                    $res_p1 = mysqli_query($conn, $sql_p1);
                    if($row_p1 = $res_p1->fetch_assoc()) { echo htmlspecialchars(round($row_p1["prix"])) . " DA"; }
                    ?>
                    </p>
                </div>
            </div>

            <div class="hotel">
                <div><img src="/images/chambre-2.jpg" alt="Double Room Layout"></div>
                <p class="fas fa-mobile-alt"></p>
                <div>
                    <h3>Double Occupancy Room</h3>
                    <p><span>Available Units Left:</span>
                    <?php
                    $sql_f2 = "SELECT COUNT(*) AS F2 FROM chambres WHERE hotel_id = '$current_hotel_id' AND type='Double Room' AND status='available' AND nbrCH NOT IN (SELECT DISTINCT nbrCH FROM reservations WHERE hotel_id = '$current_hotel_id' AND (DatR <= '$date_check' AND DatS >= '$date_check'))";
                    $res_f2 = mysqli_query($conn, $sql_f2);
                    $row_f2 = $res_f2->fetch_assoc();
                    echo htmlspecialchars($row_f2["F2"]);
                    ?>
                    </p>
                    <a class="btn myBtnTrigger" style="cursor:pointer">Book Room</a>
                </div>
                <div class="prix">
                    <h5>Base Nightly Cost</h5>
                    <p style="color:blue">
                    <?php
                    $sql_p2 = "SELECT prix FROM chambres WHERE hotel_id = '$current_hotel_id' AND type='Double Room' LIMIT 1";
                    $res_p2 = mysqli_query($conn, $sql_p2);
                    if($row_p2 = $res_p2->fetch_assoc()) { echo htmlspecialchars(round($row_p2["prix"])) . " DA"; }
                    ?>
                    </p>
                </div>
            </div>

            <div class="hotel">
                <div><img src="/images/Chambre-3.jpg" alt="Triple Room Layout"></div>
                <p class="fas fa-mobile-alt"></p>
                <div>
                    <h3>Triple Occupancy Room</h3>
                    <p><span>Available Units Left:</span>
                    <?php
                    $sql_f3 = "SELECT COUNT(*) AS F3 FROM chambres WHERE hotel_id = '$current_hotel_id' AND type='Triple Room' AND status='available' AND nbrCH NOT IN (SELECT DISTINCT nbrCH FROM reservations WHERE hotel_id = '$current_hotel_id' AND (DatR <= '$date_check' AND DatS >= '$date_check'))";
                    $res_f3 = mysqli_query($conn, $sql_f3);
                    $row_f3 = $res_f3->fetch_assoc();
                    echo htmlspecialchars($row_f3["F3"]);
                    ?>
                    </p>
                    <a class="btn myBtnTrigger" style="cursor:pointer">Book Room</a>
                </div>
                <div class="prix">
                    <h5>Base Nightly Cost</h5>
                    <p style="color:blue">
                    <?php
                    $sql_p3 = "SELECT prix FROM chambres WHERE hotel_id = '$current_hotel_id' AND type='Triple Room' LIMIT 1";
                    $res_p3 = mysqli_query($conn, $sql_p3);
                    if($row_p3 = $res_p3->fetch_assoc()) { echo htmlspecialchars(round($row_p3["prix"])) . " DA"; }
                    ?>
                    </p>
                </div>
            </div>
        </div>

        <header id="myModal1" class="modal-view">
            <section class="reservation">
                <?php
                if(!empty($error)){
                    foreach($error as $msg){ echo '<span class="error-msg" style="color:red; display:block;">'.htmlspecialchars($msg).'</span>'; }
                }
                ?>
                <form action="" method="post">
                    <div class="res">
                        <div class="left">
                            <h2><span>Customer Information</span></h2>
                            Full Name
                            <input type="text" name="nom" required placeholder="Enter full name identity">
                            Email Address
                            <input type="email" name="email" required placeholder="Enter primary email index">
                            Phone Number
                            <input type="text" name="tel" required placeholder="Enter communication number">
                            Home Address
                            <input type="text" name="adrss" required placeholder="Enter permanent residence address">
                            <label>Room Category Option<br>
                                <select name="Tchambr" required>
                                    <option value="Single Room">Single Room</option>
                                    <option value="Double Room">Double Room</option>
                                    <option value="Triple Room">Triple Room</option>
                                </select>
                            </label>
                        </div>
                        <div class="right">
                            <h2><span>Settlement Gateway</span></h2>
                            Check-In Date
                            <input type="date" name="datres" id="start-date" required>
                            Check-Out Date
                            <input type="date" name="datsort" id="end-date" required>
                            <label>Card Specification Model</label><br>
                            <div class="res-payment-methods" style="display:flex; gap:10px; margin:5px 0;">
                                <label><input type="radio" name="Tcart" value="visacart" required/> Visa</label>
                                <label><input type="radio" name="Tcart" value="dahabia"/> Edahabia</label>
                                <label><input type="radio" name="Tcart" value="CIB"/> CIB</label>
                            </div>
                            Payment Card System Identifier Number
                            <input type="text" name="nbrPymt" required placeholder="Enter transaction card serial index">
                            <div class="box" style="margin-top:10px;">
                                <button type="button" onclick="calculateDays()">Check Duration</button>
                                <p id="result" style="display:inline-block; margin-left:10px Pap;"></p>
                            </div>
                        </div>
                    </div>
                    <input type="submit" name="submit1" id="myBtn2" value="Execute Secure Reservation"> 
                    <span class="close" style="cursor:pointer; margin-left:15px;">Dismiss Window</span>
                </form>  
            </section>
        </header>
    </section>

    <?php if ($show_receipt && $receipt_data): ?>
    <div class="cartRes" id="myModal2" style="max-width:600px; margin:20px auto; padding:20px; border:1px solid #ccc; background:#fff;">
        <h3>Reservation Ingestion Token Invoice</h3>
        <table style="width:100%; border-collapse: collapse;">
            <tr><th style="text-align:left; padding:6px; border-bottom:1px solid #eee;">Name:</th><td style="padding:6px; border-bottom:1px solid #eee;"><?php echo htmlspecialchars($receipt_data["NOM"]); ?></td></tr>
            <tr><th style="text-align:left; padding:6px; border-bottom:1px solid #eee;">Phone:</th><td style="padding:6px; border-bottom:1px solid #eee;"><?php echo htmlspecialchars($receipt_data["TEL"]); ?></td></tr>
            <tr><th style="text-align:left; padding:6px; border-bottom:1px solid #eee;">Assigned Room Code:</th><td style="padding:6px; border-bottom:1px solid #eee;"><?php echo htmlspecialchars($receipt_data["nbrCH"]); ?></td></tr>
            <tr><th style="text-align:left; padding:6px; border-bottom:1px solid #eee;">Classification Type:</th><td style="padding:6px; border-bottom:1px solid #eee;"><?php echo htmlspecialchars($receipt_data["Tchambr"]); ?></td></tr>
            <tr><th style="text-align:left; padding:6px; border-bottom:1px solid #eee;">Check-In Timeline:</th><td style="padding:6px; border-bottom:1px solid #eee;"><?php echo htmlspecialchars($receipt_data["DatR"]); ?></td></tr>
            <tr><th style="text-align:left; padding:6px; border-bottom:1px solid #eee;">Check-Out Timeline:</th><td style="padding:6px; border-bottom:1px solid #eee;"><?php echo htmlspecialchars($receipt_data["DatS"]); ?></td></tr>
            <tr><th style="text-align:left; padding:6px; border-bottom:1px solid #eee;">Nightly Rate Metric:</th><td style="padding:6px; border-bottom:1px solid #eee;"><?php echo htmlspecialchars(round($receipt_data["prix"])); ?> DA</td></tr>
            <tr><th style="text-align:left; padding:6px; border-bottom:1px solid #eee;">Computed Billable Units:</th><td style="padding:6px; border-bottom:1px solid #eee;"><?php echo htmlspecialchars($receipt_data["NBRjour"]); ?> Days</td></tr>
            <tr><th style="text-align:left; padding:6px; border-bottom:1px solid #eee;">Total System Processing Invoice:</th><td style="padding:6px; border-bottom:1px solid #eee;"><strong><?php echo htmlspecialchars(round($receipt_data["Ptotal"])); ?> DA</strong></td></tr>
        </table>
        <br>
        <a id="download-link" href="#" class="btn" style="text-decoration:none; text-align:center;" download="booking_info.pdf">Download Summary Profile Document</a>
    </div>
    <?php endif; ?>

    <section class="res">
        <form action="" method="post">
            <h5>Guest Feedback <span>& Reviews Loop</span></h5>
            <div class="left" style="margin-bottom:15px;">
                <input type="email" name="email" required placeholder="User registration login email">
                <input type="password" name="password" required placeholder="Account identity token tracking security code">
                <input type="submit" name="submit2" value="Submit Review Content File">
            </div>
            <div class="left" style="margin-bottom:15px;">
                <textarea rows="4" cols="50" name="com" required placeholder="Type your guest evaluation notes here..."></textarea>
            </div>
            <div class="right">
                <div style="width:100%; min-height:120px; background:#f4f4f5; padding:10px; border-radius:5px; border:1px solid #e4e4e7; font-family:monospace; white-space:pre-wrap; overflow-y:auto;">
<?php
// Unified JOIN query to pull reviews for this hotel and fetch names from users table
$sql_reviews = "SELECT users.name, commentaires.com 
                FROM commentaires 
                JOIN users ON commentaires.user_email = users.email 
                WHERE commentaires.hotel_id = '$current_hotel_id' 
                ORDER BY commentaires.id DESC";

$res_reviews = mysqli_query($conn, $sql_reviews);
if ($res_reviews && mysqli_num_rows($res_reviews) > 0) {
    while ($row_review = $res_reviews->fetch_assoc()) {
        echo htmlspecialchars($row_review["name"]) . " : " . htmlspecialchars($row_review["com"]) . "\n";
    }
} else {
    echo "No guest review metrics available context data tracks found.";
}
?>
                </div>
            </div>
        </form> 
    </section>

    <section class="skills">
        <div>
            <h5>Support Channels <span>At Your</span> Service</h5>
            <div class="tel">
                <div class="tel1"><img src="/icons/tel2.png" alt="Telephone Support Asset"><h5>06.76.04.76.23</h5></div>
                <div class="tel1"><img src="/icons/gmail.png" alt="Mail Matrix Inbound Desk"><h5>Fondouki.com</h5></div>
                <div class="tel1"><img src="/icons/instag.png" alt="Instagram Platform Handle Link"><h5>@fondouki_reserve</h5></div>
                <div class="tel1"><img src="/icons/facbook.png" alt="Facebook Meta Interaction Page Profile"><h5>facebook.com/fondouki</h5></div>
            </div>
        </div>
    </section>

    <footer>
        <div class="content-footer">
            <p>For any inquiries, please contact us through our verified platform channels listed above.</p> 
            <p>Copyright © Fondoki 2026 <img src="/icons/copyright_16px.png" alt="Copyright Ledger Verification Vector Signet"> All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        document.querySelectorAll('.myBtnTrigger').forEach(button => {
            button.addEventListener('click', () => {
                const modal = document.getElementById('myModal1');
                if(modal) modal.style.display = 'block';
            });
        });
        const closeBtn = document.querySelector('.close');
        if(closeBtn) {
            closeBtn.addEventListener('click', () => {
                document.getElementById('myModal1').style.display = 'none';
            });
        }
    </script>
    <script src="/JS/script.js"></script>
    <script src="/JS/date.js"></script>
    <script src="/JS/res.js"></script>
</body>
</html>
<?php
if (isset($conn)) mysqli_close($conn);
?>