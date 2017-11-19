<?php
    require "../resources/config.php";

    # create connection to database
    $mysqli = new mysqli($config['db']['amsti_01']['host']
        , $config['db']['amsti_01']['username']
        , $config['db']['amsti_01']['password']
        , $config['db']['amsti_01']['dbname']);

    /* check connection */
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }
?>

<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>E-mail Subscribers</title>

        <link rel="stylesheet" href="../resources/library/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../resources/library/bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../resources/library/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="../resources/library/DataTables/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="../Admin/css/Admin.css" />

<!--         <script src="../resources/library/jquery-3.2.1.min.js"></script> -->
        <script src="../resources/library/DataTables/js/jquery.dataTables.min.js"></script>
    </head>
    
<body>
    <div class="page_container">  
        <div class="content_container_left">
            <button id="del_subscriber_btn" name="del_subscriber_btn">Delete Subscriber</button>
            <br><br>
            <table id="subscribers_table" class="display table-responsive" cellspacing="0" width="100%"> 
                <thead>
                    <tr> 
                        <th>Subscriber E-mail</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT email FROM subscribers ORDER BY id ASC";

                        if ($result = mysqli_query($mysqli, $sql))
                        {
                            while ($row = mysqli_fetch_row($result))
                            {
                                echo
                                    "<tr><td style='text-align: center;'>" . $row[0] . "</td></tr>"; 
                            }
                        }
                    ?>
                </tbody>
            </table><br>
        </div>
        <br><br>
        <div class="content_container_right">
            <br>
            <form method="POST" action="">
                <p><label for="subject">Subject (*required):</label><br>
                <input type="text" id="subject_text_edit" name="subject" size="40" required/></p>
                <p><label style="padding-top: 10px;" for="message">Mail Body (*required):</label><br>
                <textarea id="message_text_edit" name="message" cols="50"   rows="10" required=""></textarea></p>
                <button id="send_emails_button" type="submit" value="submit">Send E-mails</button>
            </form>
        </div>

        <div id="busy_box">
            <div class="busy_box_container">
                <img src="../Admin/img/ajax-loader.gif" />
            </div>
        </div>
        <div id="results_box">
            <div class="results_box_container">
                <h3>Results</h3>
                <p id="results_text"></p><br>
                <button id="ok_button">OK</button>
            </div>
        </div>
    </div>
    <script>
        var busy_box = document.getElementById('busy_box');
        var results_box = document.getElementById('results_box');
        var ok_button = document.getElementById('ok_button');

        var subscribers = $('#subscribers_table').DataTable({
                        lengthChange: false,
                        select: {
                            style:          'single'
                        },
                        columnDefs: [
                            { "width": 800, "targets": 0}
                        ]
                    });

        $('#subscribers_table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                subscribers.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
     
        $('#del_subscriber_btn').click( function () {
            var email_id = subscribers.row('.selected').data()[0];

            if (!(confirm('Are you sure you want to delete subscriber "' + email_id + '"?'))) 
            {
                return false;
            } 
            else 
            {
                $.ajax({

                    type: "POST",
                    url: "../Admin/php/email/delete_subscriber.php",
                    data: {
                        email: email_id
                    },

                    success: function(data) {
                        if (data == 'removed')
                        {
                            subscribers.row('.selected').remove().draw();                                    
                        }
                        else
                        {
                            alert(data); //Will print error returned by the database
                        }

                    },
                    error: function(data){
                            alert(data); //Will print error returned
                    }
                });
            }
        });

        // Ajax call to pass e-mail address to php
        $('#send_emails_button').click(function() {
            var subject = document.getElementById('subject_text_edit').value;
            var message = document.getElementById('message_text_edit').value;

            $.ajax({
                type: "POST",
                url: "../Admin/php/email/send_email.php",
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
    </script>
</div>
</body>
</html>