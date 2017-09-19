$(document).ready(function() {

    var busy_box = document.getElementById('busy_box');
    var results_box = document.getElementById('results_box');
    var ok_button = document.  getElementById('ok_button');

    // Ajax call to pass e-mail address to php
    $('#send_emails_button').click(function() {
        var subject = document.getElementById('subject').value;
        var message = document.getElementById('message').value;
        var url = "php/email/send_email.php";

        $.ajax({
            type: "POST",
            url: url,
            data:
            {
                subject: subject,
                message: message
            },
            beforeSend: function(){
                busy_box.style.display = "block";
            },
            success: function(data)
            {
                busy_box.style.display = "none";
                results_text.innerHTML = data;
                results_box.style.display = "block";
            },
            error: function(jqXHR, exception) {
                alert('ERROR: (' + jqXHR + ')' + " " + exception);
            }
        });

        event.preventDefault(); // avoid to execute the actual submit of the form.
    });

    ok_button.onclick = function(event) {
        results_box.style.display = "none";
    }
});