<?php
/* Displays user information and some useful messages */
session_start();
ob_start();
// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing this page!";
  header("location: error.php");    
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Athens-AMSTI Admin </title>

        <link href="https://fonts.googleapis.com/css?family=Allura" rel="stylesheet">
        <link rel="stylesheet" href="http://myathensric.org/Home_Data/foundation.css">
        <link rel="stylesheet" href="http://myathensric.org/Home_Data/Home.css">
            <link rel="stylesheet" href="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.min.css">
        <meta charset="UTF-8">
        <title>Welcome
            <?= $first_name.' '.$last_name ?>
        </title>
    </head>

    <body>
        <?php 
          // Display message about account verification link only once
          if ( isset($_SESSION['message']) )
          {
              echo $_SESSION['message'];
              // Don't annoy the user with more messages upon page refresh
              unset( $_SESSION['message'] );
          }
        ?>
       
            
            <div id="thebigone">
                <div class="grid-container">
                    <!-- Start Top Bar  -->
                    <div class="title-bar" data-responsive-toggle="main-nav" data-hide-for="medium"><button class="menu-icon" type="button" data-toggle="main-nav"></button>
                        <div class="title-bar-title">Menu</div>
                    </div>
                    <div id="main-nav" class="top-bar">
                        <div class="top-bar-left"><span class="title-bar-title">Athens-AMSTI</span></div>
                        <div class="top-bar-right">
                            <ul class="dropdown vertical medium-horizontal menu" data-responsive-menu="accordion medium-dropdown">
                                <li><a href="http://myathensric.org/Home.html" target="_self">Home</a></li>
                                <li><a href="http://myathensric.org/AboutUs.html" target="_self">About Us</a></li>
                                <li><a href="http://myathensric.org/ContactUs_Data/ContactUs.htmll" target="_self">Contact</a></li>
                                <!--***************************************Code for top menu buttons ********************************************************** -->
                                <li><a href="calendar.html">Forms</a>
                                    <ul class="menu vertical" data-submenu="" data-magellen="">
                                        <li><a href="http://www.myathensric.org/ReservationRequest.html" target="_blank">Reservation Request</a></li>
                                        <li><a href="http://www.myathensric.org/BookStudyRequest.html" target="_blank">Book Study Request</a></li>
                                        <li><a href="http://www.myathensric.org/GeneralRequest.html" target="_blank">General Request</a></li>
                                        <li><a href="http://myathensric.org/WorkshopRequest.html" target="_blank">Workshop Request</a></li>
                                    </ul>
                                </li>
                                <li class="has-submenu"><a href="calendar.html">Calendars</a>
                                    <ul class="menu vertical" data-submenu="" data-magellen="">
                                        <li><a href="calendar.html#roomA" target="_blank">Room A</a></li>
                                        <li><a href="calendar.html#roomB" target="_blank">Room B</a></li>
                                        <li><a href="calendar.html#roomC" target="_blank">Room C</a></li>
                                        <li><a href="calendar.html#roomConf" target="_blank">Conference <br />Room</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <!-- End Top Bar -->
                    <div class="callout large">
                        <div class="row column text-center"><img id="logo" src="http://myathensric.org/Home_Data/Logo.jpg" alt="" /></div>
                    </div>


                    <div class="row">
                        <ul class="menu align-center">
                            <li><a href="http://myathensric.org/ReservationReport.php" target="_blank">Reservation Report</a></li>
                            <li><a href="http://myathensric.org/BookStudyReport.php" target="_blank">Book Study Report</a></li>
                            <li><a href="http://myathensric.org/GeneralReport.php" target="_blank">General Report</a></li>
                            <li><a href="http://myathensric.org/WorkshopReport.php" target="_blank">Workshop Report</a></li>
                            <li><a href="http://myathensric.org/Newsletter/newsletter_sub_report.php" target="_blank">Newsletter Subcribe Report</a></li>
                        </ul>

                    </div>
                    <div class="row">
                        <div class="medium-10 column4">

                            <a class="clear button" href="http://myathensric.org/login/logout.php">Logout</a>
                        </div>
                    </div>
                    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
                    <script src="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>
                    <script>
                        $(document).foundation();
                    </script>
                </div>
            </div>


            <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
            <script src="js/index.js"></script>

    </body>

    </html>
