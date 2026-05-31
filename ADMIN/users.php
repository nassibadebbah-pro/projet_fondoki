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
    <meta name="keywords" content="hotel, accommodation, dashboard, management, users, clients">
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="icon" href="/icons/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet"/>
   
    <title>User List</title>
</head>
<body dir="ltr">
   
    <section class="table">
        <h3>User List</h3>
        <table>
            <tr>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Email Address</th>
            </tr>
            <?php
            $sql = "SELECT * FROM user";
            $result = mysqli_query($conn, $sql);
            
            if ($result) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                        <td>' . htmlspecialchars($row['IDuser']) . '</td>
                        <td>' . htmlspecialchars($row['NOMuser']) . '</td>
                        <td>' . htmlspecialchars($row['EMAILuser']) . '</td>
                    </tr>';
                }
            }
            ?>
        </table>
    </section>
</body>
</html>