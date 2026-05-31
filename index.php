<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet" >
    <link href="/img/logo.png" rel="shortcut icon">
    <title>Fondoki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
 
    <style>
    *{
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    } 
    
    .text-custom {
        text-align-last: left;
    }
   
    #map {
        width: 100%;
        height: 400px;
        font-family: Arial, sans-serif; 
    }
      
    #search {
        padding: 61px;
        margin: -50px auto 0 auto;
        display: flex;
        justify-content: center;
    }

    .search1 {
        width: 300px;
        height: 45px;
        border-radius: 34px;
        padding-left: 15px;
        padding-right: 15px;
        text-align: left;
        border: 1px solid #ccc;
    }
      
    .searchb {
        width: 100px;
        height: 45px;
        border-radius: 38px;
        color: #ffffff;
        background: #222354;
        border: none;
        margin-right: 8px;
    }
      
    .heading { position: relative; }
    .bonner { position: relative; }
    
    .remarque {
        width: 200px;
        height: 40px;
        padding-left: 7px;
        text-align: left;
    }
    </style>
</head>
<body dir="ltr">
    <div class="navbar navbar-expand-md bg-info navbar-dark text-white p-2">
        <div class="d-flex align-items-center me-4">
            <img src="/img/logoapp.png" alt="Logo" class="me-2">
            <h6 class="m-0"><strong>Fondoki</strong></h6>
        </div>
        <h1 class="h3 m-0 me-auto"><strong>Fondoki Online Booking Platform</strong></h1>
     
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="mainmenu">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="#intro" class="nav-link">Language</a></li>
                <li class="nav-item"><a href="#fraq" class="nav-link">State / Province</a></li>
                <li class="nav-item"><a href="#intro" class="nav-link">Days</a></li>
                <li class="nav-item"><a href="#intro" class="nav-link">Filter Prices</a></li>
            </ul>
        </div>
    </div>
    <br>
    
    <div id="search">
        <form class="d-flex align-items-center">
            <input class="search1" type="text" name="text" placeholder="Search here...">
            <input class="searchb" type="submit" name="submit" value="Search">
        </form>
    </div>

    <br>

    <div class="container text-center">
        <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-md-3 justify-content-center">
            <div class="col d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src="/img/setif.jpeg" class="card-img-top" alt="Setif">
                    <div class="card-body text-start">
                        <h5 class="card-title">Setif</h5>
                        <p class="card-text">Check out the most prominent hotel information here.</p>
                        <a href="#" class="btn btn-primary w-100">Available Hotels</a>
                    </div>
                </div>
            </div>
           
            <div class="col d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src="/img/biskra.jpeg" class="card-img-top" alt="Biskra">
                    <div class="card-body text-start">
                        <h5 class="card-title">Biskra</h5>
                        <p class="card-text">Check out the most prominent hotel information here.</p>
                        <a href="#" class="btn btn-primary w-100">Available Hotels</a>
                    </div>
                </div>
            </div>
           
            <div class="col d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src="/img/msila.jpeg" class="card-img-top" alt="M'sila">
                    <div class="card-body text-start">
                        <h5 class="card-title">M'sila</h5>
                        <p class="card-text">Check out the most prominent hotel information here.</p>
                        <a href="wilaya.html" class="btn btn-primary w-100">Available Hotels</a>
                    </div>
                </div>
            </div>
           
            <div class="col d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src="/img/djijel.jpeg" class="card-img-top" alt="Jijel">
                    <div class="card-body text-start">
                        <h5 class="card-title">Jijel</h5>
                        <p class="card-text">Check out the most prominent hotel information here.</p>
                        <a href="#" class="btn btn-primary w-100">Available Hotels</a>
                    </div>
                </div>
            </div>
           
            <div class="col d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src="/img/costantine.jpeg" class="card-img-top" alt="Constantine">
                    <div class="card-body text-start">
                        <h5 class="card-title">Constantine</h5>
                        <p class="card-text">Check out the most prominent hotel information here.</p>
                        <a href="#" class="btn btn-primary w-100">Available Hotels</a>
                    </div>
                </div>
            </div>

            <div class="col d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img src="/img/alger.jpeg" class="card-img-top" alt="Algiers">
                    <div class="card-body text-start">
                        <h5 class="card-title">Algiers</h5>
                        <p class="card-text">Check out the most prominent hotel information here.</p>
                        <a href="#" class="btn btn-primary w-100">Available Hotels</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br>
    
    <div id="map"></div>
    <script>
        function initMap() {
            var location = {lat: 35.211475, lng: 4.171666};
            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 16,
                center: location
            });
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbPyJkQwVqsmdMOpGiKbv43M02WZgQ638&callback=initMap"></script>

    <br><br>

    <div class="container text-start">
        <div class="card p-4">
            <h4>Notes & Feedback Section</h4>
            <br>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Username" aria-label="Username">
                <span class="input-group-text">@</span>
                <input type="email" class="form-control" placeholder="example@gmail.com" aria-label="Server">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Add Note</span>
                <textarea class="form-control" aria-label="Add Note" placeholder="Write your remarks here..."></textarea>
            </div>  
            <input type="submit" name="submit" value="Send" class="btn btn-dark w-25">
        </div>
    </div>
    
    <br>
    <div class="navbar navbar-expand-md bg-success navbar-dark text-dark"></div>
    <br>

    <div class="container text-center mb-5">
        <div class="row align-items-end">
            <div class="col">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
                        <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
                        <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
                    </svg>
                    <div class="fw-bold">GMAIL</div>
                    <div>foundouki@gmail.com</div>
                </div>
            </div>
            <div class="col">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                    </svg>
                    <div class="fw-bold">Phone Number</div>
                    <div>06.82.74.52.38</div>
                </div>
            </div>
            <div class="col">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                    <div class="fw-bold">Facebook</div>
                    <div>facebook.com</div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>