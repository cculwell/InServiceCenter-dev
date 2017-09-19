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

        <title>Newsletters</title>

        <link rel="stylesheet" href="css/Admin.css" />
    </head>
    
<body>
    <div class="page_container"> 

        <?php
            $newsletters = get_all_rows('newsletters');
            $newsletter_table = "";
        ?>     

        <div class="content_container">
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
            </table><br>

            <label>Load a new newsletter:</label>
            <form action="php/admin/upload_file.php?table=newsletters&type=newsletter_to_upload&dir=Newsletters" method="post" enctype="multipart/form-data">
                <input type="file" name="newsletter_to_upload" id="newsletter_to_upload"><br><br>
                <input type="submit" name="submit" value="Submit">
            </form>

        </div>
    </div>
</body>
</html>