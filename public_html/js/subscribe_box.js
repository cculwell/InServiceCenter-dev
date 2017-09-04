// Ensure we have a valid email address before submitting the data
function validateEmail()  { 
    var email_address = document.getElementById("email_address");
    var email_format = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  

    if(email_address.value.match(email_format))  {  
        return true;  
    }  
    else  {  
        alert("Please enter a valid e-mail address!");  
        email_address.focus();  
        return false;  
    }
}

// Get the subscribe box
var box = document.getElementById('subscribe_box');

// Get the button that opens the subscribe box
var subscribe_button = document.getElementById("subscribe_button");

// Get the button that closes the subscribe box
var cancel_button = document.getElementById("cancel_button");

// When the user clicks on the subscribe button, open the subscribe box 
subscribe_button.onclick = function() {
    box.style.display = "block";
}

// When the user clicks the cancel button, exit the subscribe box
cancel_button.onclick = function() {
    box.style.display = "none";
}

// When the user clicks anywhere outside of the subscribe box, close it
window.onclick = function(event) {
    if (event.target == box) {
        box.style.display = "none";
    }
}