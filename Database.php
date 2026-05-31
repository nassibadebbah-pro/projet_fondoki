<?php
// Database.php - Dedicated database gateway module

function getDbConnections() {
    $conn1 = mysqli_connect('localhost', 'root', '', 'fondouki_system');
    $conn2 = mysqli_connect('localhost', 'root', '', 'hotel_kerdada');
    
    if (!$conn1 || !$conn2) {
        die("Database network routing connectivity failure.");
    }
    return [$conn1, $conn2];
}

// دالة لحساب عدد الغرف المتاحة بناءً على النوع
function getAvailableRoomsCount($roomType) {
    list($conn1, $conn2) = getDbConnections();
    $date_check = date("Y-m-d");
    
    $sql = "SELECT COUNT(*) AS total FROM chambre 
            WHERE type=? AND nbrCH NOT IN (
                SELECT DISTINCT nbrCH FROM reservations 
                WHERE (DatR <= ? AND DatS >= ?)
            )";
            
    $stmt = mysqli_prepare($conn2, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $roomType, $date_check, $date_check);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    
    mysqli_close($conn1);
    mysqli_close($conn2);
    return $row['total'] ?? 0;
}

// دالة لجلب سعر الغرفة
function getRoomPrice($roomType) {
    list($conn1, $conn2) = getDbConnections();
    $sql = "SELECT prix FROM chambre WHERE type=? LIMIT 1";
    
    $stmt = mysqli_prepare($conn2, $sql);
    mysqli_stmt_bind_param($stmt, "s", $roomType);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    
    mysqli_close($conn1);
    mysqli_close($conn2);
    return $row['prix'] ?? 0;
}

// دالة لمعالجة الحجوزات الجديدة
function handleRoomBooking($postData) {
    list($conn1, $conn2) = getDbConnections();
    
    $nom = mysqli_real_escape_string($conn2, $postData['nom']);
    $email = mysqli_real_escape_string($conn2, $postData['email']);
    $tel = mysqli_real_escape_string($conn2, $postData['tel']);
    $adrss = mysqli_real_escape_string($conn2, $postData['adrss']);
    $datres = mysqli_real_escape_string($conn2, $postData['datres']);
    $datsort = mysqli_real_escape_string($conn2, $postData['datsort']);
    $tcart = isset($postData['Tcart']) ? mysqli_real_escape_string($conn2, $postData['Tcart']) : '';
    $nbrpymt = mysqli_real_escape_string($conn2, $postData['nbrPymt']);
    $Tchambr = mysqli_real_escape_string($conn2, $postData['Tchambr']);
    $date_today = date("Y-m-d");

    $sql = "SELECT nbrCH, prix FROM chambre WHERE type='$Tchambr' AND nbrCH NOT IN (SELECT DISTINCT nbrCH FROM reservations WHERE (DatR <= '$datsort' AND DatS >= '$datres')) LIMIT 1";
    $result = mysqli_query($conn2, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nbrCH = $row['nbrCH'];
        $prix = $row['prix'];
        
        $time_diff = strtotime($datsort) - strtotime($datres);
        $NBRjour = max(1, round($time_diff / (60 * 60 * 24)));
        $Ptotal = $NBRjour * $prix;

        $insertSql = "INSERT INTO reservations (NOM, nbrCH, Email, TEL, ADRS, DatR, DatS, NBRjour, Tcart, Ncart, Tchambr, RES, prix, Ptotal, date) 
                      VALUES ('$nom', '$nbrCH', '$email', '$tel', '$adrss', '$datres', '$datsort', '$NBRjour', '$tcart', '$nbrpymt', '$Tchambr', 'YES', '$prix', '$Ptotal', '$date_today')";

        if (mysqli_query($conn2, $insertSql)) {
            mysqli_close($conn1); mysqli_close($conn2);
            return ["success" => true, "data" => ["NOM" => $nom, "TEL" => $tel, "nbrCH" => $nbrCH, "Tchambr" => $Tchambr, "DatR" => $datres, "DatS" => $datsort, "prix" => $prix, "NBRjour" => $NBRjour, "Ptotal" => $Ptotal]];
        }
    }
    mysqli_close($conn1); mysqli_close($conn2);
    return ["success" => false, "error" => "No available units match the specified timeline infrastructure."];
}

// دالة لإضافة تعليق جديد
function submitGuestReview($email, $password, $comment) {
    list($conn1, $conn2) = getDbConnections();
    
    $email = mysqli_real_escape_string($conn1, $email);
    $pass = mysqli_real_escape_string($conn1, $password);
    $com = mysqli_real_escape_string($conn2, $comment);
    
    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$pass'";
    $res = mysqli_query($conn1, $sql);
    
    if ($res && mysqli_num_rows($res) > 0) {
        $insert = "INSERT INTO commentaire (email, password, com) VALUES ('$email', '$pass', '$com')";
        mysqli_query($conn2, $insert);
        mysqli_close($conn1); mysqli_close($conn2);
        return ["success" => true, "message" => "Your review has been successfully submitted!"];
    }
    mysqli_close($conn1); mysqli_close($conn2);
    return ["success" => false, "message" => "Authentication failure: Unregistered client token."];
}

// دالة لجلب كافة التعليقات المخزنة بنظام الدمج
// دالة لجلب كافة التعليقات المخزنة بنظام الدمج
function getAllGuestReviews() {
    list($conn1, $conn2) = getDbConnections();
    
    // استخدام الأسماء المستعارة u و c لحل مشكلة التعرف على الأعمدة عبر القواعد المختلفة
    $sql = "SELECT u.name, c.com 
            FROM hotel_kerdada.commentaire c
            JOIN fondouki.user u ON c.email = u.email 
            ORDER BY c.id DESC";
            
    $res = mysqli_query($conn2, $sql);
    $reviews = [];
    if ($res && mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $reviews[] = $row;
        }
    }
    mysqli_close($conn1); mysqli_close($conn2);
    return $reviews;
}
?>