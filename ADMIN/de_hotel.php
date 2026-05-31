<?php
$conn = mysqli_connect('localhost', 'root', '', 'fondouki');
$count = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="best free online courses ...">
    <meta name="keywords" content="hotel, accommodation, dashboard, management, requests">
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="icon" href="/icons/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet"/>
   
    <title>Hotel Subscription Requests</title>
</head>
<body dir="ltr">
   
    <section class="table">
        <h3>Hotel Subscription Requests</h3>
        <table>
            <tr>
                <th>Hotel Type</th>
                <th>State / Province</th>
                <th>Municipality</th>
                <th>Hotel Name</th>
                <th>Owner Name</th>
                <th>Address</th>
                <th>Star Rating</th>
                <th>Postal Account / Email</th>
                <th>Primary Phone</th>
                <th>Secondary Phone</th>
                <th>Number of Rooms</th>
                <th>Proof of Ownership</th>
            </tr>
            <?php
            $sql = "SELECT * FROM demand_hotel";
            $result = mysqli_query($conn, $sql);
            
            if ($result) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                        <td>' . htmlspecialchars($row['Type']) . '</td>
                        <td>' . htmlspecialchars($row['Wilaya']) . '</td>
                        <td>' . htmlspecialchars($row['commun']) . '</td>
                        <td>' . htmlspecialchars($row['nomHot']) . '</td>
                        <td>' . htmlspecialchars($row['nomDir']) . '</td>
                        <td>' . htmlspecialchars($row['Adress']) . '</td>
                        <td>' . htmlspecialchars($row['nbrEtl']) . '</td>
                        <td>' . htmlspecialchars($row['email']) . '</td>
                        <td>' . htmlspecialchars($row['tel1']) . '</td>
                        <td>' . htmlspecialchars($row['tel2']) . '</td>
                        <td>' . htmlspecialchars($row['nbrChem']) . '</td>
                        <td><a href="data:application/pdf;base64,' . base64_encode($row['Cert']) . '" target="_blank" class="btn-view">View File</a></td>
                    </tr>';
                }
            }
            ?>
        </table>
    </section>
</body>
</html>