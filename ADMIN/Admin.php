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
    <meta name="keywords" content="hotel, accommodation, hospitality, dashboard, admin">
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="icon" href="/icons/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet"/>
   
    <title>Admin Dashboard</title>
</head>
<body dir="ltr">
    <section class="home1" id="home">
        <nav>
            <h2>Fondoki <span>Your Hotel Guide</span></h2>
            <ul id="actions">
                <li><a href="#home">Page Settings</a></li>
                <li><a href="#home">Customer Reviews</a></li>
                <li><a href="#home">Language</a></li>
            </ul>
            <a href="pagFondoki.php" class="btn">Client View</a>
            <button id="menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
         </nav> 
    </section>

    <section class="services">
        <div class="box">
            <div class="card">
                <div class="container-images">
                    <img src="img/hotel.jpg" alt="Partner Hotels">
                </div>
                <p class="fas fa-mobile-alt"></p>
                <h5>Partner Hotels</h5>
                <div class="par"></div>
                <a href="#" class="btn">Hotel List</a>
            </div>

            <div class="card">
                <div>
                    <img src="images/question.jpg" alt="Registered Guests">
                </div>
                <p class="fas fa-mobile-alt"></p>
                <h5>Registered Guests</h5>
                <div class="par"></div>
                <a href="users.php" class="btn">View List</a>
            </div>

            <div class="card">
                <div class="container-images">
                    <img src="/images/hotel-icon.png" alt="Subscription Requests">
                </div>
                <p class="fas fa-mobile-alt"></p>
                <h5>Subscription Requests</h5>
                <div class="par"></div>
                <a href="de_hotel.php" class="btn">View Requests</a>
            </div>
         
        </div>
    </section>

    <footer>
        <div class="content-footer">
            <p>For any inquiries, please contact us through the following platforms</p> 
            <div class="social">
                <a href="#"><img src="/icons/tel.png" alt="Phone"></a>
                <a href="#"><img src="/icons/gmail.png" alt="Gmail"></a>
                <a href="#"><img src="/icons/facbook.png" alt="Facebook"></a>
                <a href="#"><img src="/icons/twiter.png" alt="Twitter"></a>
                <a href="#"><img src="/icons/instag.png" alt="Instagram"></a>
            </div>
            <p><img src="/icons/copyright_16px.png" alt="Copyright"> All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>