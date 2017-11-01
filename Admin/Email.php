<?php
    include "MenuBar.html";
    require "php/admin_functions.php";
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
        <link rel="stylesheet" href="css/Admin.css" />

        <script src="../resources/library/jquery-3.2.1.min.js"></script>
        <script src="../resources/library/DataTables/js/jquery.dataTables.min.js"></script>
    </head>
    
<body>
    <div class="page_container">  
        
        <?php
            $subscribers = get_all_rows('subscribers');
            $subscribers_table = "";
        ?> 
        <div class="content_container_left">
            <h3>Newsletter Subscribers</h3>
            <table id="subscribers_table" class="display table-responsive" cellspacing="0" width="100%"> 
                <thead>
                    <tr> 
                        <th>Subscriber E-mail</th> 
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($subscribers as $row) {
                            $delete = '<a href="php/email/delete_subscriber.php?id='.$row['id'].'"    
                                        onclick="return confirm(\'Are you sure you want to delete this subscriber?\');" 
                                        title="Delete Subscriber">
                                        <img src="img/db_table_icons/delete.png" 
                                        alt="delete"/></a>';

                            $subscribers_table.= "<tr><td>" . $row['email'] . "</td><td>" . $delete . "</td></tr>\n"; 
                        }
                        echo $subscribers_table;
                    ?>
                </tbody>
            </table><br>
        </div>
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
                <img src="img/ajax-loader.gif" />
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
        $(document).ready(function() {
            $('#subscribers_table').DataTable();
        });
    </script>
    <script type="text/javascript" src="js/email_sender.js"></script>
</div>
</body>
</html>