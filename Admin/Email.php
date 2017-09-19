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

        <link rel="stylesheet" href="css/Admin.css" />
    </head>
    
<body>
    <div class="page_container">  
        
        <?php
            $subscribers = get_all_rows('subscribers');
            $subscribers_table = "";
        ?> 
        <div class="content_container">
            <p>Current Subscribers</p>
            <table> 
                <thread>
                    <tr> 
                        <th>Subscriber E-mail</th> 
                        <th></th>
                    </tr>
                </thread>
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
        <div class="content_container">
            <form method="POST" action="">
                <p><label for="subject">Subject (*required):</label><br>
                <input type="text" id="subject" name="subject" size="40" required/></p>
                <p><label for="message">Mail Body (*required):</label><br>
                <textarea id="message" name="message" cols="50"   rows="10" required=""></textarea></p>
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
    <script src="../resources/library/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/email_sender.js"></script>
</div>
</body>
</html>