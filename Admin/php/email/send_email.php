<?php
    require "../../../resources/config.php";
    require "../../../resources/library/php/PHPMailer/src/PHPMailer.php";
    require "../../../resources/library/php/PHPMailer/src/Exception.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $display_block = "";

    $db = $config['db']['admin_files'];
    $link = new mysqli($db['host'], $db['username'], $db['password'], $db['dbname']) or die('There was a problem connecting to the database.');

    // Get subscribers emails
    $email_address_query = "SELECT email FROM subscribers";
    $email_address_results = $link->query($email_address_query) or die("Error : ".mysqli_error($link)); 

    // Get the current newsletter
    $current_newsletter_query = "SELECT * FROM newsletters WHERE current='yes'";
    $current_newsletter_results = $link->query($current_newsletter_query) or die("Error : ".mysqli_error($link));

    if (mysqli_num_rows($current_newsletter_results) != 0) {

        $row = mysqli_fetch_array($current_newsletter_results);
        $newsletter_path = $row['file_path'];
        $newsletter_name = $row['name'];
        $subject = stripslashes($_POST['subject']);
        $message = stripslashes($_POST['message']);

        //create a From: mailheader
        $mailheaders = "From: jason.verbosh@gmail.com";

        $email_message = new PHPMailer();
        $email_message->From = 'jason.verbosh@gmail.com';
        $email_message->FromName = 'Athens State Regional Inservice Center';
        $email_message->Subject = $subject;
        $email_message->Body = $message;
        $email_message->AddAttachment($newsletter_path, $newsletter_name);

        while ($row = mysqli_fetch_array($email_address_results)) {
            $email_address = $row['email'];

            $email_message->AddAddress($email_address);

            set_time_limit(0);

            if ($email_message->Send()) {
                $display_block .= "Newsletter sent to: ".$email_address."<br/>";   
            }
            else {
                $display_block .= "Error sending to " . $email_address . " => " . $email_message->ErrorInfo . "<br/>";
            }
            
        }
        $link->close();
    }
    else {
        $display_block = "No one is subscribed for the newsletter."
    }
    echo $display_block;
?>