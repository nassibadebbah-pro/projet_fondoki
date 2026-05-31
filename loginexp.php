<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Best free online hotel booking courses...">
    <meta name="keywords" content="hotel, booking, accommodation, فنادق, إقامة">
    
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="icon" href="/icons/logo.png">
    
    <link href="https://fonts.googleapis.com/css2?family=Tangerine&display=swap" rel="stylesheet"/>
    
    <script src="/script.js"></script>
    <title>Room Booking</title>
</head>
<body>

<h2>Animated Modal with Header and Footer</h2>

<button id="myBtn" style="padding: 10px;">Open The Modal</button>

<div id="myModal" class="modal">
  <div class="modal-content">
    
    <div class="modal-header">
      <h2>Secure Payment & Room Booking Confirmation</h2>
    </div>
  
    <div class="modal-body">
      <form action="YOUR_BACKEND_URL" method="POST" name="form4">
        <input type="hidden" name="command">
        
        <p>Account Number</p>
        <input type="text" name="account_number" placeholder="Enter your account number">
        
        <p>Password</p>
        <input type="password" name="password" placeholder="Enter your password">
        
        <p>Confirm Password</p>
        <input type="password" name="password2" placeholder="Confirm your password">
    </div>
    
    <div class="modal-footer">
      <h3>Please fill in your data carefully <span class="close" style="cursor:pointer; color:red; margin-left:20px;">[ Close ]</span></h3>
    </div>
    
      </form> </div>
</div>

<script src="/JS/login.js"></script>
</body>
</html>