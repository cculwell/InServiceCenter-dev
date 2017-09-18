<?php
    require "php/admin_functions.php";
?>
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Admin</title>
        
        <link rel="stylesheet" href="css/foundation.min.css">
        <link rel="stylesheet" href="css/Common.css" />
        <link rel="stylesheet" href="css/Admin.css" />
    </head>
    
<body>
    <div id="thebigone">
	
        <div class="grid-container">
            <!-- Start Top Bar  -->
            <div id="main-nav" class="top-bar">
                <div class="top-bar-left"><span class="title-bar-title">Athens-AMSTI</span></div>
            </div>
            <!-- End Top Bar -->    
            
            <!-- Side Menu -->
            <ul id=menu>
                <li><a href="Home.html" target="_self">Home</a></li>
                <li><a href="AboutUs.html" target="_self">About Us</a></li>
                <li><a href="GoverningBoard.html" target="_self">Governing Board</a></li>
                <li><a href="Inservice.html" target="_self">Inservice</a></li>
                <li class="current"><a href="ProDevel.html" target="_self">Professional Development</a></li>
                <li><a href="ContactUs_Data/ContactUs.html" target="_self">Contact</a></li>
                <li><a href="NewRequest.html" target="_blank">Forms</a></li>
                <li><a href="../calendar.html" target="_self">Calendar</a></li>
                <li><a href="../ReservationRequest.html" target="_blank">Reservation</a></li>
            </ul> 
            <!-- Mobile Menu -->
            <ul id=mobile>
                <li><a href="Home.html" target="_self">Home</a></li>
                <li><a href="AboutUs.html" target="_self">About Us</a></li>
                <li><a href="GoverningBoard.html" target="_self">Governing Board</a></li>
                <li><a href="Inservice.html" target="_self">Inservice</a></li>
                <li class="current"><a href="ProDevel.html" target="_self">Professional Development</a></li>
                <li><a href="ContactUs_Data/ContactUs.html" target="_self">Contact</a></li>
                <li><a href="NewRequest.html" target="_blank">Forms</a></li>
                <li><a href="../calendar.html" target="_self">Calendar</a></li>
                <li><a href="../ReservationRequest.html" target="_blank">Reservation</a></li>
            </ul> 

            <div class="logo_container">
                <img class="logo" src="img/Logo.jpg" alt="" />
            </div>

            <h3>Admin</h3>  
            <div class="page_container"> 

            <?php
                $newsletters = get_all_rows('newsletters');
                $bylaws = get_all_rows('bylaws');
                $subscribers = get_all_rows('subscribers');
                $newsletter_table = "";
                $bylaw_table = "";
                $subscribers_table = "";
            ?>     

            <div class="table_container">
                <label>Current Subscribers</label>
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
                                $delete = '<a href="php/email_subscription/delete_subscriber.php?id='.$row['id'].'"    
                                            onclick="return confirm(\'Are you sure you want to delete this subscriber?\');" 
                                            title="Delete Subscriber">
                                            <img src="img/db_table_icons/delete.png" 
                                            alt="delete"/></a>';

                                $subscribers_table.= "<tr><td>" . $row['email'] . "</td><td>" . $delete . "</td></tr>\n"; 
                            }
                            echo $subscribers_table;
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="table_container">
                <label>Currently Available Newsletters</label>
                <table> 
                    <thread>
                        <tr> 
                            <th>Newsletter Name</th> 
                            <th>Currently Newsletter</th> 
                            <th></th>
                        </tr>
                    </thread>
                    <tbody>
                        <?php
                            foreach($newsletters as $row) {
                                $delete = '<a href="php/admin/delete_file.php?table=newsletters&id='.$row['id'].'" 
                                              onclick="return confirm(\'Are you sure you want to delete this newsletter?\');" 
                                              title="Delete Newsletter">
                                              <img src="img/db_table_icons/delete.png" alt="delete"/></a>';
                                $set_current = '<a href="php/admin/set_current_file.php?table=newsletters&id='.$row['id'].'"
                                                 title="Select Current Newsletter">
                                                 <img src="img/db_table_icons/add.png" 
                                                 alt="Set Current Newsletter"/></a>';

                                if($row['current'] == "yes") {
                                    $current = '<img src="img/db_table_icons/accept.png" />';
                                } 
                                else{
                                    $current = '';
                                }

                                $newsletter_table.= "<tr><td>" . $row['name'] . "</td><td>" . $current . "</td><td>" . $delete . "    " . $set_current . "</td></tr>\n"; 
                            }
                            echo $newsletter_table;
                        ?>
                    </tbody>
                </table>
                <label>Load a new newsletter:</label>
                <form action="php/admin/upload_file.php?table=newsletters&type=newsletter_to_upload&dir=Newsletters" method="post" enctype="multipart/form-data">
                    <input type="file" name="newsletter_to_upload" id="newsletter_to_upload">
                    <input type="submit" name="submit" value="Submit">
                </form>
            </div>

            <div class="table_container">
                <label>Currently Available Bylaws</label>
                <table> 
                    <thread>
                        <tr> 
                            <th>Bylaw Name</th> 
                            <th>Currently Viewable Bylaws</th> 
                            <th></th>
                        </tr>
                    </thread>
                    <tbody>
                        <?php
                            foreach($bylaws as $row) {
                                $delete = '<a href="php/admin/delete_file.php?table=bylaws&id='.$row['id'].'" 
                                            onclick="return confirm(\'Are you sure you want to delete this bylaw?\');" 
                                            title="Delete Bylaw">
                                            <img src="img/db_table_icons/delete.png" 
                                            alt="delete"/></a>';
                                $set_current = '<a href="php/admin/set_current_file.php?table=bylaws&id='.$row['id'].'" 
                                                 title="Select Current Bylaws">
                                                 <img src="img/db_table_icons/add.png" 
                                                 alt="Set Current Bylaws"/></a>';

                                if($row['current'] == "yes") {
                                    $current = '<img src="img/db_table_icons/accept.png" />';
                                } 
                                else{
                                    $current = '';
                                }

                                $bylaw_table.= "<tr><td>" . $row['name'] . "</td><td>" . $current . "</td><td>" . $delete . "    " . $set_current . "</td></tr>\n"; 
                            }
                            echo $bylaw_table;
                        ?>
                    </tbody>
                </table>
                <label>Load new bylaws:</label>
	            <form  action="php/admin/upload_file.php?table=bylaws&type=bylaws_to_upload&dir=Bylaws" method="post" enctype="multipart/form-data">
	                <input type="file" name="bylaws_to_upload" id="bylaws_to_upload">
	                <input type="submit" name="submit" value="Submit">
	            </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>