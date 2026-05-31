<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="best free online hotels booking platform">
    <meta name="keywords" content="hotel, accommodation, hospitality, booking, algeria">
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="icon" href="/icons/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet"/>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Fondoki</title>
</head>
<body dir="ltr">
   <section class="home" id="home">
 
   <nav> 
    <h2>Fondoki <span>Your Hotel Guide</span></h2>
     <ul id="actions">
        <li><a href="#home">Home</a></li>
        <li><a href="#home">Language</a></li>
        <li><a id="myBtn3" style="cursor:pointer">Register Your Hotel</a></li>
     </ul>

     <header id="myModal3">
        <section class="reservation">
            <form method="post" enctype="multipart/form-data">
                <div class="res">
                    <div class="left">
                        <span class="close" style="cursor:pointer">Close</span>
                        <h2><span>Hotel or Property Info</span></h2>
                        <div id="zip">
                            <label>
                                Property Type
                                <select name="Thotel">
                                    <option value="Hotel">Hotel</option>
                                    <option value="Motel">Motel / Inn</option>
                                    <option value="Property">Real Estate / Apartment</option>
                                </select>
                            </label>
                            <label>
                                Province / State
                                <input type="text" name="wilaya" required placeholder="e.g., M'sila">
                            </label>
                            <label>
                                Municipality
                                <input type="text" name="comm" required placeholder="e.g., Bou Saada">
                            </label>
                        </div>
                        Hotel or Property Name
                        <input type="text" name="nomF" required placeholder="Enter property name">
                        Owner Name 
                        <input type="text" name="nomD" required placeholder="Enter owner's full name">
                        Location Coordinates
                        <div id="zip">
                            <input type="text" id="address" name="adrs" placeholder="Coordinates or Address">
                            <button type="button" id="get-location" onclick="getCurrentLocation()" style="height: 40px;">Get Location</button>
                        </div>
                        Star Rating
                        <input type="number" name="nbrET" required placeholder="Number of stars" min="0" max="5">
                    </div>
                    
                    <div class="right">
                        <h2><span>Contact Information</span></h2>
                        Email Address
                        <input type="email" name="email" required placeholder="business@hotel.com">
                        Primary Phone Number
                        <input type="tel" name="tel1" required placeholder="Primary phone number">
                        Secondary Phone Number
                        <input type="tel" name="tel2" placeholder="Secondary phone number (Optional)">
                        Number of Rooms
                        <input type="text" name="nbrCH" required placeholder="Total available rooms">
                        Proof of Ownership (PDF)
                        <input type="file" name="cert" id="cert" accept="application/pdf">
                        <input type="submit" name="submit3" value="Submit Registration" style="width:100%;">
                    </div>
                </div>
            </form>
        </section>
     </header>

     <span id="date"></span>
      <a id="myBtn1" class="btn">Login</a>
      <button id="menu">
        <span></span>
        <span></span>
        <span></span>
      </button>

      <div id="myModal1" class="form-container">
          <form method="post">
              <span class="close" style="cursor:pointer">Close</span>
              <h3>Login Now</h3>
              <?php
              if(isset($login_errors) && !empty($login_errors)){
                 foreach($login_errors as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                 }
              }
              ?>
              <input type="email" name="email" required placeholder="Your Email Address">
              <input type="password" name="password" required placeholder="Your Password">
              <input type="submit" name="submit1" value="Login" class="btn">
              <p>Don't have an account? <a id="myBtn2" style="cursor:pointer">Create Account</a></p>
          </form>
      </div>

      <div id="myModal2" class="form-container">
          <form method="post">
             <span class="close" style="cursor:pointer">Close</span>
             <h3>Create an Account</h3>
             <?php
             if(isset($register_errors) && !empty($register_errors)){
                 foreach($register_errors as $error){
                     echo '<span class="error-msg">' .$error.'</span>';
                 }
             }
             ?>
             <input type="text" name="name" required placeholder="Full Name">
             <input type="email" name="email" required placeholder="Email Address">
             <input type="password" name="password" required placeholder="Password">
             <input type="password" name="cpassword" required placeholder="Confirm Password">
             <input type="submit" name="submit2" value="Register" class="btn">
          </form>
      </div>
    </nav> 
    
    <div class="content">
        <div class="container-texts">
            <h1>Fondoki <span>Online Room Reservation</span></h1>
            <h3><span>Connect with us through the following networks:</span></h3>
            <div class="social">
                <a href="#"><img src="/icons/gmail.png" alt="Gmail"></a>
                <a href="#"><img src="/icons/facbook.png" alt="Facebook"></a>
                <a href="#"><img src="/icons/twiter.png" alt="Twitter"></a>
                <a href="#"><img src="/icons/instag.png" alt="Instagram"></a>
            </div>
        </div>
        <div class="container-images">
            <img src="/images/tach.png" alt="" class="shape">
            <img src="/images/HOME.png" alt="" class="pic">
        </div>
    </div>
   </section>

   <section class="about">
        <div class="container-texts">
            <h1>Select <span>Location</span></h1>
            <div>
                <input class="search1" type="text" name="text" placeholder="Search destinations or hotels...">
                <a href="#" class="btn">Search</a>   
            </div><br>
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d204627.7040880805!2d3.303802375058177!3d36.739180452406494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128fb26977ea659f%3A0x4231102d38a36f49!2z2KfZhNis2LLYp9im2LE!5e0!3m2!1sar!2sdz!4v1686611001783!5m2!1sar!2sdz" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>         
   </section>

   <section class="services">
        <div class="content">
            <h1 class="text-center"><span>Explore</span> Provinces</h1>      
            <a href="#" class="btn">View More</a>
        </div>
        <div class="box">
            <div class="card">
                <div>
                    <img src="/images/msila.jpeg" alt="M'sila">
                </div>
                <p class="fas fa-mobile-alt"></p>
                <h5>M'sila</h5>
                <div class="par">
                    <p><span>Location:</span> Central Algeria</p>
                    <p><span>Area:</span> 4,798 km²</p>
                    <p><span>Available Hotels:</span> 03</p>
                </div>
                <a href="/CLIENT/MSILA/Msila.php" class="btn">Book Now</a>
            </div>

            <div class="card">
                <div class="container-images">
                    <img src="/images/djijel.jpeg" alt="Jijel">
                </div>
                <p class="fas fa-mobile-alt"></p>
                <h5>Jijel</h5>
                <div class="par">
                    <p><span>Location:</span> Eastern Coastline</p>
                    <p><span>Area:</span> 2,579 km²</p>
                    <p><span>Available Hotels:</span> 05</p>
                </div>
                <a href="#" class="btn">Book Now</a>
            </div>

            <div class="card">
                <div class="container-images">
                    <img src="/images/alger.jpeg" alt="Algiers">
                </div>
                <p class="fas fa-mobile-alt"></p>
                <h5>Algiers</h5>
                <div class="par">
                    <p><span>Location:</span> Capital Coast</p>
                    <p><span>Area:</span> 1,641 km²</p>
                    <p><span>Available Hotels:</span> 04</p>
                </div>
                <a href="#" class="btn">Book Now</a>
            </div>

            <div class="card">
                <div class="container-images">
                    <img src="/images/setif.jpeg" alt="Setif">
                </div>
                <p class="fas fa-mobile-alt"></p>
                <h5>Setif</h5>
                <div class="par">
                    <p><span>Location:</span> Northeastern Highlands</p>
                    <p><span>Area:</span> 7,970 km²</p>
                    <p><span>Available Hotels:</span> 02</p>
                </div>
                <a href="#" class="btn">Book Now</a>
            </div>
        </div>
   </section>

   <section class="skills">
        <div>
            <h2>Channels <span>At Your</span> Service</h2>
            <div class="tel">
                <div class="tel1">
                    <img src="/icons/tel2.png" alt="Phone">
                    <h3>06.76.04.76.23</h3>
                </div>
                <div class="tel1"><img src="/icons/gmail.png" alt="Email"><h3>Fondouki.com</h3></div>
                <div class="tel1"><img src="/icons/instag.png" alt="Instagram"><h3>@fondouki_reserve</h3></div>
                <div class="tel1"><img src="/icons/facbook.png" alt="Facebook"><h3>facebook.com/fondouki</h3></div>
            </div>
         </div>
   </section>

   <footer>
        <p>For any inquiries, please contact our registered service channels.</p> 
        <p>Copyright &copy; Fondoki 2026 <img src="/icons/copyright_16px.png" alt="Copyright"> All Rights Reserved.</p>
   </footer>

   <script src="/JS/geolocation.js"></script>
   <script src="/JS/login.js"></script>
   <script src="/JS/script.js"></script>
</body>
</html>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'fondouki_system');

// Action 1: Handle User Authentication Access Route
if (isset($_POST['submit1'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    
    $select = "SELECT * FROM user WHERE email = '$email' AND password = '$pass'";
    $result = mysqli_query($conn, $select);
    
    if (mysqli_num_rows($result) > 0) {
        echo '<script>
            swal({
                title: "Welcome Back!",
                text: "You have logged in successfully!",
                icon: "success",
                button: "Continue",
            });
        </script>';
    } else {
        $login_errors[] = "Invalid email identity configuration or password match failure.";
    }
}

// Action 2: Handle User Registration Record Building Pipeline
if (isset($_POST['submit2'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);

    $select = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $register_errors[] = 'An account with this email resource index already exists.';
    } else {
        if ($pass != $cpass) {
            $register_errors[] = 'Password verification confirmation mismatch.';
        } else {
            $insert = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$pass')";
            mysqli_query($conn, $insert);
            echo '<script>
                swal({
                    title: "Success!",
                    text: "Your account registration has been completed!",
                    icon: "success",
                    button: "Continue",
                });
            </script>';
        }
    }
}

// Action 3: Handle Hotel B2B Registration Database Ingestion
if (isset($_POST['submit3'])) {
    $Thotel = mysqli_real_escape_string($conn, $_POST['Thotel']);
    $wilaya = mysqli_real_escape_string($conn, $_POST['wilaya']);
    $comm = mysqli_real_escape_string($conn, $_POST['comm']);
    $nomF = mysqli_real_escape_string($conn, $_POST['nomF']);
    $nomD = mysqli_real_escape_string($conn, $_POST['nomD']);
    $adrs = mysqli_real_escape_string($conn, $_POST['adrs']);
    $nbrET = mysqli_real_escape_string($conn, $_POST['nbrET']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $tel1 = mysqli_real_escape_string($conn, $_POST['tel1']);
    $tel2 = mysqli_real_escape_string($conn, $_POST['tel2']);
    $nbrCH = mysqli_real_escape_string($conn, $_POST['nbrCH']);

    if (isset($_FILES['cert']) && $_FILES['cert']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['cert']['tmp_name'];
        $fileContent = file_get_contents($fileTmpPath);
        $certContent = mysqli_real_escape_string($conn, $fileContent);

        $insert = "INSERT INTO demand_hotel (Type, Wilaya, commun, nomHot, nomDir, Adress, nbrEtl, email, tel1, tel2, nbrChem, Cert) 
                   VALUES ('$Thotel', '$wilaya', '$comm', '$nomF', '$nomD', '$adrs', '$nbrET', '$email', '$tel1', '$tel2', '$nbrCH', '$certContent')";
        
        if (mysqli_query($conn, $insert)) {
            echo '<script>
                swal({
                    title: "Application Sent!",
                    text: "Your property files and profile data have been submitted for validation review.",
                    icon: "success",
                    button: "Done",
                });
            </script>';
        } else {
            echo '<script>swal("System Error", "Database operation failure context encountered.", "error");</script>';
        }
    } else {
        echo '<script>swal("File Missing", "Please select a valid PDF proof of ownership document profile asset.", "error");</script>';
    }
}
?>