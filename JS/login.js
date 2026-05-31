// 1. Get the modals existing on the page
var modal1 = document.getElementById('myModal1'); // Booking modal
var modal2 = document.getElementById('myModal2'); // Invoice (receipt) modal

// 2. Get all room buttons (Single, Double, Triple) using the common class
var bookingButtons = document.getElementsByClassName("myBtnTrigger");

// Enable the open command when clicking any of the room buttons
for (var i = 0; i < bookingButtons.length; i++) {
    bookingButtons[i].onclick = function() {
        if (modal1) modal1.style.display = "block";
    }
}

// 3. Booking form submission button to trigger the invoice modal
var btn2 = document.getElementById("myBtn2");
if (btn2) {
    btn2.onclick = function() {
        if (modal2) modal2.style.display = "block";
    }
}

// 4. Close modals when clicking the close button
var span = document.getElementsByClassName("close")[0];
if (span) {
    span.onclick = function() {
        if (modal1) modal1.style.display = "none";
        if (modal2) modal2.style.display = "none";
    }
}

// 5. Automatically close modals when clicking anywhere outside the modal window
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}