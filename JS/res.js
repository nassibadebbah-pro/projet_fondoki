// Get the modals
var modal1 = document.getElementById('myModal1');
var modal2 = document.getElementById('myModal2');

// Get all buttons that open the booking modal (using the new class)
var bookingButtons = document.getElementsByClassName("myBtnTrigger");

// Loop through all booking buttons to attach the click event
for (var i = 0; i < bookingButtons.length; i++) {
    bookingButtons[i].onclick = function() {
        modal1.style.display = "block";
    }
}

// Get the execute reservation button to show the invoice/receipt
var btn2 = document.getElementById("myBtn2");
if (btn2) {
    btn2.onclick = function() {
        // Only show modal2 if needed by your logic, or let the PHP page reload handle it
        modal2.style.display = "block";
    }
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
if (span) {
    span.onclick = function() {
        modal1.style.display = "none";
        if (modal2) modal2.style.display = "none";
    }
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
}