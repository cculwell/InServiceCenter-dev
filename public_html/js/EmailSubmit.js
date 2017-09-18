$(document).ready(function() {

    var subscribe_box = document.getElementById('subscribe_box');
    var unsubscribe_box = document.getElementById('unsubscribe_box');
    var success_box = document.getElementById('success_box');
    var error_box = document.getElementById('error_box');
    var success_text = document.getElementById('success_text');
    var error_text = document.getElementById('error_text');

    // Ajax call to pass e-mail address to php
    $('#subscribe_confirm_button').click(function() {
        var email = document.getElementById('subscribe_email_address').value;
        var url = "php/email_subscription/subscribe.php";

        $.ajax({
            type: "POST",
            url: url,
            data:
            {
                email: email
            },
            success: function(data)
            {
                if (data == "Successfully Subscribed!") {
                    subscribe_box.style.display = "none";
                    success_text.innerHTML = data;
                    success_box.style.display = "block";   
                }
                if (data == "There was a problem subscribing. Please try again or contact the administrator." || 
                    data == "The E-mail address provided is already being used." ||
                    data == "Please provide an E-mail address." ||
                    data == "Please enter a valid E-mail adress.") {
                    subscribe_box.style.display = "none";
                    error_text.innerHTML = data;
                    error_box.style.display = "block";
                }
            },
            error: function(jqXHR, exception) {
                alert('ERROR: (' + jqXHR + ')' + " " + exception);
            }
        });

        event.preventDefault(); // avoid to execute the actual submit of the form.
    });

    $('#unsubscribe_confirm_button').click(function() {
        var email = document.getElementById('unsubscribe_email_address').value;
        var url = "php/email_subscription/unsubscribe.php";

        $.ajax({
            type: "POST",
            url: url,
            data:
            {
                email: email
            },
            success: function(data)
            {
                if (data == "Successfully Unsubscribed!") {
                    unsubscribe_box.style.display = "none";
                    success_text.innerHTML = data;
                    success_box.style.display = "block";   
                }
                if (data == "There was a problem unsubscribing. Please try again or contact the administrator." || 
                    data == "This E-mail is not subscribed to the newsletter. Check the spelling and try again." ||
                    data == "Please enter a valid E-mail address." ||
                    data == "Please enter an E-mail address.") {
                    unsubscribe_box.style.display = "none";
                    error_text.innerHTML = data;
                    error_box.style.display = "block";
                }
            },
            error: function(jqXHR, exception) {
                alert('ERROR: (' + jqXHR + ')' + " " + exception);
            }
        });

        event.preventDefault(); // avoid to execute the actual submit of the form.
    });
});