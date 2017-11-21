<?php
    require "../../../resources/config.php";
    require "../../../resources/library/PHPMailer/src/PHPMailer.php";
    require "../../../resources/library/PHPMailer/src/Exception.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $display_block = "";

    # create connection to database
    $mysqli = new mysqli($config['db']['amsti_01']['host']
        , $config['db']['amsti_01']['username']
        , $config['db']['amsti_01']['password']
        , $config['db']['amsti_01']['dbname']);

    /* check connection */
    if ($mysqli->connect_errno) 
    {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }

    // Get subscribers emails
    $sql = "SELECT email FROM subscribers";

    $sent_emails = "";
    $error_sending = "";
    $no_newsletter = "";

    if ($email_results = mysqli_query($mysqli, $sql))
    {
        if (mysqli_num_rows($email_results) > 0)
        {
            // Get the current newsletter
            $sql = "SELECT file_path, name FROM newsletters WHERE current='yes'";

            if ($newsletter_results = mysqli_query($mysqli, $sql))
            {
                if (mysqli_num_rows($newsletter_results) != 0) 
                {
                    $newsletter_row = mysqli_fetch_row($newsletter_results);
                    $newsletter_path = $newsletter_row[0];   // file_path
                    $newsletter_name = $newsletter_row[1];   // name
                    $subject = stripslashes($_POST['subject']);
                    $message = stripslashes($_POST['message']);

                    //create a From: mailheader
                    $mailheaders = "From: jason.verbosh@gmail.com"; // CHANGE THIS WHEN DELIVERING

                    while ($email_row = mysqli_fetch_row($email_results)) 
                    {
                        $email_message = new PHPMailer();
                        
                        $email_message->From = 'jason.verbosh@gmail.com';   // CHANGE THIS WHEN DELIVERING
                        $email_message->FromName = 'Athens State Regional Inservice Center';
                        $email_message->Subject = $subject;
                        $email_message->Body = $message;
                        $email_message->AddAttachment($newsletter_path, $newsletter_name);

                        $email_address = $email_row[0];   // email address

                        $email_message->AddAddress($email_address);

                        set_time_limit(0);

                        if ($email_message->Send()) 
                        {
                            $sent_emails .= $email_address . "<br>";   
                        }
                        else 
                        {
                            $error_sending .= $email_address . " => " . $email_message->ErrorInfo . "<br>";
                        }
                    }
                }
                else 
                {
                    $no_newsletter = "no_newsletter";
                }
            }
            else
            {
                echo "ERROR:  " . mysqli_error($mysqli);
            }
        }
        else
        {
            $display_block = "There are no subscribers to the newsletter.";
        } 
    }
    else
    {
        echo "ERROR:  " . mysqli_error($mysqli);
    }

    if ($sent_emails == "")
    {
        $sent_emails = "No E-mails were sent.";
    }

    if ($error_sending == "")
    {
        $error_sending = "There were no errors sending E-mails";
    }

    if ($no_newsletter == "")
    {
        echo "<label>Successfully Sent E-mails To:</label><br>";
        echo $sent_emails;
        echo "<br>";
        echo "<label>There Were Errors Sending E-mails To:</label><br>";
        echo $error_sending;        
    }
    else
    {
        echo "<label>No current newsletter is selected</label><br>";
        echo "Please select a current newsletter in <br>";
        echo "the 'Manage Newsletters' section <br>";
    }

    mysqli_close($mysqli);
?>