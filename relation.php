<?php
if(isset($_POST['submit'])){

    // 1. Database Connection
    $conn = mysqli_connect('localhost', 'root', '', 'fondouki_system');
    if(!$conn){
        die("There was a problem connecting to the database: " . mysqli_connect_error());
    }

    // 2. Sanitize and Secure Inputs
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = $_POST['password'];
    
    // Hashing the password for security
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // 3. Using Prepared Statements to prevent SQL Injection
    $stmt = mysqli_prepare($conn, "INSERT INTO commentair (email, password) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $email, $hashed_password);
    
    $result = mysqli_stmt_execute($stmt);
  
    if($result){
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header('Location: pagFondoki.php');
        exit();
    } else {
        echo "An error occurred while saving: " . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Best free online hotel courses ...">
    <meta name="keywords" content="hotel, accommodation, booking, kerdada">
    
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="icon" href="icons/logo.png">
    
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet"/>
   
    <title>Kerdada Hotel</title>
</head>
<body dir="ltr">
    <section class="home1" id="home">
        <nav>
            <h2>Fondoki <span>Your Hotel Guide</span></h2>
            <ul id="actions">
                <li><a href="pagFondoki.php">Home</a></li>
                <li><a href="#home">Register Your Hotel</a></li>
                <li><a href="#home">Settings</a></li>
            </ul>
            <a href="login.php" class="btn">Login</a>
            <button id="menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav> 
    </section>

    <section class="about">
        <h2>Kerdada Hotel</h2>
    </section>

    <section class="services">
        <div class="dof">
            <div class="hotel">
                <div>
                    <img src="/img/chambre-1.jpg" alt="Single Room">
                </div>
                <p class="fas fa-mobile-alt"></p>
                <div>
                    <h3>Single Room</h3>
                    <p><span>Available Rooms:</span> 5</p>
                    <a href="login_user.php" class="btn">Book Now</a>
                </div>
                <div class="prix">
                    <h5>Room Price</h5>
                    <p>Price</p>
                </div>
            </div>
            
            <div class="hotel">
                <div>
                    <img src="/img/chambre-2.jpg" alt="Double Room">
                </div>
                <p class="fas fa-mobile-alt"></p>
                <div>
                    <h3>Double Room</h3>
                    <p><span>Available Rooms:</span> 8</p>
                    <a href="login_user.php" class="btn">Book Now</a>
                </div>
                <div class="prix">
                    <h5>Room Price</h5>
                    <p>Price</p>
                </div>
            </div>

            <div class="hotel">
                <div>
                    <img src="/img/Chambre-3.jpg" alt="Triple Room">
                </div>
                <p class="fas fa-mobile-alt"></p>
                <div>
                    <h3>Triple Room</h3>
                    <p><span>Available Rooms:</span> 6</p>
                    <a href="login_user.php" class="btn">Book Now</a>
                </div>
                <div class="prix">
                    <h5>Room Price</h5>
                    <p>Price</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container-texts">
        <h5>Customers <span>Reviews</span></h5>
        <form action="" method="post">
            <input type="email" name="email" required placeholder="Your Email Address">
            <input type="password" name="password" required placeholder="Your Password">
            <input type="submit" name="submit" value="Login" class="btn">
        </form>
    </section>

    <section class="skills">
        <div>
            <h5>Customer <span>Support</span> Accounts</h5>
            <div class="tel">
                <div class="tel1"><img src="/icons/tel2.png" alt="Phone"><h5>06.76.04.76.23</h5></div>
                <div class="tel1"><img src="/icons/gmail.png" alt="Email"><h5>Fondouki.com</h5></div>
                <div class="tel1"><img src="/icons/instag.png" alt="Instagram"><h5>06.76.04.76.23</h5></div>
                <div class="tel1"><img src="/icons/facbook.png" alt="Facebook"><h5>facebook.com</h5></div>
            </div>
        </div>
    </section>

    <footer>
        <div class="content-footer">
            <p>For any inquiries, please contact us through the following platforms</p> 
            <p><img src="/icons/copyright_16px.png" alt="Copyright"> All Rights Reserved.</p>
        </div>
    </footer>

    <script src="/script.js"></script>
</body>
</html>


<table border="1">
  <tr>
     <th>Email / Name</th>
     <th>Comment / Password</th>
  </tr>
  <?php 
  $conn = mysqli_connect('localhost', 'root', '', 'hotel_kerdada');
  $sql = "SELECT email, password FROM commentair"; 
  $result = mysqli_query($conn, $sql);
  if($result){
      while($row = mysqli_fetch_assoc($result)){
          echo '<tr>
                    <td>'.htmlspecialchars($row['email']).'</td>
                    <td>'.htmlspecialchars($row['password']).'</td>
                </tr>';
      }
  }
  ?>
</table>