<?php
// Initialize database connection if required for dynamic processing future paths
$conn = mysqli_connect('localhost', 'root', '', 'fondouki_system');
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Explore and book the best luxury or affordable hotels in M'sila province.">
    <meta name="keywords" content="hotel, accommodation, msila, bou saada, hospitality, reserve">
    <link rel="stylesheet" href="../../css/style.css"/>
    <link rel="icon" href="../../icons/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet"/>
   
    <title>M'sila Province Hotels</title>
</head>
<body dir="ltr">
    <section class="home1" id="home">
        <nav>
            <h2>Fondoki <span>Your Hotel Guide</span></h2>
            <ul id="actions">
                <li><a href="../../pagFondoki.php">Home</a></li>
            </ul>
            <span id="date"></span>
            <button id="menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
         </nav> 
    </section>

    <section class="about">
        <h2>Hotels in M'sila Province</h2>
    </section>

    <section class="services">
        <div class="dof">
            
            <div class="hotel">
                <div>
                    <img src="../../img/kerdada_hotel.jpg" alt="Kerdada Hotel Image Asset">
                </div>
                <p class="fas fa-mobile-alt"></p>
                
                <div>
                    <h5>Kerdada Hotel</h5>
                    <p><span>District:</span> Bou Saada</p>
                    <p><span>Location:</span> Downtown Bou Saada City Center</p>
                    <p><span>Rating:</span> 4 Stars ★★★★</p>
                    <a href="hotel_kerdada.php" class="btn">Available Rooms</a>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3259.7979019261575!2d4.186375125372235!3d35.21150265563652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128bb3c859e5b93d%3A0xa67c596442e1602b!2z2YHZhtiv2YIg2YPYsdiv2KfYr9ip!5e0!3m2!1sar!2sdz!4v1683059498833!5m2!1sar!2sdz" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>   

            <div class="hotel">
                <div>
                    <img src="../../img/el_caid_hotel.jpg" alt="El Caid Hotel Image Asset">
                </div>
                <p class="fas fa-mobile-alt"></p>
                
                <div class="ZZ">
                    <h5>El Caid Hotel</h5>
                    <p><span>District:</span> Bou Saada</p>
                    <p><span>Location:</span> Amamine Neighborhood, Bou Saada</p>
                    <p><span>Rating:</span> 4 Stars ★★★★</p>
                    <a href="login_user.php" class="btn">Available Rooms</a>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3259.399401059303!2d4.185543225371682!3d35.221426355097385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128bb3ae057194bd%3A0x66687dae005bb9c1!2z2YHZhtiv2YIg2KfZhNmC2KfZitiv!5e0!3m2!1sar!2sdz!4v1683059879179!5m2!1sar!2sdz" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>   

            <div class="hotel">
                <div>
                    <img src="../../img/el_kalaa_hotel.jpg" alt="El Kalat Hotel Image Asset">
                </div>
                <p class="fas fa-mobile-alt"></p>
                
                <div>
                    <h5>El Kalat Hotel</h5>
                    <p><span>District:</span> M'sila</p>
                    <p><span>Location:</span> Northern M'sila City Limits</p>
                    <p><span>Rating:</span> 4 Stars ★★★★</p>
                    <a href="Msila.php" class="btn">Available Rooms</a>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3239.05474499802!2d4.551801525344821!3d35.7248721275773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128b7b468c7e5741%3A0xb164ab2456aff5be!2z2YHZhtiv2YIg2KfZhNmC2YTYudip!5e0!3m2!1sar!2sdz!4v1683059955387!5m2!1sar!2sdz" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

        </div>
    </section>

    <section class="skills">
         <div>
             <h2>Support Channels <span>At Your</span> Service</h2>
             <div class="tel">
                 <div class="tel1"><img src="../../icons/tel2.png" alt="Phone Support Line"><h3>06.76.04.76.23</h3></div>
                 <div class="tel1"><img src="../../icons/gmail.png" alt="Email Desk"><h3>Fondouki.com</h3></div>
                 <div class="tel1"><img src="../../icons/instag.png" alt="Instagram Handler"><h3>@fondouki_reserve</h3></div>
                 <div class="tel1"><img src="../../icons/facbook.png" alt="Facebook Public Page"><h3>facebook.com/fondouki</h3></div>
             </div>
         </div>
    </section>

    <footer>
         <div class="content-footer">
             <p>For any inquiries, please contact us through our verified platform channels listed above.</p> 
             <p>Copyright © Fondoki 2026 <img src="../../icons/copyright_16px.png" alt="Copyright System Icon"> All Rights Reserved.</p>
         </div>
    </footer>

    <script src="JS/script.js"></script>
    <script src="JS/date.js"></script>
    <script src="JS/login.js"></script>
</body>
</html>