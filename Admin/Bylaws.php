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

        <link rel="stylesheet" href="../resources/library/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../resources/library/bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../resources/library/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="../resources/library/DataTables/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="css/Admin.css" />

        <script src="../resources/library/jquery-3.2.1.min.js"></script>
        <script src="../resources/library/DataTables/js/jquery.dataTables.min.js"></script>
    </head>
    
<body>
    <div class="panel-body"> 
        <?php
            $bylaws = get_all_rows('bylaws');
            $bylaw_table = "";
        ?>     
        <div class="content_container">
            <h3>Bylaws</h3>
            <table id="bylaw_table" class="display table-responsive" cellspacing="0" width="100%"> 
                <thead>
                    <tr> 
                        <th>Bylaw Name</th> 
                        <th>Currently Viewable Bylaws</th> 
                        <th></th>
                    </tr>
                </thead>
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
                <input type="submit" name="submit" id="submit_button" value="Submit">
            </form>
            
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#bylaw_table').DataTable();
        });
    </script>
</body>
</html>