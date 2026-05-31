<?php 
$conn = mysqli_connect('localhost', 'root', '', 'hotel_kerdada');
if(!$conn){
    die("Database connection failed contextual error.");
}

$message = "";

if(isset($_POST['submit'])){
   $nom = mysqli_real_escape_string($conn, $_POST['nom']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $tel = mysqli_real_escape_string($conn, $_POST['tel']);
   $adrss = mysqli_real_escape_string($conn, $_POST['adrss']);
   $datres = mysqli_real_escape_string($conn, $_POST['datres']);
   $datsort = mysqli_real_escape_string($conn, $_POST['datsort']);
   $tcart = isset($_POST['Tcart']) ? mysqli_real_escape_string($conn, $_POST['Tcart']) : '';
   $nbrpymt = mysqli_real_escape_string($conn, $_POST['nbrPymt']);
   $Tchambr = mysqli_real_escape_string($conn, $_POST['Tchambr']);
   
   $date = date("Y-m-d");

   // Fixed structural column references to match the registration schema variants
   $sql = "SELECT nbrCH, prix FROM chambre WHERE type='$Tchambr' AND nbrCH NOT IN (SELECT DISTINCT nbrCH FROM reservations WHERE (DatR <= '$datsort' AND DatS >= '$datres')) LIMIT 1";
   $result = $conn->query($sql);

   if($result && $result->num_rows > 0){
        $row = $result->fetch_assoc();
        $nbrCH = $row['nbrCH'];
        $prix = $row['prix'];
        
        $time_diff = strtotime($datsort) - strtotime($datres);
        $NBRjour = max(1, round($time_diff / (60 * 60 * 24)));
        $Ptotal = $NBRjour * $prix;
        
        $insertSql = "INSERT INTO reservations (NOM, nbrCH, Email, TEL, ADRS, DatR, DatS, NBRjour, Tcart, Ncart, Tchambr, RES, prix, Ptotal, date) 
                      VALUES ('$nom', '$nbrCH', '$email', '$tel', '$adrss', '$datres', '$datsort', '$NBRjour', '$tcart', '$nbrpymt', '$Tchambr', 'OUI', '$prix', '$Ptotal', '$date')";
      
        if ($conn->query($insertSql) === TRUE) {
            $message = "<div class='success-msg'>Reservation successfully recorded configuration!</div>";
        } else {
            $message = "<div class='error-msg'>System database insertion failure: " . $conn->error . "</div>";
        }
   } else {
        $message = "<div class='error-msg'>No rooms available matching this type within the chosen allocation timelines.</div>";
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="best free online courses ...">
    <meta name="keywords" content="hotel, room, reservation, checkin, dashboard">
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="icon" href="/icons/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet"/>
    <title>Room Booking</title>
</head>
<body dir="ltr">   
<header>
    <section class="reservation">
        <?php echo $message; ?>
        
        <form action="" method="post">
            <div class="res">
                <div class="left">
                    <h2><span>Customer Details</span></h2>
               
                    Full Name
                    <input type="text" name="nom" required placeholder="Enter your full name">
                    Email Address
                    <input type="email" name="email" required placeholder="Enter email address">
                    Phone Number
                    <input type="text" name="tel" required placeholder="Enter phone identity link">
                    Home Address
                    <input type="text" name="adrss" required placeholder="Enter permanent address">
                    
                    <label>Room Type<br>
                        <select name="Tchambr" required>
                            <option value="غرفة فردية">Single Room</option>
                            <option value="غرفة ثنائية">Double Room</option>
                            <option value="غرفة ثلاثية">Triple Room</option>
                        </select>
                    </label>
                </div>

                <div class="right">
                    <h2><span>Settlement Details</span></h2>
                    
                    Check-in Date
                    <input type="date" name="datres" id="start-date" required>
                    Check-out Date
                    <input type="date" name="datsort" id="end-date" required>
                    
                    <label>Card Classification Type</label><br>
                    <div class="res-options" style="display:flex; gap:10px; margin: 5px 0;">
                        <label><input type="radio" name="Tcart" value="visacart" required/> Visa Card</label>
                        <label><input type="radio" name="Tcart" value="dahabia"/> Edahabia Card</label>
                        <label><input type="radio" name="Tcart" value="CIB"/> CIB Card</label>
                    </div>
                    
                    Card Number
                    <input type="text" name="nbrPymt" required placeholder="Enter your bank card number">
                    
                    <div class="box" style="margin-top: 15px;">
                        <button type="button" onclick="calculateDays()">Calculate Period</button>
                        <p id="result" style="display:inline-block; margin-left:10px;"></p>
                        <span id="date"></span> 
                    </div>
                </div>
            </div>
            <input type="submit" name="submit" value="Book Room Now"> 
        </form>  

        <div class="cartRes" style="margin-top: 30px;">
            <div class="confirmation-form">
                <h3>Reservation Confirmation Form</h3>
                <?php
                // Fetch the latest updated record row tracking instantiation context
                $sql_receipt = "SELECT * FROM reservations ORDER BY id DESC LIMIT 1";
                $result_receipt = mysqli_query($conn, $sql_receipt);
                if ($result_receipt && $row = mysqli_fetch_assoc($result_receipt)) {
                    echo '<table class="receipt-table" style="width:100%; border-collapse: collapse; margin-bottom: 15px;">
                        <tr><th style="text-align:left; padding:8px;">Name:</th><td style="padding:8px;">'.htmlspecialchars($row["NOM"]).'</td></tr>
                        <tr><th style="text-align:left; padding:8px;">Phone:</th><td style="padding:8px;">'.htmlspecialchars($row["TEL"]).'</td></tr>
                        <tr><th style="text-align:left; padding:8px;">Room Allocation ID:</th><td style="padding:8px;">'.htmlspecialchars($row["nbrCH"]).'</td></tr>
                        <tr><th style="text-align:left; padding:8px;">Room Classification:</th><td style="padding:8px;">'.htmlspecialchars($row["Tchambr"]).'</td></tr>
                        <tr><th style="text-align:left; padding:8px;">Check-In Date:</th><td style="padding:8px;">'.htmlspecialchars($row["DatR"]).'</td></tr>
                        <tr><th style="text-align:left; padding:8px;">Check-Out Date:</th><td style="padding:8px;">'.htmlspecialchars($row["DatS"]).'</td></tr>
                        <tr><th style="text-align:left; padding:8px;">Base Rate:</th><td style="padding:8px;">'.htmlspecialchars($row["prix"]).' DA</td></tr>
                        <tr><th style="text-align:left; padding:8px;">Total Calculated Days:</th><td style="padding:8px;">'.htmlspecialchars($row["NBRjour"]).'</td></tr>
                        <tr><th style="text-align:left; padding:8px;">Total Net Cost Matrix:</th><td style="padding:8px;"><strong>'.htmlspecialchars($row["Ptotal"]).' DA</strong></td></tr>
                    </table>';
                } else {
                    echo '<p>No matching active transaction data index detected records.</p>';
                }
                ?>
                <a id="download-link" href="#" class="btn-download">Save Summary Profile Document</a>
            </div>
        </div>
    </section>
</header>

<script src="/JS/date.js"></script>
</body>
</html>
<?php 
$conn->close(); 
?>