<?php
// Initialize database connection once at the top
$conn = mysqli_connect('localhost', 'root', '', 'fondouki_system');
if (!$conn) {
    die("<div style='color:red; text-align:center; padding:20px;'>Critical System Error: Database connection failure.</div>");
}

$message = "";
$message_type = "";

if (isset($_POST['submit'])) {
    $date_today = date("Y-m-d");
    
    $nom = mysqli_real_escape_string($conn, $_POST['Nclient']);
    $tel = mysqli_real_escape_string($conn, $_POST['TEL']);
    $datres = mysqli_real_escape_string($conn, $_POST['datR']);
    $datsort = mysqli_real_escape_string($conn, $_POST['datS']);
    
    $Njour = intval($_POST['Njour']);
    $prix = floatval($_POST['prix']);
    $Tchambr = 'Single Room'; // Pure English Database Value

    // Query to find an available room of type 'Single Room' with strict overlap verification
    $sql = "SELECT nbrCH FROM chambre WHERE type='Single Room' AND nbrCH NOT IN (
                SELECT DISTINCT nbrCH FROM reservations WHERE (datR < ? AND datS > ?)
            ) LIMIT 1";
            
    $stmt = $conn->prepare($sql);
    // Bind Check-Out date first, then Check-In date to match parameters logic
    $stmt->bind_param("ss", $datsort, $datres);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nbrCH = $row['nbrCH'];

        // Secure insertion using fully prepared statement matrix
        $insert = "INSERT INTO reservations (nbrCH, NOM, TEL, datR, datS, NBRjour, date, Ptotal, Tchambr) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                   
        $ins_stmt = $conn->prepare($insert);
        $ins_stmt->bind_param("issssisds", $nbrCH, $nom, $tel, $datres, $datsort, $Njour, $date_today, $prix, $Tchambr);
        
        if ($ins_stmt->execute()) {
            // Safe redirect upon successful injection verification
            header('Location: pagFondoki.php?success=1');
            exit();
        } else {
            $message = "Database Error: Failed to commit registration records. " . $conn->error;
            $message_type = "error";
        }
        $ins_stmt->close();
    } else {
        $message = "Inventory Error: No unbooked single occupancy spaces match selected timelines.";
        $message_type = "error";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Single occupancy booking configuration engine management deck.">
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="icon" href="/icons/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet"/>
   
    <title>Single Occupancy Accommodations Control Panel</title>
</head>
<body dir="ltr">

<div style="max-width: 1200px; margin: 30px auto; padding: 20px; font-family: sans-serif;">
    <span id="date" name="date" style="font-weight: bold; color:#71717a; float: right;"></span>
    <div style="clear: both;"></div>

    <?php if(!empty($message)): ?>
        <div style="background-color: #fee2e2; color: #ef4444; padding: 12px; border-radius: 6px; margin: 20px 0; border: 1px solid #fca5a5; text-align: center;">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>
              
    <section class="table-container">
        
        <h2 style="margin-top: 20px; color:#18181b;">Create New Single Room Reservation</h2>
        <form method="post" style="background: #fff; padding: 20px; border: 1px solid #e4e4e7; border-radius: 8px; margin-bottom: 40px;">
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
                <thead>
                    <tr style="background-color: #f4f4f5; border-bottom: 1px solid #e4e4e7;">
                        <th style="padding: 10px; text-align: left;">Customer Full Name</th>
                        <th style="padding: 10px; text-align: left;">Phone Number</th>
                        <th style="padding: 10px; text-align: left;">Check-In Date</th>
                        <th style="padding: 10px; text-align: left;">Check-Out Date</th>
                        <th style="padding: 10px; text-align: left;">Total Days</th>
                        <th style="padding: 10px; text-align: left;">Gross Price (DA)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 10px;"><input type="text" name="Nclient" required placeholder="Guest Identity Name" style="width:90%; padding: 6px;"></td>
                        <td style="padding: 10px;"><input type="text" name="TEL" required placeholder="Contact Number" style="width:90%; padding: 6px;"></td>
                        <td style="padding: 10px;"><input type="date" name="datR" required style="width:90%; padding: 6px;"></td>
                        <td style="padding: 10px;"><input type="date" name="datS" required style="width:90%; padding: 6px;"></td>
                        <td style="padding: 10px;"><input type="number" name="Njour" required placeholder="0" style="width:90%; padding: 6px;"></td>
                        <td style="padding: 10px;"><input type="number" name="prix" required placeholder="0.00" style="width:90%; padding: 6px;"></td>
                    </tr>
                </tbody>
            </table>
            <div style="display: flex; gap: 10px; justify-content: flex-end;">
                <input type="submit" name="submit" value="Save Reservation" class="btn" style="padding: 10px 20px; background-color: #22c55e; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
                <input type="reset" value="Clear Form" class="btn" style="padding: 10px 20px; background-color: #71717a; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
            </div>
        </form>

        <h2 style="color:#18181b;">Currently Reserved Single Rooms</h2>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 40px; background: #fff; border: 1px solid #e4e4e7;">
            <thead>
                <tr style="background-color: #f4f4f5; border-bottom: 2px solid #e4e4e7;">
                    <th style="padding: 12px; text-align: left;">Room No.</th>
                    <th style="padding: 12px; text-align: left;">Classification</th>
                    <th style="padding: 12px; text-align: left;">Customer Name</th>
                    <th style="padding: 12px; text-align: left;">Check-In</th>
                    <th style="padding: 12px; text-align: left;">Check-Out</th>
                    <th style="padding: 12px; text-align: left;">Stay Duration</th>
                    <th style="padding: 12px; text-align: left;">Total Paid</th>
                    <th style="padding: 12px; text-align: left;">Days Remaining</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $date_today = date("Y-m-d");
                // Strictly searches for English database tracking criteria token 'Single Room'
                $sql_reserved = "SELECT * FROM reservations WHERE Tchambr='Single Room' AND datS >= ? ORDER BY datR ASC";
                $stmt_res = $conn->prepare($sql_reserved);
                $stmt_res->bind_param("s", $date_today);
                $stmt_res->execute();
                $res_bookings = $stmt_res->get_result();
                
                if($res_bookings->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($res_bookings)){
                        $datsort = $row['datS'];
                        $difference = round((strtotime($datsort) - strtotime($date_today)) / (60 * 60 * 24));
                        
                        echo '<tr style="border-bottom: 1px solid #f4f4f5;">
                                <td style="padding: 12px; font-weight: bold;">'.htmlspecialchars($row['nbrCH']).'</td>
                                <td style="padding: 12px;">Single Room</td>
                                <td style="padding: 12px;">'.htmlspecialchars($row['NOM']).'</td>
                                <td style="padding: 12px;">'.htmlspecialchars($row['datR']).'</td>
                                <td style="padding: 12px;">'.htmlspecialchars($row['datS']).'</td>
                                <td style="padding: 12px;">'.htmlspecialchars($row['NBRjour']).' Days</td>
                                <td style="padding: 12px; color: #16a34a; font-weight:600;">'.htmlspecialchars($row['Ptotal']).' DA</td>';
                        
                        if($difference <= 0){
                            echo "<td style='background-color: #f4f4f5; color: #71717a; padding: 12px;'>Checking out today</td>";
                        } elseif($difference == 1){
                            echo "<td style='background-color: #fee2e2; color: #ef4444; font-weight: bold; padding: 12px;'>1 Day left</td>";
                        } else {
                            echo '<td style="padding: 12px; color: #2563eb;">'.$difference.' Days left</td>';
                        }
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="8" style="text-align: center; padding: 20px; color:#a1a1aa;">No active single room reservations recorded on today\'s schedule ledger.</td></tr>';
                }
                $stmt_res->close();
                ?>
            </tbody>
        </table>

        <h2 style="color:#18181b;">Available Single Rooms Inventory</h2>
        <table style="width: 100%; border-collapse: collapse; background: #fff; border: 1px solid #e4e4e7;">
            <thead>
                <tr style="background-color: #f4f4f5; border-bottom: 2px solid #e4e4e7;">
                    <th style="padding: 12px; text-align: left;">Room Number</th>
                    <th style="padding: 12px; text-align: left;">Room Type Classification</th>
                    <th style="padding: 12px; text-align: left;">Standard Price Rate</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_available = "SELECT * FROM chambre WHERE type='Single Room' AND nbrCH NOT IN (
                                    SELECT DISTINCT nbrCH FROM reservations WHERE (datR < ? AND datS > ?)
                                  ) ORDER BY nbrCH ASC";
                
                $stmt_avail = $conn->prepare($sql_available);
                $stmt_avail->bind_param("ss", $date_today, $date_today);
                $stmt_avail->execute();
                $res_avail = $stmt_avail->get_result();
                
                if($res_avail->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($res_avail)){
                        echo '<tr style="border-bottom: 1px solid #f4f4f5;">
                                <td style="padding: 12px; font-weight: bold;">'.htmlspecialchars($row['nbrCH']).'</td>
                                <td style="padding: 12px;">Single Room</td>
                                <td style="padding: 12px; color: #2563eb; font-weight: 600;">'.htmlspecialchars($row['prix']).' DA</td>
                              </tr>';
                    }
                } else {
                    echo '<tr><td colspan="3" style="text-align: center; padding: 20px; color:#a1a1aa;">100% Occupancy reached. No single room spaces currently vacant.</td></tr>';
                }
                $stmt_avail->close();
                ?>
            </tbody>
        </table>
    </section>
</div>
 
<script src="/JS/date.js"></script>
</body>
</html>
<?php 
mysqli_close($conn); 
?>