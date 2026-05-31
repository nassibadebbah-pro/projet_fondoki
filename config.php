<?php
// 1. Connection with lowercase matched database name
$conn = mysqli_connect('localhost', 'root', '', 'FONDOUKI');

if(!$conn){
    die("<div style='color:red; font-family:sans-serif;'>There was a problem connecting to the database: " . mysqli_connect_error() . "</div>");
}

// Check if the form was actually submitted to prevent empty errors
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'], $_POST['email'], $_POST['com'])) {
    
    // 2. Sanitize and Secure Inputs
    $nom   = mysqli_real_escape_string($conn, $_POST['nom']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $com   = mysqli_real_escape_string($conn, $_POST['com']);

    // 3. Secure SQL query using Prepared Statements
    $stmt = mysqli_prepare($conn, "INSERT INTO commentaire (email, NOM, com) VALUES (?, ?, ?)");
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $email, $nom, $com);
        
        if (mysqli_stmt_execute($stmt)) {
            // Success: redirect or echo success message
            echo "<script>alert('Comment added successfully!'); window.location.href='index.html';</script>";
        } else {
            echo "Error executing query: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Table Structur Error: Please verify table 'commentaire' has columns (email, NOM, com). Details: " . mysqli_error($conn);
    }
}

// Keep connection open only if needed by down-page inclusions, otherwise it closes gracefully at script end.
?>