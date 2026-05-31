function displayDate() {
    var today = new Date();
    var date = today.getDate();
    var month = today.getMonth() + 1;
    var year = today.getFullYear();
    var fullDate = date + '/' + month + '/' + year;

    document.getElementById('date').textContent = fullDate;
}

// Date updated every second (1000 milliseconds)
setInterval(displayDate, 1000);


function calculateDays() {
    var startDate = document.getElementById("start-date").value;
    var endDate = document.getElementById("end-date").value;

    var start = new Date(startDate);
    var end = new Date(endDate);

    var timeDiff = Math.abs(end.getTime() - start.getTime());
    var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

    document.getElementById("result").innerHTML = daysDiff;
}

var downloadlink = document.getElementById("download-link");
downloadlink.addEventListener("click", function() {
    var doc=new jsPDF();
    var form=document.getElementById("form");
   var content=form.outerHTML;
   
   doc.text(content,10,10);
   doc.save("booking_info.pdf");
});

function initMaps(){
var input=document.getElementById('location');
var autocomplet=new google.maps.places.autocomplet(input);
}

function Ptotal(){
    var prix=parseFloat(document.getElementById("prix").value);
    var NBRjour=parseFloat(document.getElementById("NBRjour").value);
    var total=prix*NBRjour;
    var Ptotal=total.toLocaleString();
}


