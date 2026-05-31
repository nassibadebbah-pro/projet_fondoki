<?php
// Initialize database connection once at the top
$conn = mysqli_connect('localhost', 'root', '', 'fondouki_system');
if (!$conn) {
    die("<div style='color:red; text-align:center; padding:20px;'>Critical System Error: Database connection failure.</div>");
}

$message = "";

// 1. SAVE ACTION 
if (isset($_POST['submit1'])) {
    $nbrCH = $_POST['nbrCH'];
    $Tchambr = $_POST['Tchambr'];
    $prix = $_POST['prix'];

    // Check if room number already exists to prevent duplicates
    $check_stmt = $conn->prepare("SELECT nbrCH FROM chambre WHERE nbrCH = ?");
    $check_stmt->bind_param("i", $nbrCH);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $message = "Error: Room number already exists. Use 'Update' to modify it.";
    } else {
        $stmt = $conn->prepare("INSERT INTO chambre (nbrCH, type, prix) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $nbrCH, $Tchambr, $prix);
        if ($stmt->execute()) {
            header('Location: list_ch.php');
            exit();
        } else {
            $message = "Error saving room details.";
        }
        $stmt->close();
    }
    $check_stmt->close();
}

// 2. UPDATE ACTION 
if (isset($_POST['submit2'])) {
    $nbrCH = $_POST['nbrCH'];
    $Tchambr = $_POST['Tchambr'];
    $prix = $_POST['prix'];

    $stmt = $conn->prepare("UPDATE chambre SET type = ?, prix = ? WHERE nbrCH = ?");
    $stmt->bind_param("ssi", $Tchambr, $prix, $nbrCH);
    if ($stmt->execute()) {
        header('Location: list_ch.php');
        exit();
    } else {
        $message = "Error updating room details.";
    }
    $stmt->close();
}

// 3. DELETE ACTION 
if (isset($_POST['submit3'])) {
    $nbrCH = $_POST['nbrCH'];

    if (empty($nbrCH)) {
        $message = "Please provide a valid Room Number to delete.";
    } else {
        $stmt = $conn->prepare("DELETE FROM chambre WHERE nbrCH = ?");
        $stmt->bind_param("i", $nbrCH);
        if ($stmt->execute()) {
            header('Location: list_ch.php');
            exit();
        } else {
            $message = "Error deleting room.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hotel room configuration ledger database asset control panel.">
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="icon" href="/icons/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet"/>
   
    <title>Rooms Management Inventory</title>
</head>
<body dir="ltr"> <div style="max-width: 1200px; margin: 40px auto; padding: 20px; font-family: sans-serif;">
    <h2 style="text-align: center; margin-bottom: 30px;">Rooms Inventory Control Panel</h2>

    <?php if(!empty($message)): ?>
        <div style="background-color: #fee2e2; color: #ef4444; padding: 12px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #fca5a5; text-align: center;">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <section class="form-container" style="display: flex; gap: 40px; flex-wrap: wrap;">

        <div class="left" style="flex: 1; min-width: 300px; background: #fff; padding: 25px; border: 1px solid #e4e4e7; border-radius: 8px;">
            <form method="post" style="display: flex; flex-direction: column; gap: 15px;">
                <span id="date" style="font-weight: bold; color: #71717a; text-align: right;"></span>
                
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Room Number</label>
                    <input type="number" name="nbrCH" required placeholder="e.g. 101" style="width: 100%; padding: 10px; border: 1px solid #e4e4e7; border-radius: 4px; box-sizing: border-box;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Room Type</label>
                    <select name="Tchambr" required style="width: 100%; padding: 10px; border: 1px solid #e4e4e7; border-radius: 4px; box-sizing: border-box; background-color: #fff;">
                        <option value="Single">Single Room</option>
                        <option value="Double">Double Room</option>
                        <option value="Triple">Triple Room</option>
                    </select>
                </div>
            
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500;">Nightly Rate (DA)</label>
                    <input type="text" name="prix" required placeholder="e.g. 4500" style="width: 100%; padding: 10px; border: 1px solid #e4e4e7; border-radius: 4px; box-sizing: border-box;">
                </div>
               
                <div style="display: flex; gap: 10px; margin-top: 15px;">
                    <input type="submit" name="submit1" value="Save" class="btn" style="flex: 1; padding: 12px; background-color: #22c55e; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
                    <input type="submit" name="submit2" value="Update" class="btn" style="flex: 1; padding: 12px; background-color: #3b82f6; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
                    <input type="submit" name="submit3" value="Delete" class="btn" style="flex: 1; padding: 12px; background-color: #ef4444; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;" onclick="return confirm('Are you sure you want to delete this room?');">
                </div>
            </form>
        </div>

        <div class="right" style="flex: 1.5; min-width: 400px; background: #fff; padding: 25px; border: 1px solid #e4e4e7; border-radius: 8px;"> 
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f4f4f5; border-bottom: 2px solid #e4e4e7;">
                        <th style="padding: 12px; text-align: left;">Room Number</th>
                        <th style="padding: 12px; text-align: left;">Room Type</th>
                        <th style="padding: 12px; text-align: left;">Price Per Night</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM chambre ORDER BY nbrCH ASC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                            echo '<tr style="border-bottom: 1px solid #f4f4f5;">
                                <td style="padding: 12px; font-weight: 600;">'.htmlspecialchars($row['nbrCH']).'</td>
                                <td style="padding: 12px;">'.htmlspecialchars($row['type']).'</td>
                                <td style="padding: 12px; color: #2563eb; font-weight: 600;">'.htmlspecialchars($row['prix']).' DA</td>
                            </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="3" style="text-align: center; padding: 20px; color: #a1a1aa;">No rooms configured in the inventory tracking database registry yet.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<script src="/JS/date.js"></script>
</body>
</html>
<?php 
mysqli_close($conn); 
?>