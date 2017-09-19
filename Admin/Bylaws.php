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

        <title>Bylaws</title>

        <link rel="stylesheet" href="css/Admin.css" />
    </head>
    
<body>
    <div class="page_container"> 

        <?php
            $bylaws = get_all_rows('bylaws');
            $bylaw_table = "";
        ?>     
        <div class="content_container">
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
            </table><br>

            <label>Load new bylaws:</label>
            <form  action="php/admin/upload_file.php?table=bylaws&type=bylaws_to_upload&dir=Bylaws" method="post" enctype="multipart/form-data">
                <input type="file" name="bylaws_to_upload" id="bylaws_to_upload"><br><br>
                <input type="submit" name="submit" value="Submit">
            </form>
            
        </div>
    </div>
</body>
</html>