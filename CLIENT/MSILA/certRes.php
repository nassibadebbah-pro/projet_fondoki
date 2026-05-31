<?php
$conn = mysqli_connect('localhost', 'root', '', 'fondouki_system');
if (!$conn) {
    die("Database connection failed.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/style.css"/>
    <link rel="icon" href="/icons/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet"/>
    <title>Reservation Confirmation</title>
</head>
<body dir="ltr">
    <div class="cartRes" style="max-width: 600px; margin: 40px auto; padding: 20px; background: #fff; border: 1px solid #e4e4e7; border-radius: 8px;">
        <form action="" method="post">
            <h3 style="text-align: center; margin-bottom: 20px;">Reservation Confirmation Form</h3>
            
            <div id="receipt-content">
                <?php
                // Fetch the absolute latest dynamic entry in the collection
                $sql = "SELECT * FROM reservations ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($conn, $sql);
                
                if ($result && $row = $result->fetch_assoc()) {
                    echo '<table style="width:100%; border-collapse: collapse; font-family: sans-serif;">
                    <tr style="border-bottom: 1px solid #f4f4f5;"><th style="text-align:left; padding:10px; width:40%;">Full Name:</th><td style="padding:10px;">'.htmlspecialchars($row["NOM"]).'</td></tr>
                    <tr style="border-bottom: 1px solid #f4f4f5;"><th style="text-align:left; padding:10px;">Phone Number:</th><td style="padding:10px;">'.htmlspecialchars($row["TEL"]).'</td></tr>
                    <tr style="border-bottom: 1px solid #f4f4f5;"><th style="text-align:left; padding:10px;">Room Number:</th><td style="padding:10px;">'.htmlspecialchars($row["nbrCH"]).'</td></tr>
                    <tr style="border-bottom: 1px solid #f4f4f5;"><th style="text-align:left; padding:10px;">Room Type:</th><td style="padding:10px;">'.htmlspecialchars($row["Tchambr"]).'</td></tr>
                    <tr style="border-bottom: 1px solid #f4f4f5;"><th style="text-align:left; padding:10px;">Check-In Date:</th><td style="padding:10px;">'.htmlspecialchars($row["DatR"]).'</td></tr>
                    <tr style="border-bottom: 1px solid #f4f4f5;"><th style="text-align:left; padding:10px;">Check-Out Date:</th><td style="padding:10px;">'.htmlspecialchars($row["DatS"]).'</td></tr>
                    <tr style="border-bottom: 1px solid #f4f4f5;"><th style="text-align:left; padding:10px;">Base Room Rate:</th><td style="padding:10px;">'.htmlspecialchars($row["prix"]).' DA</td></tr>
                    <tr style="border-bottom: 1px solid #f4f4f5;"><th style="text-align:left; padding:10px;">Total Stay Duration:</th><td style="padding:10px;">'.htmlspecialchars($row["NBRjour"]).' Days</td></tr>
                    <tr style="border-bottom: 2px solid #e4e4e7;"><th style="text-align:left; padding:10px; color:#18181b;">Total Gross Price:</th><td style="padding:10px; font-weight:bold; color:#2563eb;">'.htmlspecialchars($row["Ptotal"]).' DA</td></tr>
                    </table>';
                } else {
                    echo '<p style="text-align:center; color:#71717a; padding:20px;">No current reservation tracking information was found in the infrastructure registry log.</p>';
                }
                ?>
            </div>
            
            <div style="margin-top: 25px; text-align: center;">
                <a id="download-link" href="#" class="btn" style="display: inline-block; padding: 10px 20px; background-color: #2563eb; color: #fff; text-decoration: none; border-radius: 4px; font-weight: 500;">Save Summary Document</a>
            </div>
        </form>
    </div>

    <!-- Client-Side Script Injection Modules -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="/JS/date.js"></script>
    
    <script>
        document.getElementById('download-link').addEventListener('click', function(e) {
            e.preventDefault();
            
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({
                orientation: 'p',
                unit: 'pt',
                format: 'a4'
            });
            
            const element = document.getElementById('receipt-content');
            
            // Clean dynamic structural check fallback validation before execution
            if(!element || element.innerText.trim().includes("No current reservation")) {
                alert("No structural context available to print.");
                return;
            }
            
            // Generate clean raster vector using html2canvas logic for high-fidelity export
            html2canvas(element, { scale: 2 }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 500;
                const pageHeight = 842;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                
                doc.setFont("helvetica", "bold");
                doc.text("FONDOKI HOTEL SYSTEM RECEIPT", 40, 50);
                doc.setFontSize(10);
                doc.setFont("helvetica", "normal");
                doc.text("Generated: " + new Date().toISOString().split('T')[0], 40, 70);
                
                doc.addImage(imgData, 'PNG', 40, 100, imgWidth, imgHeight);
                doc.save('booking_info.pdf');
            });
        });
    </script>
</body>
</html>
<?php 
mysqli_close($conn); 
?>